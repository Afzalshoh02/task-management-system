@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1 class="auth-title">Создать аккаунт</h1>
                <p class="auth-subtitle">Присоединяйтесь к нам сегодня</p>
            </div>
            <div class="auth-body">
                @if ($errors->any())
                    <div class="alert alert-error">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">Полное имя</label>
                        <input type="text" id="name" name="name" class="form-control" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Адрес электронной почты</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>

                    <div class="divider">
                        <span class="divider-text">OR</span>
                    </div>

                    <div class="text-center mt-3">
                        <p class="text-muted">Уже есть аккаунт?
                            <a href="{{ route('login') }}" class="text-link">Войти здесь</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
