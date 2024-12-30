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
                <button id="add-lesson-btn" class="btn btn-primary btn-sm" onclick="location.href=`{{route('lesson.create',['id'=>$room->id])}}`;">
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
            @if(\Illuminate\Support\Facades\Auth::user()->role==\App\Models\User::TEACHER)
            <button id="add-member-btn" class="btn btn-primary btn-sm">
                ➕ Thêm Thành Viên
            </button>
            @endif
        </div>
        <div id="add-member-form" class="mt-3" style="display: none;">
            <div class="form-group">
                <label for="member-name">Tên Thành Viên</label>
                <input type="text" id="member-name" class="form-control" placeholder="Nhập tên thành viên" name="user_name"  autocomplete="off">
                <ul id="search-results" class="list-group mt-2 shadow-lg" style="display: none;"></ul>
                <input type="hidden" id="hidden-user-id" name="student_id">

            </div>
            <button id="confirm-add-btn" class="btn btn-success btn-sm mt-2">✅ Xác Nhận</button>
            <button id="cancel-add-btn" class="btn btn-secondary btn-sm mt-2">❌ Hủy</button>
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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- xử lý logic cho bài ọc và thành viên -->
    <script>

        $(document).ready(function () {
            $.ajax({
                url: `{{route('lesson.list',['id'=>$room->id])}}`, // URL API
                type: 'GET',
                success: function (response) {
                    const lessons = response.data.map(lessons => ({
                        id: lessons.id,
                        title: lessons.title,
                    }));
                    const lessonContainer = document.querySelector("#lesson-list ul");
                    lessonContainer.innerHTML = lessons
                        .map((lesson) => `
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      ${lesson.title}
                      <button class="btn btn-primary btn-sm" onclick="startLesson(${lesson.id})">Vào học</button>
                    </li>
                  `)
                                    .join("");
                },
                error: function (xhr, status, error) {
                    console.error('Lỗi khi lấy danh sách thành viên:', error);
                }
            });
            // Gọi API để lấy danh sách thành viên
            $.ajax({
                url: `{{route('getMember',['id'=>$room->id])}}`, // URL API
                type: 'GET',
                success: function (response) {
                     const members = response.members.map(member => ({
                        id: member.id,
                        name: member.name,
                        username: member.email // Thay đổi email thành username nếu cần
                    }));

                    const memberCount = document.querySelector("#member-count");
                    memberCount.textContent = `Tổng số thành viên: ${members.length+1}`;

                    const memberTable = document.querySelector("#member-table");
                    memberTable.innerHTML = members
                        .map((member, index) => `
        <tr>
          <td>${index + 1}</td>
          <td>${member.name}</td>
          <td>${member.username}</td>
            @if(\Illuminate\Support\Facades\Auth::user()->role==\App\Models\User::TEACHER)
                          <td>
                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(${member.id})">❌</button>
                </td>
              @endif
        </tr>
      `).join("");
                },
                error: function (xhr, status, error) {
                    console.error('Lỗi khi lấy danh sách thành viên:', error);
                }
            });
        });


        function startLesson(lessonId) {
            const roomId = '{{ $room->id }}'; // Lấy giá trị roomId từ server-side
            location.href = `{{ route('lesson.detail', ['id' => ':roomId', 'lessonId' => ':lessonId']) }}`
                .replace(':roomId', roomId)
                .replace(':lessonId', lessonId);
        }

        function confirmDelete(memberId) {
            // Hiển thị hộp thoại xác nhận
            if (confirm('Bạn có chắc chắn muốn xóa thành viên này khỏi phòng?')) {
                $.ajax({
                    url: `/room/{{$room->id}}/members/delete/${memberId}`, // URL API xóa thành viên
                    type: 'DELETE', // Phương thức DELETE
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Nếu cần CSRF token
                    },
                    success: function(response) {
                        // Thông báo thành công
                        if (response.success) {
                        showSuccessMessage(response.message);
                        // Xóa thành viên khỏi giao diện
                        $(`#room-member-${memberId}`).remove();
                            setTimeout(function () {
                                location.href = "{{route('room.detail',['id'=>$room->id])}}";
                            }, 100);
                        }
                        else {
                            showErrorMessage(response.message);
                        }
                    },
                    error: function(xhr) {
                        // Xử lý lỗi
                        if (xhr.status === 404) {
                            alert(xhr.responseJSON.message || 'Không tìm thấy thành viên hoặc phòng.');
                        } else {
                            alert('Đã xảy ra lỗi, vui lòng thử lại.');
                        }
                    }
                });
            }
        }

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const addMemberBtn = document.getElementById("add-member-btn");
            const addMemberForm = document.getElementById("add-member-form");
            const confirmAddBtn = document.getElementById("confirm-add-btn");
            const cancelAddBtn = document.getElementById("cancel-add-btn");
            const memberNameInput = document.getElementById("member-name");
            const memberList = document.getElementById("member-list");

            // Hiển thị bảng thêm thành viên
            addMemberBtn.addEventListener("click", () => {
                addMemberForm.style.display = "block";
                memberNameInput.focus();
            });

            // Xử lý thêm thành viên
            confirmAddBtn.addEventListener("click", () => {
                const memberName = memberNameInput.value.trim();
                if (memberName) {
                    // Tạo một phần tử li mới
                    const newMember = document.createElement("li");
                    newMember.className = "list-group-item d-flex justify-content-between align-items-center";
                    newMember.textContent = memberName;

                    // Thêm nút xóa
                    const removeBtn = document.createElement("button");
                    removeBtn.className = "btn btn-danger btn-sm";
                    removeBtn.textContent = "❌";
                    removeBtn.addEventListener("click", () => {
                        memberList.removeChild(newMember);
                    });

                    newMember.appendChild(removeBtn);

                    // Thêm vào danh sách
                    memberList.appendChild(newMember);

                    // Reset form
                    memberNameInput.value = "";
                    addMemberForm.style.display = "none";
                } else {
                    alert("Vui lòng nhập tên thành viên.");
                }
            });

            // Hủy thêm thành viên
            cancelAddBtn.addEventListener("click", () => {
                memberNameInput.value = "";
                addMemberForm.style.display = "none";
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#member-name').on('input', function () {
                const query = $(this).val().trim(); // Lấy giá trị input, loại bỏ khoảng trắng thừa

                // Nếu input có giá trị
                if (query.length > 0) {
                    $.ajax({
                        url: '{{ route('search.user') }}', // URL API Laravel
                        type: 'GET',
                        data: { name: query },
                        beforeSend: function () {
                            $('#search-results').css('display','block');
                            $('#search-results').html('<p>Đang tìm kiếm...</p>');
                        },
                        success: function (response) {
                            // Kiểm tra dữ liệu trả về
                            if (response.data && response.data.length > 0) {
                                // Tạo danh sách kết quả
                                const html = response.data
                                    .map(member => `<p class="p-2 result-item" style="cursor: pointer;" id="user-${member.id}" data-id="${member.id}">${member.name}<br><span style="color: gray;">${member.email}</span></p>`)
                                    .join('');
                                $('#search-results').html(html);
                            } else {
                                // Không có kết quả
                                $('#search-results').html('<p>Không tìm thấy kết quả.</p>');
                            }
                        },
                        error: function () {
                            // Xử lý lỗi
                            $('#search-results').html('<p>Đã xảy ra lỗi, vui lòng thử lại.</p>');
                        }
                    });
                } else {
                    // Nếu input trống, xóa kết quả
                    $('#search-results').empty();
                }
            });
        });
        $(document).on('click', '.result-item', function () {
            const userId = $(this).data('id'); // Lấy user ID từ thuộc tính data-id
            $('#hidden-user-id').val(userId); // Gán vào ô input ẩn
            // Gửi AJAX để thêm thành viên
            $.ajax({
                url: '{{ route('add.member',['id'=>$room->id]) }}', // URL API thêm thành viên
                type: 'POST',
                data: {
                    student_id: userId,
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
                },
                success: function (response) {
                    showSuccessMessage(response.message);
                    $('#search-results').empty(); // Ẩn kết quả tìm kiếm
                    $('#search-results').css('display','none'); // Ẩn kết quả tìm kiếm
                    $('#member-name').val(''); // Reset ô tìm kiếm
                    updateMemberTable(response.newMember); // Cập nhật bảng thành viên
                },
                error: function () {
                    showErrorMessage(response.message);

                }
            });
        });
        function updateMemberTable(member) {
            const index = $('#member-table tr').length + 1;
            const newRow = `
            <tr>
                <td>${index}</td>
                <td>${member.name}</td>
                <td>${member.email}</td>
            </tr>
        `;
            $('#member-table').append(newRow);

            // Cập nhật tổng số thành viên
            const totalMembers = parseInt($('#member-count').text().replace(/\D/g, '')) + 1;
            $('#member-count').text(`Tổng số thành viên: ${totalMembers}`);
        }

    </script>
@endsection

