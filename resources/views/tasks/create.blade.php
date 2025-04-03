<div class="modal-overlay" id="task-modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Создать новую задачу</h3>
            <button class="close-modal">&times;</button>
        </div>
        <form method="POST" action="{{ route('tasks.store') }}" id="task-form">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="title">Заглавие</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
                    @error('title')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Описание</label>
                    <textarea class="form-control" name="description" id="description"
                              rows="4">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="type">Тип</label>
                    <select class="form-control" name="type" id="type" required>
                        <option value="task" {{ old('type') === 'task' ? 'selected' : '' }}>Task</option>
                        <option value="story" {{ old('type') === 'story' ? 'selected' : '' }}>Story</option>
                        <option value="bug" {{ old('type') === 'bug' ? 'selected' : '' }}>Bug</option>
                    </select>
                    @error('type')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="priority">Приоритет</label>
                    <select class="form-control" name="priority" id="priority" required>
                        <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Низкий</option>
                        <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Средний</option>
                        <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>Высокий</option>
                    </select>
                    @error('priority')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="assignee">Правопреемник</label>
                    <input type="text" class="form-control" name="assignee" id="assignee" value="{{ old('assignee') }}"
                           required>
                    @error('assignee')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="status">Статус</label>
                    <select class="form-control" name="status" id="status" required>
                        <option value="todo" {{ old('status') === 'todo' ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="done" {{ old('status') === 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                    @error('status')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal">Отмена</button>
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </form>
    </div>
</div>

