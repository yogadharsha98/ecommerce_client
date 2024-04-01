<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('components.css')

    <style type='text/css'>
        @media (max-width: 576px) {
            .col-md-6 {
                flex: 0 0 33%;
                /* Three products per row */
                max-width: 33%;
            }
        }

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

        <h1 class="text-center text-white display-6">Orders</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    {{-- <div class="container-fluid contact py-5">
        <div class="table-responsive mt-2 mb-5">
            <table class="table d-md-table" style="font-size: 12px">
                <thead>
                    <tr>

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

                        <th scope="col">Payment status</th>
                        <th scope="col">Delivery status</th>
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
                    @foreach($order as $order)
                    <tr>

                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->case}}</td>
                        <td>{{$order->total_unit_price}}</td>
                        <td>{{$order->total_case_price}}</td>
                        <td>{{$order->bcqty1}}</td>
                        <td>{{$order->total_bulk1_price}}</td>
                        <td>{{$order->bcqty2}}</td>
                        <td>{{$order->total_bulk2_price}}</td>
                        <td>{{$order->bcqty3}}</td>
                        <td>{{$order->total_bulk3_price}}</td>

                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td>handle</td>


                    </tr>
                    <?php 
                            $totalUnitPrice += $order->total_unit_price;
                            $totalCasePrice += $order->total_case_price;
                            $totalbulk1Price += $order->total_bulk1_price;
                            $totalbulk2Price += $order->total_bulk2_price;
                            $totalbulk3Price += $order->total_bulk3_price;
            
                            $total_amount = $totalUnitPrice + $totalCasePrice + $totalbulk1Price + $totalbulk2Price + $totalbulk3Price;
                        ?>
                    @endforeach

                </tbody>
            </table>
            <h5>Total amount: {{$total_amount}}</h5>
        </div>
    </div> --}}


    <div class="container-fluid">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-10 mx-auto align-items-center">
                    @if ($order->isEmpty())
                    <div class="d-flex flex-column align-items-center">
                        <p class="text-center">Your order is empty</p>
                        <a href="{{url('departments')}}" class="btn btn-primary">
                            Continue shopping
                        </a>

                    </div>

                    @else
                    <?php 
                            $totalCasePrice = 0;
                            $totalUnitPrice = 0;
                            $totalbulk1Price = 0;
                            $totalbulk2Price = 0;
                            $totalbulk3Price = 0;
                            $total_amount = 0;
                        ?>
                    @foreach($order as $order)
                    <div class="row align-items-center gap-4 mb-3 border rounded"
                        style="background-color: #ffffff; padding: 10px;">
                        <div class="col-md-3 col-lg-2">
                            @foreach ($order->productImages as $image)
                            <img src="{{ asset($image->large_image) }}" alt="Product Image" class="product-image">
                            @endforeach
                        </div>
                        <div class="col-md-3 col-lg-7">
                            <ul style="list-style-type: none;">
                                <li style="text-decoration: none; margin-bottom: 10px;">
                                    <h4 style="color:red">{{$order->product_title}}</h4>
                                </li>
                                @if(isset($order->quantity) && $order->quantity > 0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Quantity: {{$order->quantity}}
                                </li>
                                @endif
                                @if(isset($order->case) && $order->case > 0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Case: {{ $order->case }}</li>
                                @endif
                                @if(isset( $order->total_unit_price) && $order->total_unit_price>0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Total unit price:
                                    <i class="fas fa-pound-sign"></i> {{
                                    $order->total_unit_price }}

                                </li>

                                @endif
                                @if(isset( $order->total_case_price) && $order->total_case_price>0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Total case price:
                                    <i class="fas fa-pound-sign"></i>{{
                                    $order->total_case_price }}

                                </li>

                                @endif
                                @if(isset($order->bcqty1) && $order->bcqty1 > 0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Bulk 1 quantity: {{
                                    $order->bcqty1 }}</li>
                                <li style="text-decoration: none;margin-bottom: 10px;">Total bulk 1 price: <i
                                        class="fas fa-pound-sign"></i>{{
                                    $order->total_bulk1_price
                                    }}
                                </li>
                                @endif
                                @if(isset($order->bcqty2) && $order->bcqty2 > 0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Bulk 2 quantity: {{
                                    $order->bcqty2 }}</li>
                                <li style="text-decoration: none;margin-bottom: 10px;">Total bulk 2 price: <i
                                        class="fas fa-pound-sign"></i> {{
                                    $order->total_bulk2_price
                                    }}
                                </li>
                                @endif
                                @if(isset($order->bcqty3) && $order->bcqty3 > 0)
                                <li style="text-decoration: none;margin-bottom: 10px;">Bulk 3 quantity: {{
                                    $order->bcqty3 }}</li>
                                <li style="text-decoration: none;margin-bottom: 10px;">Total bulk 3 price: <i
                                        class="fas fa-pound-sign"></i>{{
                                    $order->total_bulk3_price
                                    }}
                                </li>
                                @endif

                                <li style="text-decoration: none;margin-bottom: 10px; color:rgb(0, 205, 0)">Payment
                                    status:
                                    {{
                                    $order->payment_status }}

                                </li>

                                <li style="text-decoration: none;margin-bottom: 10px;  color:rgb(210, 162, 4)">Delivery
                                    status:
                                    {{
                                    $order->delivery_status }}

                                </li>
                                <!-- Add other product details as list items -->
                            </ul>
                        </div>
                        <div class="col-md-3 col-lg-2">
                            <a class="btn btn-danger" onclick="return confirm('Are you sure want to cancel order?')"
                                style="font-size:15px" href="{{ url('/cancel_order', $order->id) }}">Cancel order</a>
                        </div>
                    </div>
                    <?php 
                    $totalUnitPrice += $order->total_unit_price;
                    $totalCasePrice += $order->total_case_price;
                    $totalbulk1Price += $order->total_bulk1_price;
                    $totalbulk2Price += $order->total_bulk2_price;
                    $totalbulk3Price += $order->total_bulk3_price;
    
                    $total_amount = $totalUnitPrice + $totalCasePrice + $totalbulk1Price + $totalbulk2Price + $totalbulk3Price;
                ?>
                    @endforeach

                </div>

                <div class="row g-2">
                    <div class="col-lg-12 d-flex justify-content-end">
                        <div class="col-lg-3">
                            <h2 style="color:red"><i class="fas fa-pound-sign"></i> {{$total_amount}}.00</h2>
                            <a href="{{url('place_order')}}"
                                class="btn border-secondary  rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ">Proceed
                                to
                                Checkout</a>
                        </div>

                    </div>
                </div>
                @endif
            </div>
            <div>
            </div>
        </div>
    </div>



    <!-- Footer Start -->
    @include('components.footer')
    <!-- Footer End -->

    <!-- Copyright Start -->
    @include('components.copyrights')
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