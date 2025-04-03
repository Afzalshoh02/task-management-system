@extends('layouts.app')

@section('title', 'Доска Поток задач')

@section('content')
    <div class="task-board-container">
        <div class="board-header">
            <div class="board-title">
                <h2>Управление задачами</h2>
            </div>
            <div class="board-controls">
                <div class="search-box">
                    <input type="text" placeholder="Поиск задач..." id="task-search">
                    <i class="fas fa-search"></i>
                </div>
                <button id="open-task-modal" class="btn">
                    <i class="fas fa-plus"></i> Новая задача
                </button>
            </div>
        </div>

        <div class="board-columns">
            <div class="column" data-status="todo">
                <div class="column-header">
                    <div class="column-title">
                        <span class="status-indicator todo"></span>
                        <h3>To Do</h3>
                    </div>
                    <span class="column-count">{{ $tasks->where('status', 'todo')->count() }}</span>
                </div>
                <div class="task-list drop-zone">
                    @foreach ($tasks->where('status', 'todo') as $task)
                        @include('partials.task_card', ['task' => $task])
                    @endforeach
                    <div class="empty-state" style="{{ $tasks->where('status', 'todo')->count() ? 'display: none;' : '' }}">
                        <p>Задач пока нет</p>
                    </div>
                </div>
            </div>

            <div class="column" data-status="in_progress">
                <div class="column-header">
                    <div class="column-title">
                        <span class="status-indicator in-progress"></span>
                        <h3>In Progress</h3>
                    </div>
                    <span class="column-count">{{ $tasks->where('status', 'in_progress')->count() }}</span>
                </div>
                <div class="task-list drop-zone">
                    @foreach ($tasks->where('status', 'in_progress') as $task)
                        @include('partials.task_card', ['task' => $task])
                    @endforeach
                    <div class="empty-state" style="{{ $tasks->where('status', 'in_progress')->count() ? 'display: none;' : '' }}">
                        <p>Задач пока нет</p>
                    </div>
                </div>
            </div>

            <div class="column" data-status="done">
                <div class="column-header">
                    <div class="column-title">
                        <span class="status-indicator done"></span>
                        <h3>Done</h3>
                    </div>
                    <span class="column-count">{{ $tasks->where('status', 'done')->count() }}</span>
                </div>
                <div class="task-list drop-zone">
                    @foreach ($tasks->where('status', 'done') as $task)
                        @include('partials.task_card', ['task' => $task])
                    @endforeach
                    <div class="empty-state" style="{{ $tasks->where('status', 'done')->count() ? 'display: none;' : '' }}">
                        <p>Задач пока нет</p>
                    </div>
                </div>
            </div>
        </div>
        @include('tasks.create')
    </div>
@endsection

@section('styles')
    <style>
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            padding: 0.25rem;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            width: 500px;
            max-width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 1.25rem;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .modal-body .form-group {
            margin-bottom: 1rem;
        }

        .modal-body .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .modal-body .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .modal-body .error {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>

    <style>
        .task-board-container {
            padding: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .board-header {
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .board-title h2 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .project-description {
            color: var(--text-light);
            font-size: 1rem;
            font-weight: 400;
        }

        .search-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-box input {
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            width: 250px;
            transition: all 0.3s ease;
            box-shadow: var(--card-shadow);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }

        .search-box i {
            position: absolute;
            left: 0.75rem;
            color: var(--text-light);
            font-size: 1rem;
        }

        .column-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .column-title h3 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0;
        }

        .status-indicator {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .status-indicator.todo {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            border: 2px solid var(--primary);
        }

        .status-indicator.in-progress {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border: 2px solid var(--warning);
        }

        .status-indicator.done {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            border: 2px solid var(--success);
        }

        .empty-state {
            padding: 1.5rem;
            text-align: center;
            color: var(--text-light);
            font-size: 0.9rem;
            background: rgba(0, 0, 0, 0.02);
            border-radius: var(--radius);
            border: 1px dashed var(--border);
        }
    </style>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#open-task-modal').click(function() {
                $('#task-modal').show();
            });

            $('.close-modal, .modal-overlay').click(function(e) {
                if (e.target === this || $(e.target).hasClass('close-modal')) {
                    resetForm();
                    $('#task-modal').hide();
                }
            });

            $('#task-form').on('submit', function(e) {
                e.preventDefault();
                clearErrors();

                axios.post($(this).attr('action'), new FormData(this))
                    .then(response => {
                        console.log(response.status);
                        if (response.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Успех!',
                                text: 'Задача успешно создана',
                                timer: 1500,
                                showConfirmButton: false,
                                position: 'top-end',
                                toast: true,
                                background: '#f0fdf4',
                                iconColor: '#10b981'
                            }).then(() => {
                                handleSuccess();
                            });
                        }
                    })
                    .catch(error => {
                        if (error.response && error.response.status === 422) {
                            displayErrors(error.response.data.errors);
                        } else {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Ошибка',
                                text: 'Произошла ошибка при создании задачи',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    });
            });

            function handleSuccess() {
                resetForm();
                $('#task-modal').hide();
                window.location.reload();
            }

            function clearErrors() {
                $('.is-invalid').removeClass('is-invalid');
                $('.error-message').remove();
            }

            function displayErrors(errors) {
                for (const [field, messages] of Object.entries(errors)) {
                    const input = $(`[name="${field}"]`);
                    input.addClass('is-invalid');

                    let errorElement = input.next('.error-message');
                    if (errorElement.length === 0) {
                        input.after(`<div class="error-message">${messages[0]}</div>`);
                    } else {
                        errorElement.text(messages[0]);
                    }
                }
            }

            function resetForm() {
                $('#task-form')[0].reset();
                clearErrors();
            }
        });

        $(document).ready(function() {
            let draggedTask = null;
            let originalColumn = null;

            function initializeDragAndDrop() {
                $('.task-card').off('dragstart').on('dragstart', function(e) {
                    draggedTask = $(this);
                    originalColumn = $(this).closest('.column').data('status');
                    draggedTask.addClass('dragging');
                    e.originalEvent.dataTransfer.setData('text/plain', $(this).data('id'));
                });

                $('.task-card').off('dragend').on('dragend', function() {
                    $('.task-card').removeClass('dragging');
                    draggedTask = null;
                    originalColumn = null;
                });

                $('.drop-zone').off('dragover').on('dragover', function(e) {
                    e.preventDefault();
                    $(this).addClass('drag-over');
                });

                $('.drop-zone').off('dragleave').on('dragleave', function() {
                    $(this).removeClass('drag-over');
                });

                $('.drop-zone').off('drop').on('drop', function(e) {
                    e.preventDefault();
                    $(this).removeClass('drag-over');

                    const taskId = e.originalEvent.dataTransfer.getData('text/plain');
                    const newStatus = $(this).closest('.column').data('status');
                    const $taskCard = $(`.task-card[data-id="${taskId}"]`);

                    $(this).append($taskCard);
                    updateColumnCounts();
                    $('.empty-state').hide();

                    axios.put(`/tasks/${taskId}/status`, {
                        status: newStatus,
                        _token: '{{ csrf_token() }}'
                    })
                        .then(response => {
                            if (!response.data.success) {
                                revertTask(taskId, originalColumn);
                                showAlert('Failed to update task status', 'error');
                            }
                        })
                        .catch(error => {
                            revertTask(taskId, originalColumn);
                            showAlert(error.response?.data?.message || 'Error updating task', 'error');
                        });
                });
            }

            function revertTask(taskId, originalStatus) {
                $(`.column[data-status="${originalStatus}"] .task-list`)
                    .append($(`.task-card[data-id="${taskId}"]`));
                updateColumnCounts();
                checkEmptyStates();
            }

            function updateColumnCounts() {
                $('.column').each(function() {
                    const count = $(this).find('.task-card').length;
                    $(this).find('.column-count').text(count);
                });
            }

            function checkEmptyStates() {
                $('.column').each(function() {
                    const $taskList = $(this).find('.task-list');
                    const $emptyState = $taskList.find('.empty-state');
                    $emptyState.toggle($taskList.find('.task-card').length === 0);
                });
            }

            function showAlert(message, type) {
                const $alert = $(`<div class="notification ${type}">${message}</div>`);
                $('body').append($alert);
                setTimeout(() => $alert.remove(), 3000);
            }

            $('#task-search').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                $('.task-card').each(function() {
                    const title = $(this).find('.task-title').text().toLowerCase();
                    $(this).toggle(title.includes(searchTerm));
                });
                checkEmptyStates();
            });

            initializeDragAndDrop();
            checkEmptyStates();
        });
    </script>
@endsection
