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
        .dictionary-container {
            max-width: 1600px;
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.2s ease-in-out;
        }

        h2 {
            text-align: center;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .input-group input {
            border-radius: 25px 0 0 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            border-radius: 0 25px 25px 0;
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .list-group-item {
            background-color: #f9f9f9;
            border: none;
            border-left: 4px solid #007bff;
            margin-top: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .list-group-item:hover {
            transform: translateX(10px);
            background-color: #e9f5ff;
        }

        /* Keyframe Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

@endsection
@section('content')
    <div class="dictionary-container">
        <h2>📖 Dictionary App</h2>
        <div class="form-group">
            <label for="searchWord" class="font-weight-bold">Enter a word</label>
            <div class="input-group">
                <input type="text" class="form-control" id="searchWord" placeholder="Type a word here...">
                <div class="input-group-append">
                    <button class="btn btn-primary" id="searchBtn">Search</button>
                </div>
            </div>
        </div>

        <!-- Search History -->
        <div class="search-history">
            <h5 class="font-weight-bold mt-4">🔍 Search History</h5>
            <ul id="historyList" class="list-group">
                <!-- History items will appear here dynamically -->
            </ul>
        </div>
    </div>
@endsection
