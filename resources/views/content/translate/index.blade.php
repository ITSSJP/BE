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
            text-decoration: none; /* Bỏ gạch chân */


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
            text-decoration: none; /* Bỏ gạch chân */

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
        .translator-container {
            background-color: #fff;
            margin: 5% auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 700px;
        }

        .translator-container h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .btn-translate {
            background-color: #0d6efd;
            color: white;
        }

        .btn-translate:hover {
            background-color: #084298;
            color: white;
        }

        textarea {
            resize: none;
        }

        .select-lang {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .swap-icon {
            cursor: pointer;
            font-size: 24px;
            margin: 0 10px;
            color: #0d6efd;
        }

        .swap-icon:hover {
            color: #084298;
        }

    </style>


@endsection
@section('content')
    <div class="translator-container">
        <h2>Vietnamese - Japanese Translator</h2>
        <!-- Chọn ngôn ngữ -->
        <div class="select-lang mb-3">
            <div>
                <label for="from-lang" class="form-label">From:</label>
                <select id="from-lang" class="form-select">
                    <option value="vi" selected>Vietnamese</option>
                    <option value="ja">Japanese</option>
                </select>
            </div>
            <span class="swap-icon" onclick="swapLanguage()">&#8596;</span>
            <div>
                <label for="to-lang" class="form-label">To:</label>
                <select id="to-lang" class="form-select">
                    <option value="ja" selected>Japanese</option>
                    <option value="vi">Vietnamese</option>
                </select>
            </div>
        </div>
        <!-- Nhập văn bản -->
        <div class="row mb-3">
            <div class="col-md-6">
                <textarea id="input-text" class="form-control" name="text" rows="5" placeholder="Enter text here..."></textarea>
            </div>
            <div class="col-md-6">
                <textarea id="output-text" class="form-control" rows="5" placeholder="Translation will appear here..." readonly></textarea>
            </div>
        </div>
        <!-- Nút dịch -->
        <div class="text-center">
            <button class="btn btn-translate px-5" onclick="translateText()">Translate</button>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function swapLanguage() {
            const fromLang = $("#from-lang").val();
            const toLang = $("#to-lang").val();
            const inputText = $("#input-text").val();
            $("#from-lang").val(toLang);
            $("#to-lang").val(fromLang);
            if (inputText.trim()) {
                translateText();
            }

        }

        function translateText() {
            const inputText = $("#input-text").val();
            const fromLang = $("#from-lang").val();
            const toLang = $("#to-lang").val();
            // Kiểm tra nếu người dùng chưa nhập văn bản
            if (!inputText.trim()) {
                alert("Vui lòng nhập văn bản cần dịch.");
                return;
            }

            // Gửi yêu cầu API dịch bằng AJAX
            $.ajax({
                url: '{{route('api.translate')}}',
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'application/json',
                data: {
                    text: inputText,
                    from: fromLang,
                    to: toLang,
                },
                success: function(data) {
                    if (data.success) {

                        $("#output-text").val(data.translated_text);
                    } else {
                        alert("Dịch thất bại: " + data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Lỗi khi dịch:", error);

                }
            });
        }


    </script>
@endsection
