<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('components.css')

    <style type='text/css'>
        .product-image,
        .product-thumbnail {
            height: 100px;
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

        <h1 class="text-center text-white display-6">All products</h1>

    </div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">

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
                                    <option value="volvo">Nothing</option>
                                    <option value="saab">Popularity</option>
                                    <option value="opel">Organic</option>
                                    <option value="audi">Fantastic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            @foreach ($departments as $department)
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
                        <div class="col-lg-9">
                            <div class="row g-4">

                                <h1>All Products</h1>
                                @include('components.products')



                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        <a href="#" class="rounded">&laquo;</a>
                                        <a href="#" class="active rounded">1</a>
                                        <a href="#" class="rounded">2</a>
                                        <a href="#" class="rounded">3</a>
                                        <a href="#" class="rounded">4</a>
                                        <a href="#" class="rounded">5</a>
                                        <a href="#" class="rounded">6</a>
                                        <a href="#" class="rounded">&raquo;</a>
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