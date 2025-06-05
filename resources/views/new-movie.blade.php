@extends('layouts.movie')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-4 mx-auto">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form id="movie-form" action="{{ route('store.movie') }}" method="POST" class="mb-4">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Movie Title</label>
                    <input type="text" name="title" id="title" class="form-control" maxlength="60" required>
                    <small class="text-muted">Max 60 characters</small>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Movie Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control" maxlength="250" required></textarea>
                    <small class="text-muted">Max 250 characters</small>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Add Movie</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('movie-form');

    form.addEventListener('submit', function (e) {
        const title = document.getElementById('title');
        const description = document.getElementById('description');

        let errors = [];

        if (title.value.length > 60) {
            errors.push('Title must be 60 characters or fewer.');
        }

        if (description.value.length > 250) {
            errors.push('Description must be 250 characters or fewer.');
        }

        if (errors.length > 0) {
            e.preventDefault();
            alert(errors.join('\n'));
        }
    });
});
</script>
@endsection
