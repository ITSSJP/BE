<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        /* Background gradient and other styles */
        .gradient-custom {
            background: linear-gradient(135deg, #6A11CB, #2575FC);
            min-height: 100vh;
        }

        .card-custom {
            border: none;
            background: rgba(0, 0, 0, 0.75);
            color: white;
            border-radius: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
            padding: 2rem;
            animation: fadeIn 1.2s ease-in-out;
        }

        .form-control {
            background-color: transparent;
            color: white;
            border: 1px solid #fff;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        .form-control:focus {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
            border-color: #fff;
        }

        .btn-custom {
            background-color: #2575FC;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #6A11CB;
            box-shadow: 0 0 10px #6A11CB;
            transform: translateY(-2px);
        }

        .social-icons a {
            color: #ffffff;
            transition: color 0.3s ease-in-out;
        }
        .social-icons a:hover {
            color: #6A11CB;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<section class="gradient-custom d-flex align-items-center justify-content-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            @yield('content')
        </div>
    </div>
</section>
</body>
</html>

