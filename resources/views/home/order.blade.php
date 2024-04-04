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

        <h1 class="text-center text-white display-6">Orders</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    {{-- <div class="container contact py-5">
        <div class="table-responsive mt-2 mb-5">



        </div>
    </div> --}}


    <div class="container-fluid">
        <div class="container py-5">
            @if ($order->isEmpty())
            <div class="d-flex flex-column align-items-center">
                <p class="text-center">Your order is empty</p>
                <a href="{{url('departments')}}" class="btn btn-primary">
                    Continue shopping
                </a>
            </div>
            @else
            <div class="row">
                <div class="col-lg-12">
                    @foreach($order as $order)

                    <div class="row g-1 mb-5 mt-2 border-bottom border-top">

                        <div class="col-lg-1">
                            @foreach ($order->productImages as $image)
                            <img src="{{ asset($image->large_image) }}" alt="Product Image" class="product-image">
                            @endforeach
                        </div>

                        <div class="col-lg-3 d-flex flex-column">
                            <h5>{{$order->product_title}}</h5>
                            @if(isset($order->case) && $order->case > 0)
                            Case: {{$order->case}}
                            <br />
                            @endif
                            @if(isset($order->quantity) && $order->quantity > 0)
                            Quantity: {{$order->quantity}}
                            <br />
                            @endif
                            <div class="trapezoid-right">
                                @if(isset($order->bcqty1) && $order->bcqty1 > 0)
                                Bulk1: {{$order->bcqty1}}
                                <br />
                                @endif
                            </div>
                            @if(isset($order->bcqty2) && $order->bcqty2 > 0)
                            Bulk2: {{$order->bcqty2}}
                            <br />
                            @endif
                            @if(isset($order->bcqty3) && $order->bcqty3 > 0)
                            Bulk3:{{$order->bcqty3}}
                            @endif
                        </div>


                        <div class="col-lg-2 ">
                            <p>VAT: {{$order->vat}}%</p>
                        </div>

                        <div class="col-lg-2 d-flex flex-column">
                            <p style="color: rgb(5, 206, 5)">{{$order->payment_status}}</p>
                            <p style="color:red"><i class="fas fa-pound-sign "></i>{{$order->total_amount}} (ex vat)</p>

                            <p>RSP: <i class="fas fa-pound-sign"></i>{{$order->product->por}}</p>
                            <p>POR: {{$order->product->por}}%</p>
                            {{-- <p style="color:red"><i class="fas fa-pound-sign "></i>{{$totalPriceWithVat}} (inc vat)
                            </p> --}}
                        </div>

                        <div class="col-lg-2 ">
                            <div class="px-3 rounded py-0"
                                style="width: max-content;background-color: rgb(227, 227, 227);">
                                <p>{{$order->delivery_status}}</p>

                            </div>

                        </div>
                        <div class="col-lg-2">
                            <a class="btn btn-danger" onclick="return confirm('Are you sure want to cancel order?')"
                                style="font-size:12px" href="{{ url('/cancel_order', $order->id) }}">Cancel
                                order</a>
                        </div>

                    </div>
                    @endforeach

                    <div class="row g-2">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <div class="col-lg-3">
                                {{-- <h3 style="color:red"><i class="fas fa-pound-sign fs-4 ms-5"></i> {{
                                    number_format($total_amount, 2) }}</h3> --}}

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            @endif
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