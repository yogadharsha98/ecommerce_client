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


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container-fluid">

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
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Default Sorting:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                    form="fruitform">
                                    <option value="volvo">Fast moving</option>
                                    <option value="saab">Price ascending</option>
                                    <option value="opel">Price descending</option>
                                    <option value="audi">High margin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
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
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselId" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselId" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                {{-- <div class="col-lg-12">
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

                                </div> --}}


                            </div>
                        </div>

                        <div class="col-lg-9">
                            <div class="row g-4">
                                @foreach ($subgroups as $subgroup)
                                <div class="col-md-6 col-lg-6 col-xl-3 h-25">
                                    <div class="rounded position-relative fruite-item border border-secondary">
                                        {{-- <div class="fruite-img" style="height: 200px;">
                                            <!-- Adjust the height as needed -->
                                            <img src="{{ $subgroup->image }}"
                                                class="img-fluid w-100 h-100 object-fit-cover rounded-top" alt="">
                                        </div> --}}<a href="{{ route('subgroup.products', ['id' => $subgroup->id]) }}">
                                            <div class="p-2 border-top-0 rounded-bottom">
                                                <p>{{$subgroup->sub_group_title}}</p>

                                            </div>
                                        </a>
                                    </div>
                                </div>

                                @endforeach


                                @if ($products->isEmpty())
                                <div class="d-flex flex-column align-items-center">
                                    <p class="text-center">Currently we don't have products in this department. We will
                                        update by soon.</p>
                                    <a href="{{url('products')}}" class="btn btn-primary">
                                        Continue shopping
                                    </a>


                                </div>
                                @else
                                <h1>Products</h1>
                                @foreach ($products as $product)
                                <div class="col-md-6 col-lg-3 col-xl-3 h-20 p-2">
                                    <div class="rounded position-relative fruite-item border border-secondary">
                                        <a href="{{url('product_details',$product->id)}}">
                                            <div class="fruite-img position-relative">
                                                @if ($product->productImages->count() > 0)
                                                <!-- If product has images in product_images table -->
                                                <img src="{{ asset($product->productImages->first()->large_image) }}"
                                                    class="img-fluid w-100 rounded-top product-image"
                                                    alt="Product Image" style="position: relative;">
                                                @elseif ($product->productThumbnails->count() > 0)
                                                <!-- If product has images in product_thumbnails table -->
                                                <img src="{{ asset($product->productThumbnails->first()->image) }}"
                                                    class="img-fluid w-100 rounded-top product-thumbnail"
                                                    alt="Product Thumbnail" style="position: relative;">
                                                @endif
                                            </div>
                                        </a>
                                        <div class="rounded-bottom">
                                            <strong class="d-flex justify-content-center" class="tex-dark">
                                                <p style="font-size: 14px;">{{$product->product_name}}</p>
                                            </strong>
                                            <div class="d-flex justify-content-center">
                                                <p class="info" style="display: none; font-size:13px;">
                                                    {{$product->product_description}}
                                                </p>
                                            </div>


                                            <div>
                                                <strong class="d-flex justify-content-center">
                                                    <p style="font-size: 25px; color:red"> <i
                                                            class="fas fa-pound-sign"></i>{{$product->unit_price}}</p>
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
                                @endif

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

                                @if ($products->isNotEmpty())
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <div class="pagination-wrapper">
                                            <div class="pagination d-flex justify-content-end mt-5">
                                                {{ $products->links() }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
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
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; right: 10px;">
                                    New Arraivals</div>

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
    <!-- Fruits Shop End-->
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