@extends('layout')

@section('title', 'Tasks')

@section('actions')
    <button
        type="button"
        id="create-btn"
        aria-label="Go to the create page"
        title="Go to the create page"
        onclick="window.location.href='{{ route('tasks.create') }}';"
    >
        Create task
    </button>
@endsection

@section('content')

    <div id="index-content">
        <div class="grid">
            <div class="grid-header">
                <strong>Task</strong>
            </div>
            @if (!empty($tasks))
                @foreach ($tasks as $task)
                    <div>
                        <p>{{ $task->name }}</p>
                    </div>
                    <div class="grid-actions">
                        <form action="{{ route('tasks.check', ['id' => $task->id]) }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="grid-item-check"
                                aria-label="Check task"
                                title="Check task"
                            ></button>
                        </form>
                        <button
                            type="button"
                            class="grid-item-view"
                            aria-label="View task"
                            title="View task"
                            onclick="window.location.href='{{ route('tasks.show', ['id' => $task->id]) }}';"
                        ></button>
                        <button
                            type="button"
                            class="grid-item-edit"
                            aria-label="Edit task"
                            title="Edit task"
                            onclick="window.location.href='{{ route('tasks.edit', ['id' => $task->id]) }}';"
                        ></button>
                        <form action="{{ route('tasks.destroy', ['id' => $task->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button
                                type="submit"
                                class="grid-item-remove"
                                aria-label="Remove task"
                                title="Remove task"
                            ></button>
                        </form>
                    </div>
                @endforeach
                <div class="grid-links">
                    {{ $tasks->links() }}
                </div>
            @else
                <div class="grid-norecords">
                    <span>No records found.</span>
                </div>
            @endif
        </div>
    </div>

@endsection
