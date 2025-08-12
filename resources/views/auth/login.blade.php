{{--@extends('layouts.app')--}}
{{--@section('page-title','Services')--}}
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    /* Main Colors */
    :root {
        --primary-color: #ffd200;
        --secondary-color: #222;
    }

    /* Login Container */
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 75vh;
        background-color: #f8f9fa;
        padding: 20px;
    }

    /* Login Card */
    .login-card {
        width: 100%;
        max-width: 450px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding: 40px;
        text-align: center;
    }

    /* Logo Styling */
    .login-logo {
        margin-bottom: 30px;
    }

    .login-logo img {
        max-height: 60px;
        margin: 0 10px;
    }

    /* Title */
    .login-title {
        color: var(--secondary-color);
        margin-bottom: 30px;
        font-size: 24px;
        font-weight: 600;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: var(--secondary-color);
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
    }

    /* Remember Me - Updated */
    .remember {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .remember input[type="checkbox"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 18px;
        height: 18px;
        border: 2px solid #ddd;
        border-radius: 4px;
        margin-right: 10px;
        position: relative;
        cursor: pointer;
        outline: none;
    }

    .remember input[type="checkbox"]:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .remember input[type="checkbox"]:checked::after {
        content: "✓";
        position: absolute;
        color: var(--secondary-color);
        font-size: 12px;
        font-weight: bold;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .remember label {
        margin: 0;
        cursor: pointer;
    }

    /* Login Button */
    .login-btn {
        width: 100%;
        padding: 12px;
        background-color: var(--primary-color);
        color: var(--secondary-color);
        border: 2px solid var(--primary-color);
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 15px;
    }

    .login-btn:hover {
        background-color: #ffffff;
        color: rgba(34, 34, 34, 0.68);
    }

    /* Forgot Password */
    .forgot-password {
        color: var(--secondary-color);
        text-decoration: none;
        font-size: 14px;
        display: inline-block;
        margin-bottom: 20px;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    /* Register Link */
    .register-link {
        margin-top: 20px;
        color: var(--secondary-color);
        font-size: 15px;
    }

    .register-link a {
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .login-card {
            padding: 30px 20px;
        }
    }
</style>
{{--@section('main-content')--}}
    <!-- subheader close -->
<div class="login-container">
    <div class="login-card">
        <!-- Logo at the top -->
        <div class="login-logo">
            <img src="{{ asset('images/logo-2.png') }}" alt="Company Logo Secondary" class="logo-secondary">
        </div>

{{--        <h2 class="login-title">Sign In</h2>--}}

        <form method="POST" action="{{ route('client.login') }}" class="login-form">
            @csrf
            @if(session()->has('url.intended'))
                <input type="hidden" name="redirect" value="{{ session('url.intended') }}">
            @endif
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group remember">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Remember Me</label>
            </div>

            <button type="submit" class="login-btn">
                Sign In
            </button>

            @if (Route::has('password.request'))
                <a class="forgot-password" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            @endif
        </form>

        <div class="register-link">
            Don't have an account? <a href="{{ route('client.register') }}">Register here</a>
        </div>
    </div>
</div>
{{--@endsection--}}
