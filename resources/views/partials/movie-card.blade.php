 <div class="card mb-4">
    <div class="card-body">
        <h2 class="card-title h5">{{ $movie->title }}</h2>
        <p class="card-text">{{ $movie->description }}</p>
        <p class="text-muted small">Posted by: {{ $movie->user->name }}</p>
    </div>
</div>
