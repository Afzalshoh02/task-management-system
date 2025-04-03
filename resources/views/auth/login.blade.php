@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1 class="auth-title">С Возвращением</h1>
                <p class="auth-subtitle">Пожалуйста, введите свои учетные данные для входа в систему</p>
            </div>
            <div class="auth-body">
                @if ($errors->any())
                    <div class="alert alert-error">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Адрес электронной почты</label>
                        <input type="email" id="email" name="email" class="form-control" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <input type="checkbox" name="remember"> Помнить меня
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Авторизоваться</button>

                    <div class="divider">
                        <span class="divider-text">OR</span>
                    </div>

                    <div class="text-center mt-3">
                        <p class="text-muted">У вас нет учетной записи?
                            <a href="{{ route('register') }}" class="text-link">Зарегистрируйтесь здесь</a>
                        </p>
                        @if (Route::has('password.request'))
                            <p class="text-muted mt-2">
                                <a href="{{ route('password.request') }}" class="text-link">Forgot your password?</a>
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
