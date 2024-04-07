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

            {{-- @if ($cart->isEmpty())
            <div class="d-flex flex-column align-items-center">
                <p class="text-center">Your cart is empty</p>
                <a href="{{url('departments')}}" class="btn btn-primary">
                    Continue shopping
                </a>

            </div>

            @else
            {{-- <table class="table d-md-table" style="font-size: 14px">
                <thead>
                    <tr>
                        <th scope="col" class="col-sm-5">Product</th>
                        <th scope="col" class="col-sm-1">Bulks</th>
                        <th scope="col" class="col-sm-1">Quantity</th>
                        <th scope="col" class="col-sm-1">Vat</th>
                        <th scope="col" class="col-sm-1">Total</th>

                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody> --}}
                    {{--
                    <?php 
                        $totalCasePrice = 0
                        $totalUnitPrice = 0
                        $totalbulk1Price = 0
                        $totalbulk2Price = 0
                        $totalbulk3Price = 0
                        $total_amount = 0
                    ?>
                    @foreach ($cart as $cartItem)
                    <?php 
                            $totalUnitPrice += $cartItem->unit_price;
                            $totalCasePrice += $cartItem->case_price;
                            $totalbulk1Price += $cartItem->total_bulk1_price;
                            $totalbulk2Price += $cartItem->total_bulk2_price;
                            $totalbulk3Price += $cartItem->total_bulk3_price;
                
                            $total_amount = $totalUnitPrice + $totalCasePrice + $totalbulk1Price + $totalbulk2Price + $totalbulk3Price;
                        ?> --}}
                    {{-- <tr>
                        <td>
                            @foreach($cartItem->product_images as $image)
                            <img src="{{ asset($image->large_image) }}" alt="Product Image" class="product-image">
                            @endforeach
                        </td>
                        <td>
                            @if(isset($cartItem->bcqty1) && $cartItem->bcqty1 > 0)
                            Bulk1: {{$cartItem->bcqty1}}
                            <br />
                            @endif
                            @if(isset($cartItem->bcqty2) && $cartItem->bcqty2 > 0)
                            Bulk2: {{$cartItem->bcqty2}}
                            <br />
                            @endif
                            @if(isset($cartItem->bcqty3) && $cartItem->bcqty3 > 0)
                            Bulk3:{{$cartItem->bcqty3}}
                            @endif
                        </td>
                        <td>
                            <!-- Quantity and bulk display -->
                            @if(isset($cartItem->quantity) && $cartItem->quantity > 0)
                            Quantity: {{$cartItem->quantity}}
                            <br />
                            @endif
                            @if(isset($cartItem->case) && $cartItem->case > 0)
                            Case: {{$cartItem->case}}
                            <br />
                            @endif
                        </td>
                        <td>5%</td>
                        <td>{{$total_amount}}</td>
                        {{-- <td style="color: rgb(5, 206, 5)">{{$order->payment_status}}</td> --}}
                        {{-- <td>
                            <a class="btn btn-danger" onclick="return confirm('Are you sure to remove this product?')"
                                style="font-size:15px" href="{{ url('/remove_cart', $cartItem->id) }}">Remove</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @endif --}}
            @if ($cart->isEmpty())
            <div class="d-flex flex-column align-items-center">
                <p class="text-center">Your cart is empty</p>
                <a href="{{url('products')}}" class="btn btn-primary">
                    Continue shopping
                </a>

            </div>

            @else

            <div class="row">
                <div class="col-lg-12">
                    <?php 
                        $total_amount = 0;
                    ?>
                    @foreach ($cart as $cartItem)

                    <?php 
                        // Calculate total item price for the current product
                        $totalItemPrice = $cartItem->unit_price + $cartItem->case_price + $cartItem->total_bulk1_price + $cartItem->total_bulk2_price + $cartItem->total_bulk3_price;
                
                        // Calculate total item price with VAT
                        $totalPriceWithVat = $totalItemPrice + (($cartItem->vat * $cartItem->unit_price) / 100);
                
                        // Add total item price with VAT to the total amount
                        $total_amount += $totalPriceWithVat;
                    ?>
                    <div class="row g-1 mb-5 mt-2 border-bottom border-top">

                        <div class="col-lg-2">
                            @foreach($cartItem->product_images as $image)
                            <img src="{{ asset($image->large_image) }}" alt="Product Image" class="product-image">
                            @endforeach
                        </div>

                        <div class="col-lg-4 d-flex  align-items-center">
                            <h3>{{$cartItem->product_title}}</h3>
                            <p></p>
                            {{-- @if(isset($cartItem->case) && $cartItem->case > 0)
                            Case: {{$cartItem->case}}
                            <br />
                            @endif
                            <div class="trapezoid-right">
                                @if(isset($cartItem->bcqty1) && $cartItem->bcqty1 > 0)
                                Bulk1: {{$cartItem->bcqty1}}
                                <br />
                                @endif
                            </div>
                            @if(isset($cartItem->bcqty2) && $cartItem->bcqty2 > 0)
                            Bulk2: {{$cartItem->bcqty2}}
                            <br />
                            @endif
                            @if(isset($cartItem->bcqty3) && $cartItem->bcqty3 > 0)
                            Bulk3:{{$cartItem->bcqty3}}
                            @endif --}}

                            {{-- <div class="d-flex gap-2">
                                <input type="checkbox" class="btn-check" id="bulk1" name="bulk1" autocomplete="off" {{
                                    $cartItem->bcqty1 ? 'checked' : '' }}>
                                <label class="btn btn-outline-secondary" for="bulk1">Bulk 1</label><br>

                                <input type="checkbox" class="btn-check" id="bulk2" name="bulk2" autocomplete="off" {{
                                    $cartItem->bcqty2 ? 'checked' : '' }}>
                                <label class="btn btn-outline-secondary" for="bulk2">Bulk 2</label><br>

                                <input type="checkbox" class="btn-check" id="bulk3" name="bulk3" autocomplete="off" {{
                                    $cartItem->bcqty3 ? 'checked' : '' }}>
                                <label class="btn btn-outline-secondary" for="bulk3">Bulk 3</label><br>
                            </div> --}}
                        </div>


                        <div class="col-lg-4 d-flex mt-4 mb-2 align-items-center">
                            <p>
                                @if(isset($cartItem->case) && $cartItem->case > 0)
                                Cases: {{$cartItem->case}}
                                <br />
                                <br />
                                @endif


                                @if(isset($cartItem->quantity) && $cartItem->quantity > 0)
                                Units: {{ $cartItem->quantity }}
                                <br />
                                <br />
                                @endif

                                @if(isset($cartItem->bcqty1) && $cartItem->bcqty1 > 0)
                                Bulk1: {{$cartItem->bcqty1}}
                                <br />
                                <br />
                                @endif

                                @if(isset($cartItem->bcqty2) && $cartItem->bcqty2 > 0)
                                Bulk2: {{$cartItem->bcqty2}}
                                <br />
                                <br />
                                @endif

                                @if(isset($cartItem->bcqty3) && $cartItem->bcqty3 > 0)
                                Bulk3:{{$cartItem->bcqty3}}
                                @endif
                            </p>


                            {{-- <form action="{{ url('add_cart', $cartItem->product_id) }}" method="POST">
                                @csrf
                                <label for="case_quantity">Case:</label>
                                <input class="border border-secondary mb-2" type="number" id="case_quantity"
                                    name="case_quantity" value="{{ $cartItem->case }}">
                                <br>
                                <label for="quantity">Unit:</label>
                                <input class="border border-secondary mt-2 mb-2" type="number" id="quantity"
                                    name="quantity" value="{{ $cartItem->quantity }}">
                                <br>

                                <!-- Add hidden inputs for bulk quantities if needed -->
                                <button type="submit" class="btn btn-secondary mt-2">Update</button>
                            </form> --}}
                        </div>


                        {{-- <div class="col-lg-1 ">
                            <p>VAT: {{$cartItem->vat}}%</p>
                        </div> --}}

                        {{-- <div class="col-lg-2 d-flex flex-column">
                            <p style="color:red"><i class="fas fa-pound-sign "></i>{{$totalItemPrice}} (ex vat)</p>
                            <p>RSP: <i class="fas fa-pound-sign"></i>{{$cartItem->rsp}}</p>
                            <p>POR: {{$cartItem->por}}%</p>
                            <p style="color:red"><i class="fas fa-pound-sign "></i>{{$totalPriceWithVat}} (inc vat)</p>
                        </div> --}}

                        <div class="col-lg-2 d-flex align-items-center mb-2">
                            <a class="btn btn-danger" onclick="return confirm('Are you sure to remove this product?')"
                                style="font-size:15px" href="{{ url('/remove_cart', $cartItem->id) }}">Remove</a>
                        </div>

                    </div>
                    @endforeach

                    <div class="row g-2">
                        <div class="col-lg-12 d-flex justify-content-end">
                            <div class="col-lg-3">
                                <h3 style="color:red"><i class="fas fa-pound-sign fs-4 ms-5"></i> {{
                                    number_format($total_amount, 2) }}</h3>
                                <a href="{{url('stripe',$total_amount)}}"
                                    class="btn border-secondary  rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">Proceed
                                    to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            @endif

            <script>
                function updateQuantity(inputId, index, type) {
                    var inputField = document.getElementById(inputId);
                    var currentValue = parseInt(inputField.value);
                    if (type === 'quantity') {
                        cart[index].quantity = currentValue;
                    } else if (type === 'case') {
                        cart[index].case = currentValue;
                    }
                    updateTotalAmount();
                }
            
                function updateTotalAmount() {
                    var totalAmount = 0;
                    cart.forEach(function(item) {
                        var totalItemPrice = item.unit_price + item.case_price + item.total_bulk1_price + item.total_bulk2_price + item.total_bulk3_price;
                        var totalPriceWithVat = totalItemPrice + ((item.vat * item.unit_price) / 100);
                        totalAmount += totalPriceWithVat;
                    });
                    document.getElementById('total_amount').textContent = totalAmount.toFixed(2);
                }
            </script>

            <script>
                function updateCartCount() {
        // Fetch the cart count from the server using an AJAX request
        fetch('{{ url('cart_count') }}')
            .then(response => response.json())
            .then(data => {
                // Update the cart count in the navbar
                const cartCountSpan = document.getElementById('cartCount');
                if (cartCountSpan) {
                    cartCountSpan.textContent = data.count;
                }
            })
            .catch(error => console.error('Error fetching cart count:', error));
    }

    document.getElementById('addToCartForm').addEventListener('submit', function(event) {
        // Prevent the form from submitting normally
        event.preventDefault();

        // Submit the form data asynchronously using fetch API or AJAX
        fetch(this.action, {
            method: this.method,
            body: new FormData(this)
        })
        .then(response => {
            if (response.ok) {
                // Update the cart count after successful submission
                updateCartCount();
            }
            return response.text();
        })
        .then(data => console.log(data))
        .catch(error => console.error('Error submitting form:', error));
    });

    // Call the updateCartCount function once the page is loaded
    window.addEventListener('load', updateCartCount);
            </script>

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