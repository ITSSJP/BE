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
    </style>

@endsection
@section('content')
    <div class="container mt-4">
        <div class="profile-header">
            <h2>User Profile</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card profile-card">
                    <div class="card-body">
                        <h5 class="card-title">Personal Information</h5>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name ?? ""}}" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" placeholder="Enter your age">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{Auth::user()->email ?? ""}}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" value="{{Auth::user()->phone_number ?? ""}}" placeholder="Enter your phone number">
                            </div>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" rows="3"  placeholder="Tell us something about yourself...">{{Auth::user()->bio ?? ""}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
