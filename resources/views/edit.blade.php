@extends('layout')

@section('title', 'Edit task')

@section('content')

    <div id="edit-content">
        <p class="name">{{ $task->name }}</p>

        <form method="POST" action="{{ route('tasks.update', ['id' => $task->id]) }}" autocomplete="off">
            @csrf
            @method('PUT')

            <label for="name">Name / Description</label>
            <input
                class="input @error('name') is-invalid @enderror"
                id="name"
                name="name"
                type="text"
                placeholder="What needs to be done?"
                maxlength="100"
                required
                autofocus
                value="{{ $task->name }}"
            >

            <label class="checkbox-container">Completed
                <input
                    class="checkbox"
                    type="checkbox"
                    id="check"
                    name="check"
                    value="completed"
                    {{ ($task->completed) ? 'checked' : '' }}
                >
                <span class="checkmark"></span>
            </label>

            <button id="submit-btn" type="submit" aria-label="Submit form" title="Submit form">Send</button>
        </form>
    </div>

@endsection
