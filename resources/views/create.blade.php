@extends('layout')

@section('title', 'Create new task')

@section('content')

    <div id="create-content">
        <form method="POST" action="{{ route('tasks.store') }}" autocomplete="off">
            @csrf

            <input
                class="input @error('name') is-invalid @enderror"
                name="name"
                type="text"
                placeholder="Name / Description"
                maxlength="100"
                required
            >

            <button id="submit-btn" type="submit">Send</button>
        </form>
    </div>

@endsection
