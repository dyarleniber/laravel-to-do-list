@extends('layout')

@section('title', 'Create new task')

@section('back', 'true')

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

            <button id="submit-btn" type="submit" aria-label="Submit form" title="Submit form">Send</button>
        </form>
    </div>

@endsection
