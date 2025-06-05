<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h2 class="card-title h5">{{ $movie->title }}</h2>
            <p class="card-date">{{ $movie->created_at->format('d-m-Y') }} </p>
        </div>
        <p class="card-text">{{ $movie->description }}</p>
        <div class="d-flex justify-content-between small">
            <div>
                Likes: {{ $movie->likes_count }} | Hates: {{ $movie->hates_count }}
            </div>
            <div class="text-muted">
                Posted by:
                <a href="{{ url('/?user_id=' . $movie->user->id . '&sort=' . request('sort')) }}" class="">
                    {{ $movie->user->name }}
                </a>
            </div>
        </div>
    </div>
</div>
