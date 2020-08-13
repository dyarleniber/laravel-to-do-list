@extends('layout')

@section('title', 'Create new task')

@section('content')

    <div id="create-content">
        <form method="POST" action="{{ route('tasks.store') }}" autocomplete="off">
            @csrf

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
            >

            <button id="submit-btn" type="submit">Send</button>
        </form>
    </div>

@endsection
