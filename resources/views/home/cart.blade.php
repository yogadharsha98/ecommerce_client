<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('components.css')

    <style type='text/css'>
        .carousel,
        .carousel-inner,
        .carousel-item {
            height: 230px;
            object-fit: cover;
        }

        .hero-header .align-items-stretch>div {
            height: 100%;
            /* Make the columns stretch to match height */
        }

        .hero-header .carousel-item {
            height: 100%;
            /* Make the carousel items fill the available height */
        }

        .fruite-item:hover .bulk-info {
            display: block;
        }

        .vesitable-item {


            /* Adjust the margin as needed */
        }

        .product-image,
        .product-thumbnail {
            height: 150px;
            width: 200px;
            /* Adjust this value as needed */
            object-fit: cover;
        }

        .newproduct-image,
        .newproduct-thumbnail {
            height: 160px;

            object-fit: cover;
        }


        /* For small screens (smartphones), display 2 products per row */
        @media (max-width: 576px) {
            .col-md-6 {
                flex: 0 0 50%;
                /* Three products per row */
                max-width: 50%;
            }
        }

        .pagination-wrapper ul.pagination {
            display: inline-flex;
            list-style: none;
            padding: 2px;
        }

        .pagination-wrapper ul.pagination li {
            margin: 0 3px;
            padding: 0;
        }

        #quantityInput {
            width: 50px;
            /* Adjust the width as needed */
            padding: 0.375rem;
            /* Adjust padding as needed */
            margin: 0 10px;
            /* Adjust margin between elements */
        }

        #decrementBtn,
        #incrementBtn {
            width: 50px;
            /* Adjust the width of buttons */
            height: 40px;
            /* Adjust the height of buttons */

        }
    </style>

</head>

<body>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Your JavaScript code here
            // Event listeners, function calls, etc.

            // Function to send AJAX request to update quantity
            function updateQuantity(productId, quantity) {
        // Send AJAX request to the backend controller
        $.ajax({
            type: 'POST', // Use POST method
            url: '/update_cart/' + productId,
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'PUT', // Specify PUT method
                quantity: quantity
            },
            success: function(response) {
                // Update the quantity input field on success
                var quantityInput = $('#quantityInput_' + productId);
                quantityInput.val(quantity); // Update input field value
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    }

    // Event listener for increment button
    $('.incrementBtn').click(function() {
        var productId = $(this).data('product-id'); // Get product ID from data attribute
        var quantityInput = $('#quantityInput_' + productId);
        var newQuantity = parseInt(quantityInput.val()) + 1;
        updateQuantity(productId, newQuantity);
    });

    // Event listener for decrement button
    $('.decrementBtn').click(function() {
        var productId = $(this).data('product-id'); // Get product ID from data attribute
        var quantityInput = $('#quantityInput_' + productId);
        var newQuantity = parseInt(quantityInput.val()) - 1;
        if (newQuantity >= 0) {
            updateQuantity(productId, newQuantity);
        }
    });
});
    </script>


    <!-- Navbar start -->
    @include('components.navbar')
    <!-- Navbar End -->

    <!-- Modal Search Start -->
    @include('components.search')
    <!-- Modal Search End -->


    @include('components.hero')


    <!-- Cart Page Start -->
    <div class="container-fluid">
        <div class="container-fluid py-2">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">

                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i
                                        class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Group by:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                    form="fruitform">
                                    <option value="volvo">Fast moving</option>
                                    <option value="saab">Price ascending</option>
                                    <option value="opel">Price descending</option>
                                    <option value="audi">High margin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Sort by: </label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                    form="fruitform">
                                    <option value="volvo">Fast moving</option>
                                    <option value="saab">Price ascending</option>
                                    <option value="opel">Price descending</option>
                                    <option value="audi">High margin</option>
                                </select>
                            </div>


                        </div>
                        <div class="col-xl-2">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits"><i class="bi bi-printer"></i> Print Product List</lable>
                            </div>
                        </div>
                        <div class="col-xl-1">
                            <div class="d-flex justify-content-end gap-4 mb-4">
                                <button class="btn btn-secondary border-secondary" id="gridViewBtn"><i
                                        class="bi bi-grid-fill"></i></button>
                                <button class="btn btn-secondary border-secondary" id="listViewBtn"><i
                                        class="bi bi-list"></i></button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>


            @if ($cart->isEmpty())
            <div class="d-flex flex-column align-items-center">
                <p class="text-center">Your cart is empty</p>
                <a href="{{url('products')}}" class="btn btn-primary">
                    Continue shopping
                </a>

            </div>

            @else

            <div class="row listview" id="listview">
                <div class="col-lg-12">
                    <?php 
                        $total_amount = 0;
                    ?>
                    @foreach ($cart as $cartItem)

                    <?php 
                        // Calculate total item price for the current product
                        $totalItemPrice = $cartItem->unit_price + $cartItem->case_price + $cartItem->total_bulk1_price + $cartItem->total_bulk2_price + $cartItem->total_bulk3_price;
                
                        // Calculate total item price with VAT
                        $totalPriceWithVat = $totalItemPrice + (($cartItem->vat * $totalItemPrice) / 100);
                
                        // Add total item price with VAT to the total amount
                        $total_amount += $totalPriceWithVat;
                    ?>
                    <div class="row g-2 mb-5 mt-2 border-bottom border-top">

                        <div class="col-lg-2 d-flex justify-content-center">
                            @if ($cartItem->productImages->count() > 0)
                            <!-- If product has images in product_images table -->
                            <img src="{{ asset($cartItem->productImages->first()->large_image) }}"
                                class="img-fluid   product-image" alt="Product Image" style="position: relative;">
                            @elseif ($cartItem->productThumbnails->count() > 0)
                            <!-- If product has images in product_thumbnails table -->
                            <img src="{{ asset($cartItem->productThumbnails->first()->image) }}"
                                class="img-fluid   product-thumbnail" alt="Product Thumbnail"
                                style="position: relative;">
                            @endif
                        </div>

                        <div class="col-lg-2 d-flex justify-content-center align-items-center">
                            Pack size: {{$cartItem->product->packsize}}
                        </div>

                        <div class="col-lg-4">
                            <div class="d-flex align-items-start flex-column ">
                                <h5>{{$cartItem->product->product_name}}</h5>
                                <p>{{$cartItem->product->product_description}}</p>
                            </div>


                            <div class="d-flex justify-content-even gap-4">
                                <p>RSP: {{$cartItem->product->rsp}}</p>
                                <p class="info py-2 rounded px-1 text-dark"
                                    style="font-size:11px; background-color:rgb(235, 235, 235)">Buy
                                    {{$cartItem->product->bcqty_1}} for {{$cartItem->product->bcp_1}}</p>
                                <p class="info py-2 rounded px-1 text-dark"
                                    style=" font-size:11px; background-color:rgb(235, 235, 235)">Buy
                                    {{$cartItem->product->bcqty_2}} for {{$cartItem->product->bcp_2}}</p>
                                <p class="info py-2 rounded px-1 text-dark"
                                    style="font-size:11px; background-color:rgb(235, 235, 235)">Buy
                                    {{$cartItem->product->bcqty_3}} for {{$cartItem->product->bcp_3}}</p>
                            </div>

                        </div>

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

                        <div class="col-lg-4 d-flex flex-row justify-content-center">
                            <div class="col-lg-3">
                                <div style="color: red;"><i class="fas fa-pound-sign"></i>{{$totalItemPrice}} (ex vat)
                                </div>
                                @if ($cartItem->case > 0) {{-- Check if case quantity is greater than 0 --}}
                                <div style="margin-top: 50px;">Margin:{{$cartItem->margin}} %</div>
                                @endif
                            </div>
                            <div class="col-lg-1 d-flex ">
                                <div class="d-flex flex-column align-items-center" style="width: 80px">
                                    <div class="d-flex flex-column align-items-center gap-2">

                                        <button class="btn incrementBtn" data-product-id="{{ $cartItem->id }}">
                                            <i class="bi bi-chevron-compact-up"></i>
                                        </button>
                                        <input name="quantity" class="form-control quantityInput"
                                            id="quantityInput_{{ $cartItem->id }}"
                                            value="{{ $cartItem->quantity ?? 0 }}" min="0" style="width: 80px">
                                        <button class="btn decrementBtn" data-product-id="{{ $cartItem->id }}">
                                            <i class="bi bi-chevron-compact-down"></i>
                                        </button>



                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <form action="{{ url(' add_cart', $cartItem->product_id) }}" method="POST">
                            @csrf
                            <label for="case_quantity">Case:</label>
                            <input class="border border-secondary mb-2" type="number" id="case_quantity"
                                name="case_quantity" value="{{ $cartItem->case }}">
                            <br>
                            <label for="quantity">Unit:</label>
                            <input class="border border-secondary mt-2 mb-2" type="number" id="quantity" name="quantity"
                                value="{{ $cartItem->quantity }}">
                            <br>

                            <!-- Add hidden inputs for bulk quantities if needed -->
                            <button type="submit" class="btn btn-secondary mt-2">Update</button>
                        </form> --}}

                        {{-- <div class="col-lg-1 ">
                            <p>VAT: {{$cartItem->vat}}%</p>
                        </div> --}}

                        {{-- <div class="col-lg-2 d-flex flex-column">
                            <p style="color:red"><i class="fas fa-pound-sign "></i>{{$totalItemPrice}}
                                (ex vat)</p>
                            <p>RSP: <i class="fas fa-pound-sign"></i>{{$cartItem->rsp}}</p>
                            <p>POR: {{$cartItem->por}}%</p>
                            <p style="color:red"><i class="fas fa-pound-sign "></i>{{$totalPriceWithVat}} (inc vat)</p>
                        </div> --}}

                        {{-- <div class="col-lg-2 d-flex align-items-center mb-2">
                            <a class="btn btn-danger" onclick="return confirm('Are you sure to remove this product?')"
                                style="font-size:15px" href="{{ url('/remove_cart', $cartItem->id) }}">Remove</a>
                        </div> --}}

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


            <div class="row gridview d-none" id="gridview">

                <div class="row gap-4">
                    <dic class="col-lg-12">
                        <div class="row gap-2">
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
                            <div class="col-lg-2 ">
                                <div class="card h-100">
                                    <div class="card-body d-flex flex-column gap-2"
                                        style="background-color: rgb(244, 241, 241)">
                                        <div class="d-flex justify-content-center">
                                            @if ($cartItem->productImages->count() > 0)
                                            <!-- If product has images in product_images table -->
                                            <img src="{{ asset($cartItem->productImages->first()->large_image) }}"
                                                class="img-fluid   product-image" alt="Product Image"
                                                style="position: relative;">
                                            @elseif ($cartItem->productThumbnails->count() > 0)
                                            <!-- If product has images in product_thumbnails table -->
                                            <img src="{{ asset($cartItem->productThumbnails->first()->image) }}"
                                                class="img-fluid   product-thumbnail" alt="Product Thumbnail"
                                                style="position: relative;">
                                            @endif
                                        </div>


                                        <div class="row">
                                            <div class="d-flex justify-content-center">
                                                <strong>
                                                    <p>{{$cartItem->product->product_name}}</p>
                                                </strong>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="d-flex justify-content-center">
                                                <p style="font-size: 14px">{{$cartItem->product->product_description}}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="d-flex justify-content-center">
                                                <p>Pack size: {{$cartItem->product->packsize}}</p>
                                            </div>

                                        </div>
                                        <div class="row gap-5 d-flex justify-content-center">
                                            <div class="col-lg-1 d-flex justify-content-center">
                                                <p style="font-size: 12px">RSP: </p>
                                            </div>
                                            <div class="col-lg-1 d-flex justify-content-center">
                                                <p style="font-size: 13px">{{$cartItem->product->rsp}}%</p>
                                            </div>

                                        </div>
                                        <div class="mt-auto">
                                            <div class="row ">
                                                <div class="d-flex justify-content-center" style="color: red;">
                                                    <p><i class="fas fa-pound-sign"></i>{{$totalItemPrice}} (ex vat)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-auto">
                                            <div class="row ">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button class="btn border-secondary decrementBtn"
                                                        data-product-id="{{ $cartItem->id }}"><i
                                                            class="bi bi-dash"></i></button>
                                                    <input name="quantity" class="form-control quantityInput"
                                                        id="quantityInput_{{ $cartItem->id }}"
                                                        value="{{ $cartItem->quantity ?? 0 }}" min="0"
                                                        style="width: 80px">
                                                    <button class="btn border-secondary incrementBtn"
                                                        data-product-id="{{ $cartItem->id }}"><i
                                                            class="bi bi-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            @endforeach

                        </div>
                    </dic>
                </div>


            </div>

            @endif


            <script>
                // Wait for the DOM to be fully loaded
                document.addEventListener('DOMContentLoaded', function () {
                    // Get references to the buttons and views
                    const gridViewBtn = document.getElementById('gridViewBtn');
                    const listViewBtn = document.getElementById('listViewBtn');
                    const gridView = document.getElementById('gridview');
                    const listView = document.getElementById('listview');
            
                    // Add click event listeners to the buttons
                    gridViewBtn.addEventListener('click', function () {
                        // Show grid view and hide list view
                        gridView.classList.remove('d-none');
                        listView.classList.add('d-none');
                    });
            
                    listViewBtn.addEventListener('click', function () {
                        // Show list view and hide grid view
                        gridView.classList.add('d-none');
                        listView.classList.remove('d-none');
                    });
                });
            </script>



            {{-- <script>
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
            </script> --}}

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
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    Distributed By
                    <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the carousel item containing the image
            const carouselItem = document.querySelector('.carousel-item');
    
            // Get the image element within the carousel item
            const image = carouselItem.querySelector('img');
    
            // Get the height of the image
            const imageHeight = image.clientHeight;
    
            // Output the height of the image to the console
            console.log('Height of the slider image:', imageHeight);
        });
    </script>
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js">
    </script> --}}

    <script src="home/lib/easing/easing.min.js"></script>
    <script src="home/lib/waypoints/waypoints.min.js"></script>
    <script src="home/lib/lightbox/js/lightbox.min.js"></script>
    <script src="home/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="home/js/main.js"></script>
</body>

</html>