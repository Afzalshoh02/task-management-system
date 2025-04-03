<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Менеджер задач</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .hero {
            background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
        }
        .btn-primary {
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 13, 255, 0.2);
        }
    </style>
</head>
<body class="font-sans antialiased">
<!-- Hero Section -->
<div class="hero min-h-screen flex items-center justify-center text-white">
    <div class="text-center px-4">
        <h1 class="text-5xl font-bold mb-6 animate-bounce">Менеджер задач Pro</h1>
        <p class="text-xl mb-8 max-w-2xl mx-auto">
            Современный менеджер задач с красивым интерфейсом и мощными возможностями.
            Организуйте свои задачи как в профессиональной команде!
        </p>

        <div class="flex justify-center space-x-4">
            <a href="{{ route('login') }}"
               class="btn-primary bg-white text-blue-600 px-8 py-3 rounded-full font-bold text-lg">
                <i class="fas fa-sign-in-alt mr-2"></i>Войти
            </a>
            <a href="{{ route('register') }}"
               class="btn-primary bg-transparent border-2 border-white px-8 py-3 rounded-full font-bold text-lg hover:bg-white hover:text-blue-600">
                <i class="fas fa-user-plus mr-2"></i>Регистрация
            </a>
        </div>

        <div class="mt-16 animate-pulse">
            <i class="fas fa-arrow-down text-3xl"></i>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Возможности нашего приложения</h2>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-blue-500 mb-4">
                    <i class="fas fa-tasks text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Управление задачами</h3>
                <p class="text-gray-600">
                    Создавайте, редактируйте и отслеживайте свои задачи в удобном интерфейсе.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-blue-500 mb-4">
                    <i class="fas fa-columns text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Kanban доска</h3>
                <p class="text-gray-600">
                    Перетаскивайте задачи между колонками для удобного управления workflow.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                <div class="text-blue-500 mb-4">
                    <i class="fas fa-bell text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Уведомления</h3>
                <p class="text-gray-600">
                    Получайте уведомления о важных событиях и сроках выполнения задач.
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
