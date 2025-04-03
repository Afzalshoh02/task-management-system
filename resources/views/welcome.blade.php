<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Менеджер задач</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        *,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}
        html{line-height:1.5;-webkit-text-size-adjust:100%;font-family:Inter, sans-serif;}
        body{margin:0;line-height:inherit}
        a{color:inherit;text-decoration:none}

        .container{max-width:1280px;margin:0 auto;padding:0 2rem}
        .min-h-screen{min-height:100vh}
        .flex{display:flex}
        .grid{display:grid}
        .items-center{align-items:center}
        .justify-center{justify-content:center}
        .justify-between{justify-content:space-between}
        .gap-6{gap:1.5rem}
        .gap-8{gap:2rem}
        .p-6{padding:1.5rem}
        .px-6{padding-left:1.5rem;padding-right:1.5rem}
        .py-8{padding-top:2rem;padding-bottom:2rem}
        .mt-6{margin-top:1.5rem}
        .mb-12{margin-bottom:3rem}
        .text-center{text-align:center}
        .text-sm{font-size:0.875rem;line-height:1.25rem}
        .text-lg{font-size:1.125rem;line-height:1.75rem}
        .text-2xl{font-size:1.5rem;line-height:2rem}
        .font-medium{font-weight:500}
        .font-semibold{font-weight:600}
        .font-bold{font-weight:700}
        .text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity))}
        .text-gray-700{--tw-text-opacity:1;color:rgb(55 65 81 / var(--tw-text-opacity))}
        .text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}
        .text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}
        .bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}
        .bg-gradient-to-br{background-image:linear-gradient(to bottom right, #f0f7ff, #dbeafe);}
        .bg-blue-600{--tw-bg-opacity:1;background-color:rgb(37 99 235 / var(--tw-bg-opacity))}
        .rounded-xl{border-radius:0.75rem}
        .shadow-md{box-shadow:0 4px 6px -1px rgba(0,0,0,0.1),0 2px 4px -1px rgba(0,0,0,0.06)}
        .shadow-xl{box-shadow:0 20px 25px -5px rgba(0,0,0,0.1),0 10px 10px -5px rgba(0,0,0,0.04)}
        .transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4,0,0.2,1);transition-duration:300ms}

        /* Custom Styles */
        body {
            background: #f9fafb;
            color: #1f2a44;
            overflow-x: hidden;
        }
        .header {
            border-bottom: 1px solid #e5e7eb;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
            overflow: hidden;
            position: relative;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.15);
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }
        .card:hover::before {
            transform: scaleX(1);
        }
        .feature-icon {
            width: 3rem;
            height: 3rem;
            background: #dbeafe;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }
        .card:hover .feature-icon {
            transform: scale(1.1);
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
        }
        h1 {
            animation: fadeInUp 0.8s ease-out;
        }
        p {
            animation: fadeInUp 1s ease-out;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (min-width: 768px) {
            .md\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .md\:text-4xl { font-size: 2.25rem; line-height: 2.5rem; }
        }
    </style>
</head>
<body class="antialiased">
<!-- Header -->
<header class="header py-4">
    <div class="container flex justify-between items-center">
        <div class="flex items-center gap-3">
            <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" fill="#2563eb"/>
                <path d="M2 17L12 22L22 17" fill="#2563eb"/>
                <path d="M2 12L12 17L22 12" fill="#3b82f6"/>
            </svg>
            <span class="text-xl font-bold text-gray-900">Менеджер задач</span>
        </div>

        @if (Route::has('login'))
            <div class="flex items-center gap-8">
                @auth
                    <a href="{{ route('tasks.index') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition-all">Панел управления</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition-all">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition-all">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</header>

<div class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">
    <div class="container">
        <div class="text-center mb-12">
            <h1 class="text-2xl md:text-4xl font-bold text-gray-900">Добро пожаловать в Менеджер задач</h1>
            <p class="mt-3 text-lg text-gray-500">Организуйте свою работу как профессионал с нашей современной системой управления задачами</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <a href="tasks" class="card rounded-xl shadow-md p-6">
                <div class="feature-icon">
                    <svg class="h-7 w-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="mt-5 text-xl font-semibold text-gray-900">Менеджер задач Web</h2>
                <p class="mt-3 text-sm text-gray-500">Создавайте, отслеживайте и выполняйте задачи с помощью интуитивно понятного интерфейса.</p>
            </a>

            <a href="{{ url('api/documentation') }}" class="card rounded-xl shadow-md p-6">
                <div class="feature-icon">
                    <svg class="h-7 w-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                </div>
                <h2 class="mt-5 text-xl font-semibold text-gray-900">Документация по API</h2>
                <p class="mt-3 text-sm text-gray-500">Ознакомьтесь с нашими обширными документами по API с помощью Swagger UI.</p>
            </a>
        </div>

        @auth
            <div class="text-center mt-12 mb-12">
                <a href="{{ route('tasks.index') }}" class="btn">Перейти к панели управления</a>
            </div>
        @endauth
    </div>
</div>

<!-- Footer -->
<footer class="py-4 bg-white border-t">
    <div class="container flex justify-between items-center text-sm text-gray-500">
        <div>© {{ date('Y') }} Task Manager</div>
        <div>LLaravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</div>
    </div>
</footer>
</body>
</html>
