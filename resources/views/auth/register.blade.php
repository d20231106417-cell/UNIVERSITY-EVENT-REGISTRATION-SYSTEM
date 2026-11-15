<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create account | UniVents</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page antialiased">
    <div class="auth-background" aria-hidden="true"></div>
    <main class="auth-shell">
        @include('auth.partials.brand-panel')

        <section class="auth-card register-card" aria-labelledby="register-title">
            <div class="card-brand">
                <img src="{{ asset('images/univents-logo.png') }}" alt="UniVents logo">
                <p>Discover. Register. Experience.</p>
            </div>
            <div class="card-heading">
                <p class="card-eyebrow">JOIN THE CAMPUS COMMUNITY</p>
                <h2 id="register-title">Create your account</h2>
                <p>Register once to follow your university event activity.</p>
            </div>
            @if ($errors->any())
                <div class="form-alert form-alert-error" role="alert"><strong>Please check your details.</strong><span>{{ $errors->first() }}</span></div>
            @endif

            <form method="POST" action="{{ route('register.store') }}" class="auth-form register-form">
                @csrf
                <div class="field-group"><label for="name">Full name</label><input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required autofocus class="form-field" placeholder="Your name">@error('name')<span class="field-error">{{ $message }}</span>@enderror</div>
                <div class="field-group"><label for="email">University email</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required class="form-field" placeholder="name@university.edu">@error('email')<span class="field-error">{{ $message }}</span>@enderror</div>
                <div class="field-group"><label for="password">Password</label><div class="password-field-wrap"><input id="password" name="password" type="password" autocomplete="new-password" required class="form-field" placeholder="At least 8 characters"><button type="button" class="password-toggle" data-password-toggle="password" aria-label="Show password" aria-pressed="false">Show</button></div><small class="field-hint">Use at least 8 characters.</small>@error('password')<span class="field-error">{{ $message }}</span>@enderror</div>
                <div class="field-group"><label for="password_confirmation">Confirm password</label><div class="password-field-wrap"><input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="form-field" placeholder="Type your password again"><button type="button" class="password-toggle" data-password-toggle="password_confirmation" aria-label="Show password" aria-pressed="false">Show</button></div></div>
                <button type="submit" class="auth-submit">Create student account <span aria-hidden="true">&#8594;</span></button>
            </form>
            <div class="card-footer"><p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p></div>
        </section>
    </main>
</body>
</html>