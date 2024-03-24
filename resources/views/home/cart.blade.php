<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('components.css')
    <style type='text/css'>
        .product-image,
        .product-thumbnail {
            width: 70px;
            height: 70px;
            /* Adjust this value as needed */
            object-fit: cover;
        }
    </style>
</head>

<body>


    <!-- Navbar start -->
    @include('components.navbar')
    <!-- Navbar End -->

    <!-- Modal Search Start -->
    @include('components.search')
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5" style="background-image: url('img/hero-img-1.png');">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Group</th>
                            <th scope="col">Sub group</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Case</th>
                            <th scope="col">Total quantity price</th>
                            <th scope="col">Total case price</th>
                            <th scope="col">Handle</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php 
                    $totalCasePrice = 0;
                    $totalUnitPrice = 0;
                ?>
                        @foreach ($cart as $cart)
                        <tr>
                            <td>
                                @foreach($cart->product_images as $image)
                                <img src="{{ asset($image->large_image) }}" alt="Product Image" class="product-image">
                                @endforeach

                            </td>
                            <td>
                                {{$cart->product_title}}
                            </td>
                            <td>
                                {{$cart->department_title}}
                            </td>
                            <td>
                                {{$cart->group_title}}
                            </td>
                            <td>
                                {{$cart->sub_group_title}}
                            </td>
                            <td>
                                {{$cart->quantity}}
                            </td>
                            <td>
                                {{$cart->case}}
                            </td>
                            <td>
                                {{$cart->unit_price}}
                            </td>
                            <td>
                                {{$cart->case_price}}
                            </td>
                            <td>
                                <p>Remove</p>
                            </td>

                        </tr>

                        <?php 
                    $totalUnitPrice += $cart->unit_price;
                    $totalCasePrice += $cart->case_price;
                ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Total case price:</h5>
                                <p class="mb-0">{{$totalCasePrice}}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Total unit price:</h5>
                                <div class="">
                                    <p class="mb-0">{{$totalUnitPrice}}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Vat rate:</h5>
                                <div class="">
                                    <p class="mb-0">4545</p>
                                </div>
                            </div>

                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">$99.00</p>
                        </div>
                        <button
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="button">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->


    <!-- Footer Start -->
    @include('components.footer')
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site
                            Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                        class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>