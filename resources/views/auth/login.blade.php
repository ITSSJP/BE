@extends('layouts.app')

@section('content')
<div class="col-12 col-md-8 col-lg-6 col-xl-5">
    <div class="card card-custom text-center">
        <h2 class="fw-bold mb-4 text-uppercase">Login</h2>
        <p class="text-white-50 mb-4">Welcome back! Please login to your account.</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group mb-4">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter your email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mb-4">
                <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter your password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="d-flex justify-content-end mb-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-white-50">Forgot password?</a>
                @endif

            </div>

            <button class="btn btn-custom btn-lg w-100" type="submit">Login</button>
        </form>
        <!-- <div class="social-icons mt-4 d-flex justify-content-center">
            <a href="#!" class="mx-3"><i class="fab fa-facebook-f fa-lg"></i></a>
            <a href="#!" class="mx-3"><i class="fab fa-twitter fa-lg"></i></a>
            <a href="#!" class="mx-3"><i class="fab fa-google fa-lg"></i></a>
        </div> -->

        <p class="mt-4 mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-white fw-bold">Sign Up</a></p>
    </div>
</div>
@endsection
