<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign in | UniVents</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page antialiased">
    <div class="auth-background" aria-hidden="true"></div>
    <main class="auth-shell">
        @include('auth.partials.brand-panel')

        <section class="auth-card" aria-labelledby="login-title">
            <div class="card-brand">
                <img src="{{ asset('images/univents-logo.png') }}" alt="UniVents logo">
                <p>Discover. Register. Experience.</p>
            </div>
            <div class="card-heading">
                <p class="card-eyebrow">WELCOME BACK</p>
                <h2 id="login-title">Sign in to UniVents</h2>
                <p>Sign in with your university email and password. We will open the right dashboard automatically.</p>
            </div>

            @if (session('status'))
                <div class="form-alert form-alert-success" role="status">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="form-alert form-alert-error" role="alert">
                    <strong>We couldn't sign you in.</strong>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="auth-form">
                @csrf
                <div class="field-group">
                    <label for="email">University email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required autofocus class="form-field" placeholder="name@university.edu">
                    @error('email')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="field-group">
                    <label for="password">Password</label>
                    <div class="password-field-wrap">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="form-field" placeholder="Enter your password">
                        <button type="button" class="password-toggle" data-password-toggle="password" aria-label="Show password" aria-pressed="false">Show</button>
                    </div>
                    @error('password')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <label class="remember-option"><input type="checkbox" name="remember" value="1" @checked(old('remember'))> <span>Keep me signed in</span></label>
                <button type="submit" class="auth-submit">Sign in <span aria-hidden="true">&#8594;</span></button>
            </form>

            <div class="card-footer">
                <p>New student? <a href="{{ route('register') }}">Create an account</a></p>
                <small>Student sign-up creates a student account. Administrator access is managed by the university.</small>
            </div>
        </section>
    </main>
</body>
</html>