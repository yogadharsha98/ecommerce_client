<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('components.css')
    <style type='text/css'>
        .product-image,
        .product-thumbnail {
            width: 150px;
            height: 150px;
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

    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-10 mx-auto align-items-center">
                    @if ($cart->isEmpty())
                    <div class="d-flex flex-column align-items-center">
                        <p class="text-center">Your cart is empty</p>
                        <a href="{{url('departments')}}" class="btn btn-primary">
                            Continue shopping
                        </a>

                    </div>

                    @else
                    @foreach ($cart as $cartItem)
                    <div class="row align-items-center gap-4 mb-3 border rounded"
                        style="background-color: #ffffff; padding: 10px;">
                        <div class="col-md-3 col-lg-2">
                            @foreach($cartItem->product_images as $image)
                            <img src="{{ asset($image->large_image) }}" alt="Product Image" class="product-image">
                            @endforeach
                        </div>
                        <div class="col-md-3 col-lg-7">
                            <ul style="list-style-type: none;">
                                <li style="text-decoration: none; margin-bottom: 10px;">
                                    <h4 style="color:red">{{ $cartItem->product_title }}</h4>
                                </li>
                                @if(isset($cartItem->quantity) && $cartItem->quantity > 0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Quantity: {{ $cartItem->quantity
                                    }}</li>
                                @endif
                                @if(isset($cartItem->case) && $cartItem->case > 0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Case: {{ $cartItem->case }}</li>
                                @endif
                                @if(isset( $cartItem->unit_price) && $cartItem->unit_price>0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Unit price:
                                    <i class="fas fa-pound-sign"></i> {{
                                    $cartItem->unit_price }}

                                </li>

                                @endif
                                @if(isset( $cartItem->case_price) && $cartItem->case_price>0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Case price:
                                    <i class="fas fa-pound-sign"></i>{{
                                    $cartItem->case_price }}

                                </li>

                                @endif
                                @if(isset($cartItem->bcqty1) && $cartItem->bcqty1 > 0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Bulk 1 quantity: {{
                                    $cartItem->bcqty1 }}</li>
                                <li style="text-decoration: none;margin-bottom: 10px;">Total bulk 1 price: <i
                                        class="fas fa-pound-sign"></i>{{
                                    $cartItem->total_bulk1_price
                                    }}
                                </li>
                                @endif
                                @if(isset($cartItem->bcqty2) && $cartItem->bcqty2 > 0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Bulk 2 quantity: {{
                                    $cartItem->bcqty2 }}</li>
                                <li style="text-decoration: none;margin-bottom: 10px;">Total bulk 2 price: <i
                                        class="fas fa-pound-sign"></i> {{
                                    $cartItem->total_bulk2_price
                                    }}
                                </li>
                                @endif
                                @if(isset($cartItem->bcqty3) && $cartItem->bcqty3 > 0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Bulk 3 quantity: {{
                                    $cartItem->bcqty3 }}</li>
                                <li style="text-decoration: none;margin-bottom: 10px;">Total bulk 3 price: <i
                                        class="fas fa-pound-sign"></i>{{
                                    $cartItem->total_bulk3_price
                                    }}
                                </li>
                                @endif
                                <!-- Add other product details as list items -->
                            </ul>
                        </div>
                        <div class="col-md-3 col-lg-1">
                            <a class="btn btn-danger" onclick="return confirm('Are you sure to remove this product?')"
                                style="font-size:15px" href="{{ url('/remove_cart', $cartItem->id) }}">Remove</a>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="row g-2">
                    <div class="col-lg-12 d-flex justify-content-end">
                        <div class="col-lg-3">
                            <a href="{{url('place_order')}}"
                                class="btn border-secondary  rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">Proceed
                                to
                                Checkout</a>
                        </div>

                    </div>
                </div>
                @endif
            </div>


            {{-- <div class="table-responsive">
                <table class="table d-md-table" style="font-size: 12px">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Case</th>
                            <th scope="col">Quantity price</th>
                            <th scope="col">Case price</th>
                            <th scope="col">Bulk1</th>
                            <th scope="col">Bulk1 price</th>
                            <th scope="col">Bulk2</th>
                            <th scope="col">Bulk2 price</th>
                            <th scope="col">Bulk3</th>
                            <th scope="col">Bulk3 price</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $totalCasePrice = 0;
                            $totalUnitPrice = 0;
                            $totalbulk1Price = 0;
                            $totalbulk2Price = 0;
                            $totalbulk3Price = 0;
                            $total_amount = 0;
                        ?>
                        @if ($cart->isEmpty())
                        <tr>
                            <td colspan="10" class="text-center">Your cart is empty</td>
                        </tr>
                        @else
                        @foreach ($cart as $cart)
                        <tr>
                            <td>
                                @foreach($cart->product_images as $image)
                                <img src="{{ asset($image->large_image) }}" alt="Product Image" class="product-image">
                                @endforeach
                            </td>
                            <td>{{ $cart->product_title }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>{{ $cart->case }}</td>
                            <td>{{ $cart->unit_price }}</td>
                            <td>{{ $cart->case_price }}</td>
                            <td>{{ $cart->bcqty1 }}</td>
                            <td>{{ $cart->total_bulk1_price }}</td>
                            <td>{{ $cart->bcqty2 }}</td>
                            <td>{{ $cart->total_bulk2_price }}</td>
                            <td>{{ $cart->bcqty3 }}</td>
                            <td>{{ $cart->total_bulk3_price }}</td>

                            <td>
                                <a class="btn btn-danger"
                                    onclick="return confirm('Are you sure to remove this product?')"
                                    style="font-size:12px" href="{{ url('/remove_cart', $cart->id) }}">Remove</a>
                            </td>
                        </tr>
                        <?php 
                            $totalUnitPrice += $cart->unit_price;
                            $totalCasePrice += $cart->case_price;
                            $totalbulk1Price += $cart->total_bulk1_price;
                            $totalbulk2Price += $cart->total_bulk2_price;
                            $totalbulk3Price += $cart->total_bulk3_price;
            
                            $total_amount = $totalUnitPrice + $totalCasePrice + $totalbulk1Price + $totalbulk2Price + $totalbulk3Price;
                        ?>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div> --}}




            {{-- <div class="table-responsive">
                <table class="table d-md-none" style="font-size: 12px">
                    <tbody>

                        @foreach($cartForSmartphone as $item)
                        <tr>
                            <td>Product Name</td>
                            <td>{{ $item->product_title }}</td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                        @endforeach

                        <!-- Include other table rows as needed -->
                    </tbody>
                </table>
            </div> --}}


            {{-- <table class="table table-responsive d-md-none ms-5">
                <tbody>

                    <tr>

                        <td>
                            @foreach($cart->product_images as $image)
                            <img src="{{ asset($image->large_image) }}" alt="Product Image" class="product-image">
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Product Title</td>
                        <td>
                            <h4>{{ $cart->product_title}}</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>{{ $cart->quantity}}</td>
                    </tr>
                    <tr>
                        <td>Case</td>
                        <td>{{ $cart->case }}</td>
                    </tr>
                    <tr>
                        <td>Quantity price</td>
                        <td><i class="fas fa-pound-sign"></i> {{ $cart->unit_price }}</td>
                    </tr>
                    <tr>
                        <td>Case price</td>
                        <td><i class="fas fa-pound-sign"></i> {{ $cart->case_price }}</td>
                    </tr>
                    <tr>
                        <td>Bulk 1</td>
                        <td>{{ $cart->bcqty1 }}</td>
                    </tr>
                    <tr>
                        <td>Bulk 1 price</td>
                        <td><i class="fas fa-pound-sign"></i> {{ $cart->total_bulk1_price }}</td>
                    </tr>
                    <tr>
                        <td>Bulk 2</td>
                        <td>{{ $cart->bcqty2 }}</td>
                    </tr>
                    <tr>
                        <td>Bulk 2 price</td>
                        <td><i class="fas fa-pound-sign"></i> {{ $cart->total_bulk2_price }}</td>
                    </tr>
                    <tr>
                        <td>Bulk 3</td>
                        <td>{{ $cart->bcqty3 }}</td>
                    </tr>
                    <tr>
                        <td>Bulk 3 price</td>
                        <td><i class="fas fa-pound-sign"></i> {{ $cart->total_bulk3_price }}</td>
                    </tr>

                </tbody>
            </table> --}}

            <div>


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
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By
                    <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
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