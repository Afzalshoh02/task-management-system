<div class="task-card" draggable="true" data-id="{{ $task->id }}">
    <div class="task-id">TASK-{{ $task->id }}</div>
    <div class="task-title">{{ $task->title }}</div>
    <div class="task-footer">
        <span class="task-type type-{{ $task->type }}">{{ $task->type }}</span>
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <div class="relative flex items-center space-x-3 group">
                <div class="task-priority priority-{{ $task->priority }}
                    h-3 w-3 rounded-full
                    @if($task->priority === 'high') bg-red-500 animate-pulse @endif
                    @if($task->priority === 'medium') bg-yellow-500 @endif
                    @if($task->priority === 'low') bg-green-500 @endif
                    transition-all duration-300 group-hover:scale-125">
                </div>

                <a href="{{ route('tasks.edit', $task->id) }}"
                   class="edit-task p-2 rounded-full transition-all duration-300
                          bg-white bg-opacity-0 hover:bg-opacity-20
                          transform hover:-translate-y-0.5 hover:scale-110
                          focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                   title="Edit Task">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                         class="text-gray-600 group-hover:text-blue-600 transition-colors duration-300"
                         stroke="currentColor" stroke-width="1.5">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>

                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="delete-task p-2 rounded-full transition-all duration-300
                                   bg-white bg-opacity-0 hover:bg-opacity-20
                                   transform hover:-translate-y-0.5 hover:scale-110
                                   focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
                            title="Delete Task"
                            onclick="return confirm('Вы уверены, что хотите удалить это задание?')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                             class="text-gray-600 group-hover:text-red-600 transition-colors duration-300"
                             stroke="currentColor" stroke-width="1.5">
                            <path d="M3 6h18" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
            </div>
            <img
                src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ urlencode($task->assignee) }}"
                alt="{{ $task->assignee }}"
                class="task-avatar"
                width="32"
                height="32"
                style="border-radius: 50%;"
            >
        </div>
    </div>
</div>
