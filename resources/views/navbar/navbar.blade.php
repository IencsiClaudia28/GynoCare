
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  @if(empty(Auth::user()) || !Auth::user()->isAdmin())
    <a class="navbar-brand" href="{{ route('home') }}">GynoCare</a>
  @else
    <a class="navbar-brand" href="{{ route('admin.home') }}">GynoCare</a>
  @endif
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">Înregistrare</a>
      </li>
      @endguest
      @auth
        @switch(Auth::user()->userType->type)
          @case('DOCTOR')
            @include('navbar.doctorNavbar')
            @break
          @case('CUSTOMER')
            @include('navbar.customerNavbar')
            @break
          @case('ADMIN')
            @include('navbar.adminNavbar')
            @break
        @endswitch
      <li class="nav-item">
        <a class="nav-link" href="/logout">Logout</a>
      </li>
      @endauth
    </ul>
  </div>
</nav>