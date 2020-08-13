<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel to-do list</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    </head>
    <body>
        <div>
            <header>
                <a class="inherit-link" href="{{ route('tasks.index') }}">
                    Laravel to-do list
                </a>
            </header>
            <div class="container">
                <main>
                    <h1>@yield('title')</h1>

                    @if (Route::currentRouteName() !== 'tasks.index')
                        <a id="back-link" class="inherit-link" href="{{ route('tasks.index') }}">
                            Back
                        </a>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="alert-message">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p class="alert-message">{{ $message }}</p>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p class="alert-message">{{ $message }}</p>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
