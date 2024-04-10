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
    <div class="container-fluid fruite">
        <div class="container-fluid py-3">

            <div class="row g-1">
                <div class="col-lg-12">
                    <div class="row g-1">
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
                        <div class="col-lg-12">
                            <div class="row g-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col lg-12">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="row align-items-stretch">
                                    <!-- Changed align-items-center to align-items-stretch -->
                                    <div class="col-md-12 col-lg-12 px-0">
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
                            </div>




                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 mt-3">

                                @foreach ($data as $data)

                                <div class="col-md-6 col-lg-3 col-xl-3 h-25">
                                    <div class="rounded position-relative fruite-item border border-secondary">
                                        <div class="fruite-img" style="height: 130px;">
                                            <!-- Adjust the height as needed -->
                                            <a href="{{url('category',$data->id)}}">
                                                <img src="{{ $data->image }}"
                                                    class="img-fluid w-100 h-100 object-fit-cover rounded-top" alt="">
                                            </a>
                                        </div>
                                        <div class="p-2 border-top-0 rounded-bottom">
                                            <p style="font-size: 12px">{{$data->department_title}}</p>

                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                            {{-- <div class="row mt-5">
                                <div class="col-12">
                                    <div class="pagination-wrapper">
                                        <div class="pagination d-flex justify-content-end mt-5">
                                            {{ $data->links() }}
                                        </div>
                                    </div>
                                </div>

                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Fruits Shop End-->


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