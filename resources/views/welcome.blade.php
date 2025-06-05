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

    <div class="row text-center mb-5">
        <h1 class="display-5 fw-bold">Welcome to Movie World</h1>
        <p class="lead text-muted">Our complete movie list — <span class="fw-bold">{{$allMovies}}</span> titles.</p>
    </div>

    <div class="row">
        <form id="filter-form" class="text-end col-10 mx-auto" method="GET" class="mb-3">
            <select name="sort" id="sort" class="form-select w-auto d-inline-block">
                <option value="" selected >Newest</option>
                <option value="likes" {{ request('sort') === 'likes' ? 'selected' : '' }}>Most Liked</option>
                <option value="hates" {{ request('sort') === 'hates' ? 'selected' : '' }}>Most Hated</option>
            </select>
        </form>

        @if(request()->filled('user_id'))
            <input type="hidden" name="user_id" value="{{ request('user_id') }}">
        @endif
    </div>

    <div class="row justify-content-center">
        <div id="movie-list" class="col-lg-10">
            @foreach ($movies as $movie)
                @include('partials.movie-card', ['movie' => $movie])
            @endforeach
        </div>
    </div>

@endsection


<script>
    let currentPage = 1;
    let loading = false;
    let currentSort = '';
    let currentUserId = '';

    document.addEventListener('DOMContentLoaded', function () {
        currentSort = document.getElementById('sort');

        const urlParams = new URLSearchParams(window.location.search);
        currentUserId = urlParams.get('user_id') || '';

        if (currentSort) {
            currentSort.addEventListener('change', function () {
                document.getElementById('filter-form').submit();
            });
        }
    });

    window.addEventListener('scroll', () => {
        const scrollPosition = window.scrollY + window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;

        if (scrollPosition + 100 >= documentHeight && !loading) {
            loading = true;
            currentPage++;

            let url = `/load-more?page=${currentPage}&sort=${encodeURIComponent(currentSort.value)}`;
            if (currentUserId) {
                url += `&user_id=${encodeURIComponent(currentUserId)}`;
            }

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('movie-list')
                        .insertAdjacentHTML('beforeend', html);
                })
                .finally(() => {
                    loading = false;
                });
        }
    });

</script>
