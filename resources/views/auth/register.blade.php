@extends('layouts.app')

@section('content')
<div class="col-12 col-md-8 col-lg-6 col-xl-5">
    <div class="card card-custom text-center">
        <h2 class="fw-bold mb-4 text-uppercase">Register</h2>
        <form id="registerForm" action="{{ route('register') }}" method="POST">
            @csrf
            <!-- Email -->
            <div class="mb-4">
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email" placeholder="Enter your email" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-4">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       id="password" name="password" placeholder="Enter your password" required>
            </div>

            <div class="mb-4">
                <input type="password" class="form-control" id="confirmPassword"
                       name="password_confirmation" placeholder="Confirm your password" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-4">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter your name" required>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-4">
                <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option>Bạn là?</option>
                    <option value="{{\App\Models\User::TEACHER}}">Giáo viên</option>
                    <option value="{{\App\Models\User::STUDENT}}">Học sinh/Sinh viên</option>
                </select>
                @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-custom btn-lg w-100">Register</button>
        </form>
        <p class="mt-4 mb-0">Already have an account? <a href="{{route('login')}}" class="text-white fw-bold">Login</a></p>
    </div>
</div>
@endsection
