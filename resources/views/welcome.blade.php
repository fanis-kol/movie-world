@extends('layouts.movie')

@section('title', 'Home')

@section('content')
    <header class="mb-4">
        @if (Route::has('login'))
            <nav class="d-flex justify-content-end gap-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary btn-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-link btn-sm">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">Welcome to Movie World</h1>
        <p class="lead text-muted">Your favorite movies all in one place.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            @foreach ($movies as $movie)
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title h5">{{ $movie->title }}</h2>
                        <p class="card-text">{{ $movie->description }}</p>
                        <p class="text-muted small">Posted by: {{ $movie->user->name }}</p>
                    </div>
                </div>
            @endforeach

            <div class="mt-4">
                {{ $movies->links() }}
            </div>
        </div>
    </div>
@endsection

