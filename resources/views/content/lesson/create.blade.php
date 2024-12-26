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
        #add-vocab-btn {
            margin-top: 50px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #add-vocab-btn h1 {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #343a40;
        }

        .lesson-item {
            margin-bottom: 10px;
        }

        .add-button {
            display: block;
            width: 100%;
            margin-bottom: 15px;
        }

        .submit-button {
            display: block;
            width: 100%;
        }

    </style>

@endsection

@section('content')
    <div class="container" id="add-vocab-btn">
        <h1>Create New Japanese Lesson</h1>
        <form class="frm_form_add" action="{{route('lesson.store',['id'=>$roomId])}}">
            @csrf
            <div class="mb-3">
                <input class="form-control" placeholder="Nhập tên bài học" name="title">
            </div>
            <div id="lessonItems" class="mb-3">
                <div class="lesson-item d-flex align-items-center">
                    <input type="text" class="form-control me-2" name="question[]" placeholder="Japanese Question (例: 猫)" required />
                    <input type="text" class="form-control me-2" name="romaji[]" placeholder="Romaji (例: ねこ)" required />
                    <input type="text" class="form-control me-2" name="answer[]" placeholder="Answer (例: Cat)" required />
                    <button type="button" class="btn btn-danger" onclick="removeItem(this)">Remove</button>
                </div>
            </div>
            <button type="button" class="add-button btn btn-success">Add Another Term</button>
            <button type="submit" class="submit-button btn btn-primary">Save Lesson</button>
        </form>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const lessonForm = document.getElementById("lessonForm");
                const lessonItems = document.getElementById("lessonItems");
                const addButton = document.querySelector(".add-button");

//add từ
                addButton.addEventListener("click", function () {
                    const newItem = document.createElement("div");
                    newItem.className = "lesson-item d-flex align-items-center";

                    newItem.innerHTML = `
                <input type="text" class="form-control me-2" name="question[]" placeholder="Japanese Question (\u4F8B: 猫)" required />
                <input type="text" class="form-control me-2" name="romaji[]" placeholder="Romaji (\u4F8B: ねこ)" required />
                <input type="text" class="form-control me-2" name="answer[]" placeholder="Answer (\u4F8B: Cat)" required />
                <button type="button" class="btn btn-danger" onclick="removeItem(this)">Remove</button>
              `;

                    lessonItems.appendChild(newItem);
                });

                window.removeItem = function (button) {
                    const itemToRemove = button.parentElement;
                    lessonItems.removeChild(itemToRemove);
                };

                // xử lý lưu ko biết có lưu được theo dạng map ko
                lessonForm.addEventListener("submit", function (event) {
                    event.preventDefault();

                    const formData = new FormData(lessonForm);
                    const lessonData = {
                        questions: formData.getAll("question[]"),
                        romajis: formData.getAll("romaji[]"),
                        answers: formData.getAll("answer[]")
                    };

                    console.log("Lesson Data:", lessonData);
                    alert("Lesson saved successfully!");
                });
            });
        </script>


    </div>
    <script>
        $(document).ready(function () {
            $('.frm_form_add').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'post',
                    dataType: 'json',
                    data: $(this).serialize(),
                    beforeSend: function () {
                        showPreload();
                    },
                    complete: function () {
                        hidePreload();
                    },
                    success: function (res) {
                        if (res.success) {
                            showSuccessMessage(res.message);
                            setTimeout(function () {
                                location.href = res.url;
                            }, 100);

                        } else {
                            showErrorMessage(res.message);
                        }
                    },
                    error: function (e) {
                        showErrorValidate(e);
                    }
                });
            });
        });
    </script>

@endsection

