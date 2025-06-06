@extends('layouts.movie')

@section('title', 'Home')

@section('content')
    <div class="row text-center mb-5">
        <h1 class="display-6 fw-bold">Welcome to Movie World</h1>
        <p class="lead text-muted">Our complete movie list — <span class="fw-bold">{{$allMovies}}</span> titles.</p>
    </div>

    <div class="row d-flex align-items-center">
        <div class="col-6 col-lg-4 offset-lg-1 text-start">
            <a href="{{ url('/') }}" class="btn btn-outline-dark">Reset Filters</a>
        </div>
        <div class="col-6 text-end">
            <form id="filter-form" method="GET" class="d-inline-block">
                <select name="sort" id="sort" class=" mt-2 form-select w-auto d-inline-block">
                    <option value="" {{ request('sort') === null ? 'selected' : '' }}>Newest</option>
                    <option value="likes" {{ request('sort') === 'likes' ? 'selected' : '' }}>Most Liked</option>
                    <option value="hates" {{ request('sort') === 'hates' ? 'selected' : '' }}>Most Hated</option>
                </select>

                @if(request()->filled('user_id'))
                    <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                @endif
            </form>
        </div>
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


    document.addEventListener('DOMContentLoaded', () => {
        document.body.addEventListener('click', async (e) => {
            if (e.target.classList.contains('vote-btn')) {
            const btn = e.target;
            const movieId = btn.getAttribute('meta-id');
            const voteValue = parseInt(btn.getAttribute('data-vote'));

            try {
                const response = await fetch('/vote', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ movie_id: movieId, vote: voteValue })
                });

                if (!response.ok) throw new Error('Failed to send vote');

                const data = await response.json();
                const movieButtons = document.querySelectorAll(`.vote-btn[meta-id="${movieId}"]`);

                movieButtons.forEach(button => {
                    const btnVote = parseInt(button.getAttribute('data-vote'));
                    button.classList.remove('btn-success', 'btn-danger');

                    if (btnVote === data.currentVote) {
                        if (btnVote === 1) {
                        button.classList.add('btn-success');
                        } else if (btnVote === -1) {
                        button.classList.add('btn-danger');
                        }
                    }


                    document.getElementById(`likes-${movieId}`).textContent = data.likes;
                    document.getElementById(`hates-${movieId}`).textContent = data.hates;
                });


            } catch (error) {
                alert(error.message);
            }
            }
        });
    });

</script>
