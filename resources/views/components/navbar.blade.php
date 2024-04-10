<div class="container-fluid fixed-top">
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="/" class="navbar-brand">
                <h1 class="text-primary display-6">Samson's</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="/" class="nav-item nav-link active">Home</a>
                    <a href="{{url('/products')}}" class="nav-item nav-link">Products</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($departments as $de)
                            <li><a href="{{ url('category', $de->id) }}" class="dropdown-item">{{ $de->department_title
                                    }}</a></li>
                            @endforeach
                            <li><a href="{{url('/departments')}}" class="dropdown-item">All categories</a></li>
                        </ul>
                    </div>
                    <a href="{{url('contactus')}}" class="nav-item nav-link">Contact</a>
                    <a href="{{url('show_order')}}" class="nav-item nav-link">Orders</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <!-- Search button -->
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                        data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search text-primary"></i>
                    </button>
                    <!-- Shopping cart -->
                    <!-- Navbar -->
                    <a href="{{ url('show_cart') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>

                        @php
                        $cartCount = session('cartCount') ?? 0;
                        @endphp
                        <!-- Pass the cart count to the Livewire component -->
                        <span
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                            {{$cartCount}}
                        </span>
                    </a>

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{url('cart')}}">
                            <i class="fa fa-shopping-cart"></i> Cart (
                            <livewire:livewire.cart.cart-count />)
                        </a>
                    </li> --}}


                    <script>
                        // Get the cart count from the session
                        let cartCount = {{ session('cartCount') ?? 0 }};
        
                        // Update the cart count in the navbar
                        document.getElementById('cartCount').innerText = cartCount;
                        
                    </script>

                    <!-- User account or sign-in button -->
                    @auth('customer')
                    @if (session('customer'))
                    <a href="{{url('myaccount')}}" class="my-auto">
                        <i class="fas fa-user fa-2x"></i>
                    </a>
                    <p class="my-auto">{{ session('customer')->name }}</p>
                    <form class="inline ms-4" method="Post" action="/logout">
                        @csrf
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        <button type="submit" class="btn btn-warning">Logout</button>
                    </form>
                    @endif
                    @else
                    <a href="/login" class="my-auto">
                        <button class="btn btn-warning">SignIn</button>
                    </a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</div>