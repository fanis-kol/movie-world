<nav class="navbar navbar-expand-lg navbar-light bg-light px-1 px-sm-3">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <!-- Left side: Movie World title -->
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">
      MovieWorld
    </a>

    <div class="d-flex flex-column align-items-end">
      <div class="d-flex gap-2">
        <a href="{{ route('new.movie') }}" class="btn btn-outline-primary btn-sm">Add Movie</a>
        @auth
          <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
            @csrf
            <button type="submit" class="btn btn-outline-primary btn-sm">Logout</button>
          </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">Register</a>
        @endauth
      </div>
      @auth
        <small class="text-muted mt-1">{{ auth()->user()->name }}</small>
      @endauth
    </div>
  </div>
</nav>
