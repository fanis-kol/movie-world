@extends('layouts.movie')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-4 mx-auto">
        <form action="" method="POST" class="mb-4">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Movie Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Movie Description</label>
                <textarea name="description" id="description" rows="4" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Movie</button>
        </form>
    </div>
</div>
@endsection
