<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Improved Sidebar Menu</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

    @vite(['resources/js/app.js'])
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

  </style>
    @yield('styles')
</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar-container d-flex flex-column" id="sidebar">
    <div class="sidebar-logo-container">
      <img src="{{asset('assets/images/logos/ninja.jpg')}}" alt="Logo">
    </div>
    <ul class="nav flex-column">
      <div>
        <div class="sidebar-nav-group-header">Home</div>
        <li class="nav-item">
          <a href="{{route('home')}}" class="sidebar-nav-link">
            <i class="bi bi-house-door-fill me-2"></i> Home
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="/dashboard" class="sidebar-nav-link">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
          </a>
        </li> -->
      </div>
      <div>
        <div class="sidebar-nav-group-header">Quản lý</div>
        <li class="nav-item">
          <a href="{{route('room.index')}}" class="sidebar-nav-link">
            <i class="bi bi-building me-2"></i> Quản lý lớp học
          </a>
        </li>
        <li class="nav-item">
          <a href="/dictionary" class="sidebar-nav-link">
            <i class="bi bi-book me-2"></i> Từ Điển
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('translate.index')}}" class="sidebar-nav-link">
            <i class="bi bi-translate me-2"></i> Dịch
          </a>
        </li>
      </div>
      <!-- <div>
        <div class="sidebar-nav-group-header">Navigate</div>
        <li class="nav-item">
          <a href="/test" class="sidebar-nav-link">
            <i class="bi bi-file-earmark-text me-2"></i> Test
          </a>
        </li>
        <li class="nav-item">
          <a href="/classdetail" class="sidebar-nav-link">
            <i class="bi bi-file-earmark-person me-2"></i> Chi tiết lớp học
          </a>
        </li>
        <li class="nav-item">
          <a href="/lessons" class="sidebar-nav-link">
            <i class="bi bi-journal me-2"></i> Bài học
          </a>
        </li>
      </div> -->
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main-content-container">
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
      <div class="container-fluid">
        <!-- Sidebar Toggle for Mobile -->
        <button class="navbar-toggler" type="button" id="menuToggle">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Logo -->
        <a class="header-navbar-brand navbar-brand" href="#">Kagura</a>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" data-bs-toggle="dropdown">
                <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-circle" width="40" height="40" />
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item text-danger" href="#" onclick="logout()">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-4" id="main-container">
      <!-- Tiêu đề chính -->
        @yield('content')
    </div>

  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('js/common.js')}}"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

  <script>
    // Toggle Sidebar for Mobile
    document.getElementById("menuToggle").addEventListener("click", function () {
      document.getElementById("sidebar").classList.toggle("active");
    });

  </script>

</body>

</html>
