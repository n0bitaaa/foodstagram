<nav class="navbar navbar-expand-lg">
  <div class="container-fluid mt-1">
    <a class="navbar-brand" href="{{ url('/')}}"><img src="{{asset('images/brand.png')}}" alt="brand_logo"></a>
    <a class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars text-white"></i>
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto" id="nav-middle">
        <li class="nav-item">
            <a class="nav-link rounded-pill px-4" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link rounded-pill px-4" href="{{ url('/shop') }}">Shop</a>
        </li>
        <li class="nav-item">
            <a class="nav-link rounded-pill px-4" href="{{ url('/orders') }}">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link rounded-pill px-4" href="{{ url('/about') }}">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link rounded-pill px-4" href="{{ url('/contact') }}">Contact</a>
        </li>
      </ul>

      <ul class="navbar-nav" id="login">
      @auth('customer')
            <li class="nav-item" id="name">
                <a href="{{ route('profile') }}"><img src="{{ Auth::guard('customer')->user()->image }}" width="35px" height="35px" class="rounded-pill" alt="customer_profile">&nbsp;&nbsp;{{ Auth::guard('customer')->user()->name }}</a>
            </li>
            <li class="nav-item">
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout btn btn-primary rounded-pill" onclick="return confirm('Are you sure to logout?')">Logout</button>
                </form>
            </li>
        @else
          <li class="nav-item">
              <a class="btn btn-primary rounded-pill" href="{{route('login.customer')}}">Login</a>
          </li>
          <li class="nav-item">
              <a class="btn btn-primary rounded-pill" href="{{route('register.customer')}}">Register</a>
          </li>
        @endauth
          <li class="nav-item mt-1">
              <a href="{{url('/cart')}}" style="text-decoration:none;">
                  <span id="cart-badge" class="badge rounded-pill bg-warning">0</span>&nbsp;
                  <i class="fas fa-shopping-cart" id="nav-cart"></i>
              </a>
          </li>
      </ul>
    </div>
  </div>
</nav>