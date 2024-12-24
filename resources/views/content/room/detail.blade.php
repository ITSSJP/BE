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

        }

        .sidebar-nav-link:hover i {
            transform: rotate(10deg);
        }

        .main-content-container {
            margin-left: 270px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }

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
        #add-lesson-btn {
            background: linear-gradient(135deg, #38bdf8, #3b82f6);
            color: white;
            border: none;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        #add-lesson-btn:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: #2563eb;
            border: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #16a34a;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* add member */
        #add-member-btn {
            background: linear-gradient(135deg, #22d3ee, #2563eb);
            color: white;
            font-weight: bold;
            border: none;
            transition: all 0.3s ease;
        }

        #add-member-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Nút Xóa Thành Viên */
        .btn-danger {
            background-color: #f87171;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #ef4444;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }
    </style>
@endsection
@section('content')
    <!-- nội dung trang -->
    <div id="lesson-list" class="mt-3">
        @if(\Illuminate\Support\Facades\Auth::user()->role==\App\Models\User::TEACHER)
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0">👥 Danh sách bài học</h3>
                <button id="add-lesson-btn" class="btn btn-primary btn-sm">
                    ➕ Thêm Bài Học
                </button>
            </div>

        @endif

        <ul class="list-group">
        </ul>

    </div>



    <div id="member-info" class="mt-5">
        <!-- Header với nút Thêm Thành Viên -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">👥 Thành Viên Nhóm</h3>
            <button id="add-member-btn" class="btn btn-primary btn-sm">
                ➕ Thêm Thành Viên
            </button>
        </div>

        <!-- Tổng số lượng thành viên -->
        <p class="fw-bold" id="member-count">Tổng số thành viên: 0</p>

        <!-- Bảng thông tin thành viên -->
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Username</th>
            </tr>
            </thead>
            <tbody id="member-table">
            </tbody>
        </table>
    </div>
    <!-- xử lý logic cho bài ọc và thành viên -->
    <script>
        const lessons = [
            { id: 1, title: "Bài học 1" },
            { id: 2, title: "Bài học 2" },
            { id: 3, title: "Bài học 3" }
        ];

        const members = [
            { id: 1, name: "Nguyễn Văn A", username: "nguyenvana123" },
            { id: 2, name: "Trần Thị B", username: "tranthib456" },
            { id: 3, name: "Lê Văn C", username: "levanc789" }
        ];

        const lessonContainer = document.querySelector("#lesson-list ul");
        lessonContainer.innerHTML = lessons
            .map((lesson) => `
        <li class="list-group-item d-flex justify-content-between align-items-center">
          ${lesson.title}
          <button class="btn btn-primary btn-sm" onclick="startLesson(${lesson.id})">Vào học</button>
        </li>
      `)
            .join("");

        function startLesson(id) {
            alert("Bạn đã chọn: " + lessons.find(lesson => lesson.id === id).title);
        }

        const memberCount = document.querySelector("#member-count");
        memberCount.textContent = `Tổng số thành viên: ${members.length}`;

        const memberTable = document.querySelector("#member-table");
        memberTable.innerHTML = members
            .map((member, index) => `
        <tr>
          <td>${index + 1}</td>
          <td>${member.name}</td>
          <td>${member.username}</td>
                          <td>
                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(${member.id})">❌</button>
                </td>
        </tr>
      `).join("");

        const confirmDelete = (id) => {
            const member = members.find((member) => member.id === id);
            if (member) {
                const confirmAction = confirm(
                    `Bạn có muốn xóa thành viên: ${member.name} (${member.username}) không?`
                );
                if (confirmAction) {
                    alert(`Thành viên ${member.name} đã bị xóa!`);
                }
            }
        };

        // Gọi hàm render danh sách lần đầu
        renderMemberList();
    </script>

@endsection

