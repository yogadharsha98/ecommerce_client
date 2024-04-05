<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('components.css')

    <style type='text/css'>
        .product-image,
        .product-thumbnail {
            height: 150px;
            /* Adjust this value as needed */
            object-fit: cover;
        }

        @media (max-width: 576px) {
            .col-md-6 {
                flex: 0 0 33%;
                /* Three products per row */
                max-width: 33%;
            }
        }

        .trapezoid-right {
            position: relative;
            width: 100px;
            height: 30px;
            background-color: red;
        }

        .trapezoid-right:before {
            content: '';
            position: absolute;
            top: 0;
            right: -50px;
            /* Adjust this value to change the slope */
            width: 10em;
            height: 0;
            border-top: 30px solid red;
            border-right: 10px solid transparent;
            /* Match the background color */

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
        <h1 class="text-center text-white display-6">Product Details</h1>

    </div>
    <!-- Single Page Header End -->



    <!-- Single Product Start -->
    <div class="container-fluid py-3">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    {{-- <img src="img/single-item.jpg" class="img-fluid rounded" alt="Image"> --}}

                                    @if($product_details->productImages->count() > 0)
                                    <img src="{{ asset($product_details->productImages->first()->large_image) }}"
                                        class="img-fluid rounded" alt="Product Image">
                                    <!-- Ensure the image container has relative positioning -->
                                    @endif

                                    @if($product_details->productThumbnails->count() > 0)
                                    <div class="thumbnail">
                                        <img src="{{ asset($product_details->productThumbnails->first()->thumbnail_image) }}"
                                            class="img-fluid rounded" alt="Product Thumbnail">
                                    </div>
                                    @endif
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <form id="addToCartForm" action="{{ url('add_cart', $product_details->id) }}" method="POST">
                                @csrf
                                <h4 class="fw-bold mb-3">{{ $product_details->product_name }}</h4>
                                <div class="row">
                                    <div class="col-md-6 col-lg-2">
                                        <!-- Adjust the column width for smartphone view -->
                                        <h5>Unit: </h5>
                                        <h5>Case: </h5>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <!-- Adjust the column width for smartphone view -->
                                        <h5 class="fw-bold" style="color: red">
                                            <i class="fas fa-pound-sign"></i>
                                            {{ $product_details->unit_price }}
                                        </h5>
                                        <h5 style="color: red">
                                            <i class="fas fa-pound-sign"></i>
                                            {{ $product_details->case_price }}
                                        </h5>
                                    </div>
                                    <div class="col-md-6 col-lg-1">
                                        <!-- For update units -->

                                        <div class="d-flex align-items-center" style="width: 100px;">
                                            <i class="bi bi-dash-circle align-middle" style="font-size: 22px"></i>
                                            <input type="text" id="unitQuantity" name="quantity"
                                                class="form-control form-control-sm text-center border-0 align-middle"
                                                value="0" style="font-size: 15px">
                                            <i class="bi bi-plus-circle align-middle" style="font-size: 22px"></i>
                                        </div>
                                        <!-- For update cases -->
                                        <div class="d-flex gap-2" style="width: 100px;">
                                            <i class="bi bi-dash-circle" style="font-size: 22px"></i>
                                            <input type="text" id="caseQuantity" name="case_quantity"
                                                class="form-control form-control-sm text-center border-0" value="0"
                                                style="font-size: 15px">
                                            <i class="bi bi-plus-circle " style="font-size: 22px"></i>
                                        </div>
                                    </div>
                                </div>


                                <br />

                                <p class="text-primary">Barcode: {{ $product_details->barcode_sku }}</p>
                                <div class="d-flex gap-2">
                                    <input type="checkbox" class="btn-check" id="bulk1" name="bulk1" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="bulk1">Bulk 1</label><br>

                                    <input type="checkbox" class="btn-check" id="bulk2" name="bulk2" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="bulk2">Bulk 2</label><br>

                                    <input type="checkbox" class="btn-check" id="bulk3" name="bulk3" autocomplete="off">
                                    <label class="btn btn-outline-secondary" for="bulk3">Bulk 3</label><br>

                                </div>

                                <input type="submit" value="Add to cart"
                                    class="btn border border-secondary rounded-pill mt-3 px-4 py-2 mb-4 text-primary">
                            </form>

                            <script>
                                document.querySelectorAll('.bi-plus-circle').forEach(function (button) {
                                    button.addEventListener('click', function () {
                                        var inputField = button.parentElement.querySelector('input');
                                        inputField.value = parseInt(inputField.value) + 1;
                                    });
                                });
                            
                                document.querySelectorAll('.bi-dash-circle').forEach(function (button) {
                                    button.addEventListener('click', function () {
                                        var inputField = button.parentElement.querySelector('input');
                                        if (parseInt(inputField.value) > 0) {
                                            inputField.value = parseInt(inputField.value) - 1;
                                        }
                                    });
                                });
                            </script>

                            <script>
                                document.getElementById('addToCartForm').addEventListener('submit', function(event) {
                                    var quantity = document.getElementsByName('quantity')[0].value;
                                    var caseQuantity = document.getElementsByName('case_quantity')[0].value;
                                    var bulk1Checked = document.getElementsByName('bulk1')[0].checked;
                                    var bulk2Checked = document.getElementsByName('bulk2')[0].checked;
                                    var bulk3Checked = document.getElementsByName('bulk3')[0].checked;
                            
                                    if (parseInt(quantity) === 0 && parseInt(caseQuantity) === 0 && !bulk1Checked && !bulk2Checked && !bulk3Checked ) {
                                        event.preventDefault();
                                        alert('Please select a quantity or a case quantity, or check at least one bulk option.');
                                    }
                                });
                            </script>

                        </div>

                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <p>{{ $product_details->product_description }}.</p>
                                    <div class="px-2">
                                        <div class="row g-4">
                                            <div class="col-6">
                                                <div
                                                    class="row bg-light align-items-center text-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Unit price</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0" style="color: red"> <i
                                                                class="fas fa-pound-sign"></i>{{
                                                            $product_details->unit_price }}</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Per case</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">{{ $product_details->packsize }} packs</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Case price</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0" style="color: red"> <i
                                                                class="fas fa-pound-sign"></i>{{
                                                            $product_details->case_price }}</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Bulk 1</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">{{ $product_details->bcqty_1 }}</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Bulk 1 price</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0" style="color: red"> <i
                                                                class="fas fa-pound-sign"></i>{{
                                                            $product_details->bcp_1 }}</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Bulk 2</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">{{ $product_details->bcqty_2 }}</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Bulk 2 price</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0" style="color: red"> <i
                                                                class="fas fa-pound-sign"></i>{{
                                                            $product_details->bcp_2 }}</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Bulk 3</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">{{ $product_details->bcqty_3 }}</p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Bulk 3 price</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0" style="color: red"> <i
                                                                class="fas fa-pound-sign"></i>{{
                                                            $product_details->bcp_3 }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">
                                    <div class="d-flex">
                                        <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3"
                                            style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Jason Smith</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p>The generated Lorem Ipsum is therefore always free from repetition
                                                injected humour, or non-characteristic
                                                words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3"
                                            style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Sam Peters</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p class="text-dark">The generated Lorem Ipsum is therefore always free from
                                                repetition injected humour, or non-characteristic
                                                words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et
                                        tempor sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                        labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>

                        {{-- <form action="#">
                            <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0 me-4" placeholder="Yur Name *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="email" class="form-control border-0" placeholder="Your Email *">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea name="" id="" class="form-control border-0" cols="30" rows="8"
                                            placeholder="Your Review *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 me-3">Please rate:</p>
                                            <div class="d-flex align-items-center" style="font-size: 12px;">
                                                <i class="fa fa-star text-muted"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <a href="#"
                                            class="btn border border-secondary text-primary rounded-pill px-4 py-3">
                                            Post Comment</a>
                                    </div>
                                </div>
                            </div>
                        </form> --}}

                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="input-group w-100 mx-auto d-flex mb-4">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i
                                        class="fa fa-search"></i></span>
                            </div>
                            <div class="mb-4">
                                <h4>Categories</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    @foreach($departments as $department)
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a
                                                href="{{url('category',$department->id)}}">{{$department->department_title}}</a>

                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h4 class="mb-3">Featured products</h4>
                            @foreach($featuredProducts as $pro)
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded me-4 mb-3" style="width: 100px; height: 100px;">
                                    <a href="{{url('product_details',$pro->id)}}">
                                        @if($pro->productImages->count() > 0)
                                        <img src="{{ asset($pro->productImages->first()->large_image) }}"
                                            class="img-fluid rounded" alt="Product Image">
                                        <!-- Ensure the image container has relative positioning -->

                                        @endif

                                        {{-- Retrieve the product thumbnail --}}
                                        @if($pro->productThumbnails->count() > 0)
                                        <div class="thumbnail">
                                            <img src="{{ asset($pro->productThumbnails->first()->thumbnail_image) }}"
                                                class="img-thumbnail product-thumbnail" alt="Product Thumbnail">
                                        </div>
                                        @endif
                                    </a>
                                </div>
                                <div>
                                    <h6 class="mb-2">{{$pro->product_name}}</h6>

                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">{{$pro->unit_price}}</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <div class="col-lg-12">
                            <div class="position-relative">
                                <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                <div class="position-absolute"
                                    style="top: 50%; right: 10px; transform: translateY(-50%);">
                                    <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="fw-bold mb-5">All products</h1>

            <div class="row g-1">

                @include('components.products')


            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="pagination-wrapper">
                        <div class="pagination d-flex justify-content-end mt-5">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Single Product End -->


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