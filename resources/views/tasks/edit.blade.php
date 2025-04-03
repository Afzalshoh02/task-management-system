@extends('layouts.app')

@section('title', 'Редактировать задачу')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-indigo-200 via-purple-100 to-pink-200 flex items-center justify-center">
        <div class="max-w-4xl w-full mx-4 sm:mx-6 lg:mx-8">
            <div class="bg-white/90 backdrop-blur-md overflow-hidden shadow-2xl sm:rounded-3xl transition-all duration-700 hover:shadow-3xl border border-indigo-100">
                <div class="p-8 sm:p-12">
                    <div class="flex items-center justify-between mb-12">
                        <div>
                            <h2 class="text-4xl font-extrabold text-gray-900 animate-slide-in-left">Редактировать задачу</h2>
                            <p class="mt-3 text-base text-gray-600 animate-slide-in-left delay-100">С легкостью уточняйте детали вашей задачи</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('tasks.index') }}"
                               class="inline-flex items-center px-5 py-2.5 border border-indigo-300 text-sm font-semibold rounded-full text-indigo-700 bg-indigo-50 hover:bg-indigo-100 focus:outline-none focus:ring-4 focus:ring-indigo-300 transition-all duration-500 hover:-translate-y-1 shadow-md">
                                Отменить
                            </a>
                            <button type="submit" form="editTaskForm"
                                    class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-semibold rounded-full text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 transition-all duration-500 hover:-translate-y-1 hover:shadow-lg">
                                Обновить задачу
                            </button>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('tasks.update', $task->id) }}" id="editTaskForm" class="space-y-10">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                            <!-- Title Field -->
                            <div class="sm:col-span-2 animate-slide-in-up delay-150">
                                <label for="title" class="block text-sm font-semibold text-gray-800 mb-2">Заглавие</label>
                                <div class="relative group">
                                    <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required
                                           class="block w-full rounded-2xl border-0 bg-gray-50 py-4 px-5 text-gray-900 shadow-md ring-1 ring-indigo-200 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-500 sm:text-sm transition-all duration-300 group-hover:ring-indigo-300 group-hover:shadow-lg">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <svg class="h-6 w-6 text-indigo-400 group-hover:text-indigo-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('title')
                                <p class="mt-2 text-sm text-red-500 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description Field -->
                            <div class="sm:col-span-2 animate-slide-in-up delay-200">
                                <label for="description" class="block text-sm font-semibold text-gray-800 mb-2">Описание</label>
                                <div class="relative group">
                                    <textarea name="description" id="description" rows="5"
                                              class="block w-full rounded-2xl border-0 bg-gray-50 py-4 px-5 text-gray-900 shadow-md ring-1 ring-indigo-200 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-500 sm:text-sm transition-all duration-300 group-hover:ring-indigo-300 group-hover:shadow-lg"
                                              placeholder="Describe your task in detail">{{ old('description', $task->description) }}</textarea>
                                    <div class="absolute bottom-4 right-4 flex items-center pointer-events-none">
                                        <svg class="h-6 w-6 text-indigo-400 group-hover:text-indigo-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('description')
                                <p class="mt-2 text-sm text-red-500 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Type Field -->
                            <div class="animate-slide-in-up delay-250">
                                <label for="type" class="block text-sm font-semibold text-gray-800 mb-2">Тип</label>
                                <div class="relative group">
                                    <select name="type" id="type" required
                                            class="block w-full rounded-2xl border-0 bg-gray-50 py-4 px-5 text-gray-900 shadow-md ring-1 ring-indigo-200 focus:ring-2 focus:ring-indigo-500 sm:text-sm transition-all duration-300 group-hover:ring-indigo-300 group-hover:shadow-lg appearance-none">
                                        <option value="task" {{ old('type', $task->type) === 'task' ? 'selected' : '' }}>Task</option>
                                        <option value="story" {{ old('type', $task->type) === 'story' ? 'selected' : '' }}>Story</option>
                                        <option value="bug" {{ old('type', $task->type) === 'bug' ? 'selected' : '' }}>Bug</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <svg class="h-6 w-6 text-indigo-400 group-hover:text-indigo-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('type')
                                <p class="mt-2 text-sm text-red-500 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Priority Field -->
                            <div class="animate-slide-in-up delay-300">
                                <label for="priority" class="block text-sm font-semibold text-gray-800 mb-2">Приоритет</label>
                                <div class="relative group">
                                    <select name="priority" id="priority" required
                                            class="block w-full rounded-2xl border-0 bg-gray-50 py-4 px-5 text-gray-900 shadow-md ring-1 ring-indigo-200 focus:ring-2 focus:ring-indigo-500 sm:text-sm transition-all duration-300 group-hover:ring-indigo-300 group-hover:shadow-lg appearance-none">
                                        <option value="low" {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>Низкий</option>
                                        <option value="medium" {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>Средний</option>
                                        <option value="high" {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>Высокий</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <svg class="h-6 w-6 text-indigo-400 group-hover:text-indigo-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('priority')
                                <p class="mt-2 text-sm text-red-500 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Assignee Field -->
                            <div class="animate-slide-in-up delay-350">
                                <label for="assignee" class="block text-sm font-semibold text-gray-800 mb-2">Правопреемник</label>
                                <div class="relative group">
                                    <input type="text" name="assignee" id="assignee" value="{{ old('assignee', $task->assignee) }}" required
                                           class="block w-full rounded-2xl border-0 bg-gray-50 py-4 px-5 text-gray-900 shadow-md ring-1 ring-indigo-200 placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-500 sm:text-sm transition-all duration-300 group-hover:ring-indigo-300 group-hover:shadow-lg"
                                           placeholder="Who's responsible?">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <svg class="h-6 w-6 text-indigo-400 group-hover:text-indigo-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('assignee')
                                <p class="mt-2 text-sm text-red-500 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status Field -->
                            <div class="animate-slide-in-up delay-400">
                                <label for="status" class="block text-sm font-semibold text-gray-800 mb-2">Статус</label>
                                <div class="relative group">
                                    <select name="status" id="status" required
                                            class="block w-full rounded-2xl border-0 bg-gray-50 py-4 px-5 text-gray-900 shadow-md ring-1 ring-indigo-200 focus:ring-2 focus:ring-indigo-500 sm:text-sm transition-all duration-300 group-hover:ring-indigo-300 group-hover:shadow-lg appearance-none">
                                        <option value="todo" {{ old('status', $task->status) === 'todo' ? 'selected' : '' }}>To Do</option>
                                        <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="done" {{ old('status', $task->status) === 'done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                        <svg class="h-6 w-6 text-indigo-400 group-hover:text-indigo-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('status')
                                <p class="mt-2 text-sm text-red-500 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-slide-in-left {
            animation: slideInLeft 0.8s ease-out forwards;
        }
        .animate-slide-in-up {
            animation: slideInUp 0.8s ease-out forwards;
        }
        .animate-pulse {
            animation: pulse 1.5s infinite;
        }
        .delay-100 {
            animation-delay: 0.1s;
        }
        .delay-150 {
            animation-delay: 0.15s;
        }
        .delay-200 {
            animation-delay: 0.2s;
        }
        .delay-250 {
            animation-delay: 0.25s;
        }
        .delay-300 {
            animation-delay: 0.3s;
        }
        .delay-350 {
            animation-delay: 0.35s;
        }
        .delay-400 {
            animation-delay: 0.4s;
        }
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        .shadow-3xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
    </style>
@endsection
