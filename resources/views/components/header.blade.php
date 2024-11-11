<header class="navbar">
    <div class="container">
        <div class="logo">WatchStore</div>
        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">Collections</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <div class="icons">
            @auth
            <div class="dropdown d-inline">
                <a class="link-light dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    👤 {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('orders') }}">Orders</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            <a href="{{ route('cart.view') }}" class="icon">🛒({{ Auth::user()->cartItems->count() }})</a>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="icon">👤 Login</a>
                <a href="{{ route('register') }}" class="icon">📝 Register</a>
            @endguest
        </div>
    </div>
</header>
