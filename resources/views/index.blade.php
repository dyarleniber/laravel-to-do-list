@extends('layout')

@section('title', 'Tasks')

@section('content')

    <div id="index-content">
        @if ($tasks)
            <div class="grid">
                <div>
                    <strong class="grid-header">Task</strong>
                </div>
                <div></div>
                @foreach ($tasks as $task)
                    <div>
                        <p>{{ $task->name }}</p>
                    </div>
                    <div class="grid-actions">
                        <button type="button" class="grid-item-check" aria-label="Check task" title="Check task"></button>
                        <button type="button" class="grid-item-view" aria-label="View task" title="View task"></button>
                        <button type="button" class="grid-item-edit" aria-label="Edit task" title="Edit task"></button>
                        <button type="button" class="grid-item-remove" aria-label="Remove task" title="Remove task"></button>
                    </div>
                @endforeach
                <div class="grid-links">
                    {{ $tasks->links() }}
                </div>
                <div></div>
            </div>
        @endif
    </div>

@endsection
