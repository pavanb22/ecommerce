<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container">
    <a class="navbar-brand" href="/">E-Com</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('category') ? 'active':'' }}" href="/category">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('cart') ? 'active':'' }}" href="/cart">Cart
            <span class="badge badge-danger badge-counter bg-danger cart-count">0</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('wishlist') ? 'active':'' }}" href="/wishlist">Wishlist
          <span class="badge badge-danger badge-counter bg-danger wishlist-count">0</span></a>
        </li>
        @guest
          @if (Route::has("login"))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login')}}">{{ __('Login') }}</a>
            </li>
          @endif
          @if (Route::has("register"))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register')}}">{{ __('Register') }}</a>
            </li>
          @endif
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarbellDropdown" role="button"  data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i>
            @if(Auth::user()->unreadNotifications->count())
              <span class="badge badge-danger badge-counter bg-danger">{{Auth::user()->unreadNotifications->count()}}</span>
            @endif
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarbellDropdown">
              @php $count = 1; @endphp
              @foreach(Auth::user()->unreadNotifications as $notification)
                @if ($count <= 3)
                  <li><a class="dropdown-item fw-bold" href="/view-order/{{$notification->data['order_id']}}/{{$notification->id}}"><i class="fa fa-check mr-2"></i> {{$notification->data['data']}}</a></li>
                  @php $count++; @endphp
                @endif
              @endforeach
              @foreach(Auth::user()->readNotifications as $notification)
                @if ($count <= 3)
                  <li><a class="dropdown-item" href="/view-order/{{$notification->data['order_id']}}/{{$notification->id}}"><i class="fa fa-check mr-2"></i> {{$notification->data['data']}}</a></li>
                  @php $count++; @endphp
                @endif
              @endforeach
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"  data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/profile">My Profile</a></li>
              <li><a class="dropdown-item" href="/my-orders">My Orders</a></li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
        @endguest
        </li>
      </ul>
    </div>
  </div>
</nav>