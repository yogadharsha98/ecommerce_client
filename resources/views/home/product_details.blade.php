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
            height: 160px;
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
    </style>

</head>

<body>


    <!-- Navbar start -->
    @include('components.navbar')
    <!-- Navbar End -->

    <!-- Modal Search Start -->
    @include('components.search')
    <!-- Modal Search End -->


    @include('components.hero')


    <!-- Single Product Start -->
    <div class="container-fluid py-3">
        <div class="container-fluid py-5">
            <div class="row g-4 mb-1">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-5">
                            <div class="border rounded">
                                <a href="#" id="mainImageLink">
                                    <!-- Main image column -->
                                    <img id="mainImage"
                                        src="{{ $product_details->productImages->count() > 0 ? asset($product_details->productImages->first()->large_image) : asset($product_details->productThumbnails->first()->image) }}"
                                        class="img-fluid rounded main-image" alt="Product Image">
                                </a>
                            </div>

                            <div class="row justify-content-center">
                                @foreach($product_details->productThumbnails as $thumbnail)
                                <div class="col-lg-2 mt-2">
                                    <div
                                        class="d-flex justify-content-center align-items-center border rounded thumb-container">
                                        <img src="{{ asset($thumbnail->image) }}" class="img-fluid thumb-pro"
                                            alt="Product Thumbnail"
                                            onclick="displayMainImage('{{ asset($thumbnail->image) }}')">
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                        <script>
                            function displayMainImage(imageSrc) {
                                document.getElementById('mainImage').src = imageSrc;
                                document.getElementById('mainImageLink').href = imageSrc;
                            }
                        </script>

                        <div class="col-lg-7">
                            <form id="addToCartForm" action="{{ url('add_cart', $product_details->id) }}" method="POST">
                                @csrf
                                <h4 class="fw-bold mb-3">{{ $product_details->product_name }}</h4>
                                <div class="row">
                                    <div class="col-md-6 col-lg-2">
                                        <!-- Adjust the column width for smartphone view -->
                                        <h5>Unit: </h5>
                                        <h5>Case: </h5>
                                    </div>
                                    <div class="col-md-6 col-lg-2">
                                        <!-- Adjust the column width for smartphone view -->
                                        <p class="fw-bold" style="color: red">
                                            <i class="fas fa-pound-sign"></i>
                                            {{ $product_details->unit_price }}
                                        </p>
                                        <p style="color: red">
                                            <i class="fas fa-pound-sign"></i>
                                            {{ $product_details->case_price }}
                                        </p>
                                    </div>

                                    <div class="col-md-6 col-lg-1">
                                        <p>%</p>
                                    </div>
                                    <div class="col-md-6 col-lg-2">
                                        <p>RSP:{{$product_details->rsp}}</p>
                                    </div>

                                    <div class="col-md-6 col-lg-1">
                                        <!-- For update units -->
                                        <div class="d-flex flex-column align-items-center">
                                            <input class="border border-secondary mb-2" style="width:70px" type="number"
                                                id="unitQuantity" name="quantity" value="">
                                            <input class="border border-secondary mb-2" style="width:70px" type="number"
                                                id="caseQuantity" name="case_quantity" value="">
                                        </div>
                                        <!-- For update cases -->
                                    </div>
                                </div>

                                <br />

                                <div class="d-flex gap-2">
                                    <p class="rounded px-2 py-1" style="background-color: rgb(235, 235, 235)">Buy {{
                                        $product_details->bcqty_1 }} for {{ $product_details->bcp_1 }}</p>

                                    <p class="rounded px-2 py-1" style="background-color: rgb(235, 235, 235)">Buy {{
                                        $product_details->bcqty_2 }} for {{ $product_details->bcp_2 }}</p><br>

                                    <p class="rounded px-2 py-1" style="background-color: rgb(235, 235, 235)">Buy {{
                                        $product_details->bcqty_3 }} for {{ $product_details->bcp_3 }}</p><br>

                                </div>

                                <div class="d-flex justify-content-even mt-3" style="gap:150px;">
                                    <div>
                                        <p class="text-primary">Pack size: {{ $product_details->packsize }}</p>

                                        <p class="text-primary">Barcode: {{ $product_details->barcode_sku }}</p>
                                    </div>


                                    <input type="submit" value="Add to cart"
                                        class="btn border border-secondary rounded-pill mt-3 px-4 py-2 mb-4 text-primary">

                                </div>


                                <script>
                                    // Livewire component script
                                        document.getElementById('addToCartForm').addEventListener('submit', function(event) {
                                            var quantity = document.getElementsByName('quantity')[0].value;
                                            var caseQuantity = document.getElementsByName('case_quantity')[0].value;
                                            
                                
                                            if (parseInt(quantity) === 0 && parseInt(caseQuantity) === 0) {
                                                event.preventDefault();
                                                alert('Please select a quantity or a case quantity');
                                            } else {
                                                Livewire.emit('addToCart'); // Emit the addToCart event
                                            }
                                        });
                                
                                        // Listen for addToCart event from Livewire
                                        Livewire.on('addToCart', () => {
                                            // Update the cart count
                                            // You can implement custom logic here if needed
                                            Livewire.emit('updateCartCount');
                                        });
                                </script>

                            </form>

                            <script>
                                // Form submission logic
                                document.getElementById('addToCartForm').addEventListener('submit', function(event) {
                                    var quantity = document.getElementsByName('quantity')[0].value;
                                    var caseQuantity = document.getElementsByName('case_quantity')[0].value;
                                    
                                    if (parseInt(quantity) === 0 && parseInt(caseQuantity) === 0) {
                                        event.preventDefault();
                                        alert('Please select a quantity or a case quantity');
                                    } else {
                                        Livewire.emit('addToCart', quantity, caseQuantity); // Emit the addToCart event with quantities
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

                                </div>
                            </nav>
                            <div class="tab-content mb-1">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <p>{{ $product_details->product_description }}.</p>

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
                            <div class="input-group w-100 mx-auto d-flex mb-2">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i
                                        class="fa fa-search"></i></span>
                            </div>

                        </div>

                        <div class="col-lg-12">
                            <div class="row align-items-stretch">
                                <!-- Changed align-items-center to align-items-stretch -->
                                <div class="col-md-12 col-lg-12 px-0" style="height:300px">
                                    <h5 class="mt-4">Featured products</h5>
                                    <div id="carouselId" class="carousel slide position-relative"
                                        data-bs-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            @foreach ($featuredProducts as $index => $Item)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}"
                                                id="bannerItem{{ $index }}">

                                                @if($Item->productImages->count() > 0)

                                                <img src="{{ asset($Item->productImages->first()->large_image) }}"
                                                    class="img-thumbnail h-100 fe-product" alt="Product Image">

                                                @endif

                                                @if($Item->productThumbnails->count() > 0)

                                                <img src="{{ asset($Item->productThumbnails->first()->image) }}"
                                                    class="img-thumbnail h-100 fe-product-thumb"
                                                    alt="Product Thumbnail">

                                                @endif
                                                <a class="text-light btn btn-secondary" style="font-size: 15px"
                                                    href="{{url('product_details',$Item->id)}}">{{$Item->product_name}}
                                                </a>

                                            </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            <div class="row g-2">
                <div class="col-lg-12">
                    <div class="row">
                        @foreach ($new_arrivals as $product)
                        <div class="col-md-6 col-lg-2 col-xl-2 h-20 p-2">
                            <div class="rounded position-relative fruite-item border border-secondary">
                                <a href="{{ url('product_details', $product->id) }}">
                                    {{-- Retrieve the main product image --}}
                                    <div class="fruite-img position-relative">
                                        @if ($product->productImages->count() > 0)
                                        <!-- If product has images in product_images table -->
                                        <img src="{{ asset($product->productImages->first()->large_image) }}"
                                            class="img-fluid w-100 rounded-top product-image" alt="Product Image"
                                            style="position: relative;">
                                        @elseif ($product->productThumbnails->count() > 0)
                                        <!-- If product has images in product_thumbnails table -->
                                        <img src="{{ asset($product->productThumbnails->first()->image) }}"
                                            class="img-fluid w-100 rounded-top product-thumbnail"
                                            alt="Product Thumbnail" style="position: relative;">
                                        @endif
                                    </div>
                                </a>
                                <div class="text-white bg-secondary px-3 1 rounded position-absolute"
                                    style="top: 10px; right: 10px;">
                                    <p style="font-size: 14px"> New Arraivals</p>

                                </div>

                                <div class="rounded-bottom">
                                    <strong class="d-flex justify-content-center">
                                        <p style="font-size: 14px;" class="text-dark">
                                            {{$product->product_name}}</p>
                                    </strong>
                                    <div class="d-flex justify-content-center">
                                        <p class="info" style="display: none; font-size:13px;">
                                            {{$product->product_description}}
                                        </p>
                                    </div>


                                    <div>
                                        <strong class="d-flex justify-content-center">
                                            <p style="font-size: 18px; color:red"> <i
                                                    class="fas fa-pound-sign"></i>{{$product->unit_price}}
                                            </p>
                                        </strong>
                                        <div class="d-flex justify-content-center gap-1 flex-row text-center">
                                            <strong>
                                                <p class="info py-2 rounded px-1 text-dark"
                                                    style="display: none; font-size:11px; background-color:rgb(235, 235, 235)">
                                                    {{$product->bcqty_1}} for
                                                    <i class="fas fa-pound-sign"></i>{{$product->bcp_1}}
                                                </p>
                                            </strong>
                                            <strong>
                                                <p class="info py-2 rounded px-1 text-dark"
                                                    style="display: none; font-size:11px; background-color:rgb(235, 235, 235)">
                                                    {{$product->bcqty_2}} for
                                                    <i class="fas fa-pound-sign"></i>{{$product->bcp_2}}
                                                </p>
                                            </strong>
                                            <strong>
                                                <p class="info py-2 rounded px-1 text-dark"
                                                    style="display: none; font-size:11px; background-color:rgb(235, 235, 235)">
                                                    {{$product->bcqty_3}} for
                                                    <i class="fas fa-pound-sign"></i>{{$product->bcp_3}}
                                                </p>
                                            </strong>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="pagination-wrapper">
                                    <div class="pagination d-flex justify-content-end mt-5">
                                        {{ $new_arrivals->links() }}
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Single Product End -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fruiteItems = document.querySelectorAll('.fruite-item');
    
            fruiteItems.forEach(item => {
                item.addEventListener('mouseenter', function () {
                    const bulkInfo = item.querySelectorAll('.info');
                    bulkInfo.forEach(info => {
                        info.style.display = 'block';
                    });
                });
    
                item.addEventListener('mouseleave', function () {
                    const bulkInfo = item.querySelectorAll('.info');
                    bulkInfo.forEach(info => {
                        info.style.display = 'none';
                    });
                });
            });
        });
    </script>

    <div class="container-fluid">
        <div class="container-fluid px-0">
            <div class="row align-items-stretch">
                <!-- Changed align-items-center to align-items-stretch -->
                <div class="col-md-12 col-lg-12 px-0">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            @foreach ($slider2 as $index => $Item)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" id="bannerItem{{ $index }}">
                                <img src="{{ $Item->image }}" class="w-100 h-100" alt="Banner {{ $index }}">
                                <!-- Set the image's height to 100% -->
                                <a href="#" class="btn px-4 py-2 text-white rounded">{{ $Item->title }}</a>
                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    @include('components.footer')
    <!-- Footer End -->

    <!-- Copyright Start -->
    @include('components.copyrights')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}

    <script src="home/lib/easing/easing.min.js"></script>
    <script src="home/lib/waypoints/waypoints.min.js"></script>
    <script src="home/lib/lightbox/js/lightbox.min.js"></script>
    <script src="home/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="home/js/main.js"></script>
</body>

</html>