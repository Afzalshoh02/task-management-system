<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель задач - @yield('title')</title>
    <style>
        :root {
            --primary: #007bff;
            --secondary: #ff6f61;
            --text: #0f172a;
            --text-light: #64748b;
            --border: #e2e8f0;
            --bg: #f8fafc;
            --column-bg: #ffffff;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            --drag-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            --radius: 12px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(145deg, var(--bg), #e0e7ff);
            color: var(--text);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.5;
            font-size: 14px;
        }

        header {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
            padding: 1rem 2rem;
            box-shadow: var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 2px solid rgba(255, 255, 255, 0.15);
        }

        .logo {
            font-weight: 800;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo span {
            margin-left: 0.75rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-actions {
            display: flex;
            gap: 0.75rem;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #fff, var(--primary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .avatar:hover {
            transform: rotate(360deg);
        }

        main {
            flex-grow: 1;
            padding: 2rem 1.5rem;
            max-width: 1440px;
            margin: 0 auto;
            width: 100%;
        }

        .board-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: #fff;
            padding: 1rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .board-title {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .board-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .board-columns {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            padding-bottom: 1.5rem;
            align-items: start;
        }

        .column {
            background: var(--column-bg);
            border-radius: var(--radius);
            padding: 1rem;
            box-shadow: var(--shadow);
            transition: all 0.4s ease;
            border: 1px solid var(--border);
        }

        .column:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .column-header {
            padding: 0.5rem 0;
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--text-light);
            text-transform: uppercase;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--border);
        }

        .column-count {
            background: var(--primary);
            color: white;
            border-radius: 50%;
            padding: 0.3rem 0.7rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .task-list {
            min-height: 120px;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
        }

        .task-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--card-shadow);
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: grab;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .task-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-color: var(--primary);
        }

        .task-card.dragging {
            transform: rotate(4deg) scale(1.05);
            box-shadow: var(--drag-shadow);
            opacity: 0.9;
            z-index: 20;
            cursor: grabbing;
        }

        .task-id {
            color: var(--text-light);
            font-size: 0.75rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .task-title {
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 0.75rem;
            word-break: break-word;
        }

        .task-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.75rem;
        }

        .task-type {
            padding: 0.3rem 0.6rem;
            border-radius: 20px;
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .type-story {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
        }

        .type-bug {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
        }

        .type-task {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
        }

        .task-priority {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .priority-high {
            background: var(--error);
        }

        .priority-medium {
            background: var(--warning);
        }

        .priority-low {
            background: var(--success);
        }

        .task-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e0e7ff, #bfdbfe);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 700;
            transition: transform 0.3s ease;
        }

        .task-avatar:hover {
            transform: scale(1.1);
        }

        .drop-zone {
            min-height: 80px;
            border-radius: var(--radius);
            transition: all 0.3s ease;
        }

        .drop-zone.drag-over {
            background: rgba(0, 123, 255, 0.1);
            box-shadow: inset 0 0 0 4px var(--primary);
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
        }

        .btn-secondary {
            background: #fff;
            color: var(--text);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--bg);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius);
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            z-index: 2000;
            box-shadow: var(--shadow);
            animation: slideIn 0.5s ease, slideOut 0.5s ease 3s forwards;
        }

        @keyframes slideIn {
            from { transform: translateX(150%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(150%); opacity: 0; }
        }

        @media (max-width: 768px) {
            .board-columns {
                grid-template-columns: 1fr;
            }

            .board-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .board-controls {
                width: 100%;
                justify-content: space-between;
            }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .task-card, .column {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
    @yield('styles')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        window.dragState = {
            draggedTask: null,
            originalColumn: null
        };
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<header>
    <div class="logo">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 0C5.372 0 0 5.372 0 12C0 18.628 5.372 24 12 24C18.628 24 24 18.628 24 12C24 5.372 18.628 0 12 0Z" fill="var(--primary)"/>
            <path d="M12 4C7.582 4 4 7.582 4 12C4 16.418 7.582 20 12 20C16.418 20 20 16.418 20 12C20 7.582 16.418 4 12 4ZM12 18.5C8.415 18.5 5.5 15.585 5.5 12C5.5 8.415 8.415 5.5 12 5.5C15.585 5.5 18.5 8.415 18.5 12C18.5 15.585 15.585 18.5 12 18.5Z" fill="white"/>
            <path d="M12 7C9.239 7 7 9.239 7 12C7 14.761 9.239 17 12 17C14.761 17 17 14.761 17 12C17 9.239 14.761 7 12 7Z" fill="var(--secondary)"/>
        </svg>
        <span>TaskFlow</span>
    </div>
    <div class="user-menu">
        <div class="user-actions">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Выход</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-secondary">Вход</a>
                <a href="{{ route('register') }}" class="btn">Регистрация</a>
            @endauth
        </div>
        <div class="avatar">
            {{ Auth::check() ? strtoupper(substr(Auth::user()->name, 0, 2)) : 'JD' }}
        </div>
    </div>
</header>
<main>
    @if (session('success'))
        <div class="notification" style="background: var(--success);">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="notification" style="background: var(--error);">{{ session('error') }}</div>
    @endif
    @yield('content')
</main>
@yield('scripts')
</body>
</html>
