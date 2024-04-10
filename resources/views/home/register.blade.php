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

    @include('components.navbar')


    <div class="container" style="margin-top: 150px">
        <form style="max-width: 400px; margin: 0 auto;" method="Post" action="/customer">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" name='name' id="exampleInputEmail1" aria-describedby="emailHelp"
                    value="{{old('name')}}">
                {{-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> --}}
                @error('name')
                <p class="text-red-500 text-xs mt-1" style="color: red;">{{$message}}</p>
                @enderror
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
                <label for="exampleInputEmail1" class="form-label">Phone</label>
                <input type="text" class="form-control" name='phone' aria-describedby="emailHelp"
                    value="{{old('phone')}}">
                @error('phone')
                <p class="text-red-500 text-xs mt-1" style="color: red;">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Address</label>
                <input type="text" class="form-control" name='address' aria-describedby="emailHelp"
                    value="{{old('address')}}">
                @error('address')
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

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
                @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1" style="color: red;">{{$message}}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Sign Up</button>
            <p class="mt-3">Already have an account?
                <a href="/login">Login</a>
            </p>
        </form>
    </div>

    <!-- Copyright Start -->
    @include('components.copyrights')
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


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