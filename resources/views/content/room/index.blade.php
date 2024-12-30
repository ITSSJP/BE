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
            cursor: pointer;
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
        .progress-container {
            margin: 10px 0;
        }

        .progress-bar-custom {
            height: 8px;
            border-radius: 5px;
            background: linear-gradient(to right, #2563eb, #4f46e5);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .progress-text {
            font-size: 0.9rem;
            font-weight: bold;
            text-align: right;
        }
    </style>

@endsection
@section('content')
    <div class="container mt-4">
        <!-- Tiêu đề chính -->
        <div class="container mt-5">
            <h2 class="mb-4">Quản lý lớp học</h2>
            @if(Auth::user()->role==\App\Models\User::TEACHER)
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tạo lớp học</button>
            @endif
            @foreach($rooms as $room)
                <div class="card p-3 mb-3 shadow-sm">
                    <div class="course-card">
                        <div>
                            <h5>{{$room->name}}</h5>
                            <p class="text-muted mb-0">{{count($room->members)+1}} Thành viên</p>
                        </div>
                        @if(Auth::user()->role==\App\Models\User::STUDENT)
                            <div class="progress-container" id="progress1"></div>
                            <a href="{{route('room.detail',["id"=>$room->id])}}" class="btn btn-primary ">Xem Bài Học</a>
                        @endif
                        @if(Auth::user()->role==\App\Models\User::TEACHER)
                            <a href="{{route('room.detail',["id"=>$room->id])}}" class="btn btn-primary mt-3">Xem chi tiết lớp học</a>
                            <a href="#" class="btn btn-danger mt-3" onclick="deleteClass({{$room->id}})">xóa lớp học</a>

                        @endif
                    </div>
                </div>
            @endforeach
            <!-- Class 1 -->

        </div>
    </div>

    @if(Auth::user()->role==\App\Models\User::TEACHER)
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo Lớp Học</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('room.create')}}" method="POST" class="frm_form_add">
                        @csrf

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên lớp học</label>
                                <input type="text" class="form-control" name="name">
                                <input type="hidden" name="owner_id" value="{{Auth::id()}}">
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Lưu</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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
        async function deleteClass(classId) {
            const confirmDelete = confirm("Bạn có chắc chắn muốn xóa lớp học này?");
            if (!confirmDelete) return;

            try {
                const url = `{{ route('room.delete', ['roomId' => ':roomId']) }}`.replace(':roomId', classId);
                const response = await fetch(url, {
                    method: "DELETE",
                });

                if (response.ok) {
                    toastr.success("Xóa lớp học thành công.");
                    location.href="{{route('room.index')}}";
                } else {
                    const errorData = await response.json();
                    alert(errorData.message || "Có lỗi xảy ra khi xóa lớp học.");
                }
            } catch (error) {
                console.error("Error deleting class:", error);
                alert("Có lỗi xảy ra khi xóa lớp học.");
            }
        }
    </script>

@endsection

