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

    /* Register Button */
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

    /* Login Link */
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

<div class="login-container">
    <div class="login-card">
        <!-- Logo at the top -->
        <div class="login-logo">
            <img src="{{ asset('images/logo-2.png') }}" alt="Company Logo Secondary" class="logo-secondary">
        </div>

        <h2 class="login-title">Create Account</h2>

        <form method="POST" action="{{ route('client.register') }}" class="login-form">
            @csrf
            @if(session()->has('url.intended'))
                <input type="hidden" name="redirect" value="{{ session('url.intended') }}">
            @endif
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="given-name" autofocus>
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="family-name">
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input id="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required>
                @error('phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <button type="submit" class="login-btn">
                Register
            </button>
        </form>

        <div class="register-link">
            Already have an account? <a href="{{ route('client.login') }}">Sign in here</a>
        </div>
    </div>
</div>
