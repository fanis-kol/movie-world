<div class="card mb-4">
    <div class="card-body">
        <h2 class="card-title h5">{{ $movie->title }}</h2>
        <p class="card-text">{{ $movie->description }}</p>
        <div class="d-flex justify-content-between small">
            <div>
                Likes: {{ $movie->likes_count }} | Hates: {{ $movie->hates_count }}
            </div>
            <div class="text-muted">
                Posted by: {{ $movie->user->name }}
            </div>
        </div>
    </div>
</div>
