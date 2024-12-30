@extends('layouts.commonLayout')
@section('styles')
    <style>

        .main-content-container {
            margin-left: 270px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }


        #flashcard-container {
            margin: 0 auto;
            max-width: 800px;
        }

        .flashcard {
            width: 100%;
            height: 350px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            perspective: 1000px;
            cursor: pointer;
            margin-top: 20px;
        }

        .flashcard-inner {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.6s ease;
        }

        .flashcard.is-flipped .flashcard-inner {
            transform: rotateY(180deg);
        }

        .flashcard-front,
        .flashcard-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            padding: 20px;
            overflow: hidden;
            transition: background-color 0.3s ease;
        }

        .flashcard-front {
            background: #f8f8f9;
            color: rgb(32, 30, 30);
        }

        .flashcard-back {
            background: #fff;
            color: #212529;
            transform: rotateY(180deg);
        }

        .flashcard h2,
        .flashcard h3,
        .flashcard h4 {
            margin: 0;
        }

        .icon-volume {
            font-size: 30px;
            margin-top: 20px;
            color: #8086e3;
            transition: transform 0.3s ease;
        }

        .icon-volume:hover {
            transform: scale(1.2);
        }

        .navigation {
            text-align: center;
            margin-top: 20px;
        }

        .navigation .btn {
            margin: 5px;
            font-size: 16px;
        }

        .flashcard-description {
            font-size: 14px;
            margin-top: 10px;
            opacity: 0.85;
        }

        .flashcard-container-title {
            margin-top: 20px;
            padding: 15px;
            background: #e9ecef;
            border-radius: 5px;
        }

        .modal-background {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
        }

        .btn-custom {
            margin-top: 10px;
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: linear-gradient(45deg, #0056b3, #003d80);
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>

@endsection
@section('content')
    <!-- Tiêu đề chính -->
    <div id="flashcard-container" class="container text-center">
        <div class="flashcard-container-title">
            <h1 class="text-primary">Flashcard Learning</h1>
            <p class="text-secondary">Click the card to flip and reveal the meaning!</p>
        </div>

        <!-- Card Status -->
        <div class="card-status mb-3">
            <h5 id="flashcard-counter" class="text-secondary">Card</h5>
        </div>

        <div class="flashcard" onclick="flipCard()">
            <div class="flashcard-inner">
                <div class="flashcard-front d-flex flex-column align-items-center justify-content-center">
                    <h2 id="word" class="mb-3">猫</h2>
                    <p class="flashcard-description text-light">Japanese Word</p>
                </div>
                <div class="flashcard-back d-flex flex-column align-items-center justify-content-center">
                    <h3 id="reading" class="mb-3">ねこ</h3>
                    <h4 id="meaning" class="mb-4">Cat</h4>
                    <div class="icon-volume" onclick="playAudio(event)">
                        <i class="bi bi-volume-up-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="navigation">
            <button class="btn btn-outline-primary" onclick="prevFlashcard()">Previous</button>
            <button class="btn btn-outline-primary" onclick="nextFlashcard()">Next</button>
        </div>
        <button class="btn-custom" id="create-test" onclick="openModal()">Thiết lập bài kiểm tra</button>
        <div id="modal-background" class="modal-background">
            <div class="modal-content">
                <h3>Chọn loại câu hỏi</h3>
                <p>Vui lòng chọn một dạng câu hỏi cho bài kiểm tra:</p>
                <button class="btn btn-success" onclick="alert('Chọn trắc nghiệm')" disabled>Trắc
                    nghiệm</button>
                <hr>
                <form action="{{route('test.create',['id'=>$roomId,'lessonId'=>$lessonId])}}" method="GET">
                <h4>Chọn số câu hỏi:</h4>
                <input id="question-count" type="number" min="1" max="40" value="Ơ" class="form-control" name="number_question"
                       style="width: 80%; margin: 10px auto;" />
                <button class="btn btn-primary" onclick="applyQuestionCount()">Xác nhận</button>
                <button class="btn btn-danger" onclick="closeModal()">Đóng</button>
                </form>
            </div>
        </div>
        <script>
            function openModal() {
                document.getElementById('modal-background').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('modal-background').style.display = 'none';
            }
        </script>

    </div>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
          rel="stylesheet">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        var currentIndex = 0;

        var flashcards=[];
        $.ajax({
                url: `{{route('lesson.getFlashCardItem',['id'=>$roomId, 'lessonId'=>$lessonId])}}`, // Endpoint API
                type: 'GET', // Phương thức HTTP
                dataType: 'json', // Kiểu dữ liệu trả về
                success: function(response) {
                    // Xử lý dữ liệu trả về
                    flashcards = response.flashcards;
                    console.log(flashcards);

                    // Hiển thị flashcards trong giao diện
                    showFlashcard(currentIndex);

                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi
                    console.error('Error fetching flashcards:', error);
                    alert('Failed to fetch flashcards. Please try again later.');
                }
            });

        function flipCard() {
            const card = document.querySelector('.flashcard');
            card.classList.toggle('is-flipped');
        }

        function showFlashcard(index) {
            const { word, reading, meaning } = flashcards[index];
            document.getElementById('word').innerText = word;
            document.getElementById('reading').innerText = reading;
            document.getElementById('meaning').innerText = meaning;
        }

        function prevFlashcard() {
            if (currentIndex > 0) {
                currentIndex--;
                showFlashcard(currentIndex);
            }
        }

        function nextFlashcard() {
            if (currentIndex < flashcards.length - 1) {

                currentIndex++;

                showFlashcard(currentIndex);
            }
        }

        function playAudio(event) {
            event.stopPropagation();
            const audio = new Audio(flashcards[currentIndex].audio);
            audio.play();
        }


    </script>



@endsection

