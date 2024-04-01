<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.css')

    <style type='text/css'>

    </style>
</head>

<body>
    <div>
        @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>




    <div class="container" style="margin-top: 120px">

        <form style="max-width: 400px; margin: 0 auto;" method="Post" action="/customer/authenticate">
            @csrf
            <div class="text-center">
                <h5 class="mb-2" style="margin-top:80px">Login</h5>
                <p class="mb-2">Log into your account</p>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name='email' aria-describedby="emailHelp"
                    value="{{old('email')}}">
                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                @error('email')
                <p class="text-red-500 text-xs mt-1" style="color: red;">{{$message}}</p>
                @enderror
            </div>


            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" value="{{old('password')}}">
                @error('password')
                <p class="text-red-500 text-xs mt-1" style="color: red;">{{$message}}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Sign In</button>
            <p class="mt-3">Don't have an account?
                <a href="/register">Register</a>
            </p>
        </form>

    </div>

    <!-- Copyright Start -->
    <div class="fixed-bottom">
        @include('components.copyrights')
    </div>

    <!-- Copyright End -->



    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="home/lib/easing/easing.min.js"></script>
    <script src="home/lib/waypoints/waypoints.min.js"></script>
    <script src="home/lib/lightbox/js/lightbox.min.js"></script>
    <script src="home/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="home/js/main.js"></script>
</body>

</html>