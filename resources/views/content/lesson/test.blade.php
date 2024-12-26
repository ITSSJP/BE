@extends('layouts.commonLayout')
@section('styles')
    <style>
        /* General Body */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Sidebar Styling */
        .sidebar-container {
            width: 270px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(135deg, #1e293b, #334155);
            color: white;
            overflow-y: auto;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }

        .sidebar-logo-container {
            text-align: center;
            background-color: #1e293b;
        }

        .sidebar-logo-container img {
            width: 100%;
            height: 70px;
            object-fit: contain;
            display: block;
        }

        .sidebar-nav-group-header {
            font-size: 0.875rem;
            font-weight: bold;
            padding: 0.5rem 1rem;
            margin-top: 1rem;
            text-transform: uppercase;
            color: #94a3b8;
        }

        .sidebar-nav-link {
            color: white;
            font-size: 1rem;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease-in-out;
            border-radius: 5px;
            text-decoration: none;
            /* Bỏ gạch chân */


        }

        .sidebar-nav-link i {
            transition: all 0.3s ease;
        }

        .sidebar-nav-link:hover,
        .sidebar-nav-link.active {
            background: linear-gradient(to right, #475569, #64748b);
            color: #f8fafc;
            transform: translateX(5px);
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3);
            text-decoration: none;
            /* Bỏ gạch chân */

        }

        .sidebar-nav-link:hover i {
            transform: rotate(10deg);
        }

        /* Main Content Styling */
        .main-content-container {
            margin-left: 270px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }

        /* Header Styling */
        .header-navbar-brand {
            font-weight: bold;
        }

        .header-nav-link .header-notification-indicator {
            width: 8px;
            height: 8px;
        }

        .card-header {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .display-1 {
            font-size: 4rem;
        }

        .text-danger {
            color: #dc3545 !important;
            /* Bootstrap màu đỏ */
        }

        #pronounce-btn {
            font-size: 0.8rem;
            /* Điều chỉnh kích thước nút */
            cursor: pointer;
            /* Làm cho nút có cảm giác "có thể nhấp" */
        }

        /* Mobile Sidebar Toggle */
        @media (max-width: 768px) {
            .sidebar-container {
                transform: translateX(-100%);
            }

            .sidebar-container.active {
                transform: translateX(0);
            }

            .main-content-container {
                margin-left: 0;
            }
        }

        /* Bắt đầu từ đây để thêm css của các trang layout mới */
        .quiz-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 800px;
            margin: 50px auto;
            animation: fadeIn 1s ease;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            color: #333;
        }

        .question {
            font-size: 20px;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 20px;
        }

        .option {
            margin-bottom: 10px;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .option:hover {
            background-color: #e9f5ff;
            cursor: pointer;
            transform: scale(1.02);
        }

        .btn-submit {
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 25px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .result {
            margin-top: 30px;
            font-size: 18px;
            font-weight: bold;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

@endsection
@section('content')
    <!-- ui quizz -->
    <div class="quiz-container">
        <h1>📝 Quiz Test</h1>
        <div id="quizContent">
        </div>
        <button class="btn btn-submit btn-block" id="submitBtn">Submit</button>
        <div class="result text-center" id="resultContainer"></div>
    </div>

    <script>

        var questions = [];
        // ham xu ly logic quiz bang js
        const quizContent = document.getElementById("quizContent");
        const submitBtn = document.getElementById("submitBtn");
        const resultContainer = document.getElementById("resultContainer");
        $.ajax({
            url: `{{route('quiz.create',['id'=>$roomId,'lessonId'=>$lessonId])}}`, // Endpoint API
            type: 'GET', // Phương thức HTTP
            data: { numQuestions: {{$numberQuestion}} }, // Truyền tham số numQuestions
            dataType: 'json', // Kiểu dữ liệu trả về
            success: function(response) {
                questions = response;
                // Load Questions on Page Load
                loadQuestions();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching quiz:', error);
            }
        });
        let userAnswers = [];

        function loadQuestions() {
            questions.forEach((q, index) => {
                const questionDiv = document.createElement("div");
                questionDiv.classList.add("mb-4");

                questionDiv.innerHTML = `
                    <p class="question">${index + 1}. ${q.question}</p>
                    ${q.options.map(option => `
                        <div class="option p-2 border" onclick="selectOption(${index}, '${option}', this)">
                            ${option}
                        </div>
                    `).join('')}
                `;
                quizContent.appendChild(questionDiv);
            });
        }

        function selectOption(questionIndex, option, element) {
            userAnswers[questionIndex] = option;

            const options = element.parentNode.querySelectorAll('.option');
            options.forEach(opt => opt.classList.remove('bg-primary', 'text-white'));

            element.classList.add('bg-primary', 'text-white');
        }

        // Submit Quiz
        function submitQuiz() {
            let score = 0;

            questions.forEach((q, index) => {
                if (userAnswers[index] === q.correct) {
                    score++;
                }
            });

            resultContainer.innerHTML = `
                <p>You scored ${score} out of ${questions.length}!</p>
            `;

            // Disable the quiz after submission
            submitBtn.disabled = true;
            document.querySelectorAll('.option').forEach(opt => opt.style.pointerEvents = 'none');
        }

        // Event Listener
        submitBtn.addEventListener("click", submitQuiz);


    </script>
@endsection
