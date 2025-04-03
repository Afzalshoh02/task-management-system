<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Manager')</title>
    <style>
        :root {
            --primary: #0052cc;
            --primary-light: #4b9eff;
            --primary-dark: #003d99;
            --secondary: #0747a6;
            --text: #172b4d;
            --text-light: #5e6c84;
            --border: #dfe1e6;
            --bg: #f4f5f7;
            --white: #ffffff;
            --gray-light: #f5f5f5;
            --gray-dark: #e0e0e0;
            --success: #36b37e;
            --error: #ff5630;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-dark) 100%);
            padding: 40px 20px;
        }

        .auth-card {
            width: 100%;
            max-width: 480px;
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .auth-header {
            background-color: var(--primary);
            color: var(--white);
            padding: 24px;
            text-align: center;
        }

        .auth-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .auth-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }

        .auth-body {
            padding: 32px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            font-size: 16px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background-color: var(--white);
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 500;
            text-align: center;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        .mt-3 {
            margin-top: 16px;
        }

        .text-muted {
            color: var(--text-light);
            font-size: 14px;
        }

        .text-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .text-link:hover {
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid var(--border);
        }

        .divider-text {
            padding: 0 12px;
            color: var(--text-light);
            font-size: 14px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background-color: #ffebee;
            color: var(--error);
            border-left: 4px solid var(--error);
        }

        .alert-success {
            background-color: #e8f5e9;
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        .navbar {
            background-color: var(--white);
            box-shadow: var(--shadow-sm);
            padding: 16px 0;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 8px;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
        }

        .navbar-item {
            margin-left: 20px;
        }

        .navbar-link {
            color: var(--text);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .navbar-link:hover {
            color: var(--primary);
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--primary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@if (Route::has('login'))
    <nav class="navbar">
        <div class="container navbar-container">
            <a href="{{ url('/') }}" class="navbar-brand">
                <i class="fas fa-tasks"></i> Task Manager
            </a>
            <div class="navbar-menu">
                @auth
                    <a href="{{ route('tasks.index') }}" class="navbar-link navbar-item">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="navbar-item">
                        @csrf
                        <button type="submit" class="navbar-link">Logout</button>
                    </form>
                    <div class="navbar-item avatar">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                @else
                    <a href="{{ route('login') }}" class="navbar-link navbar-item">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="navbar-link navbar-item">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>
@endif

<main>
    @yield('content')
</main>

@yield('scripts')
</body>
</html>
