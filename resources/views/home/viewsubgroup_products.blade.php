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

        <h1 class="text-center text-white display-6">Products</h1>

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
                                @foreach ($subgroupproducts as $subgroupproduct)
                                <div class="col-md-6 col-lg-6 col-xl-12" style="height:150px;">
                                    <div
                                        class="rounded position-relative fruite-item border border-secondary d-flex justify-content-around p-1">
                                        <a href="{{url('product_details',$subgroupproduct->id)}}">
                                            <div class="fruite-img" style="height: 200px;">
                                                @if($subgroupproduct->productImages->count() > 0)
                                                <div class="fruite-img">
                                                    <img src="{{ asset($subgroupproduct->productImages->first()->large_image) }}"
                                                        class="img-fluid rounded-top product-image" alt="Product Image">
                                                </div>
                                                @endif

                                                {{-- Retrieve the product thumbnail --}}
                                                @if($subgroupproduct->productThumbnails->count() > 0)
                                                <div class="thumbnail">
                                                    <img src="{{ asset($subgroupproduct->productThumbnails->first()->thumbnail_image) }}"
                                                        class="img-fluid w-100 h-100 object-fit-cover rounded-top product-thumbnail"
                                                        alt="Product Thumbnail">
                                                </div>
                                                @endif
                                            </div>
                                        </a>
                                        <div class=" mt-2 rounded-bottom">
                                            <strong>
                                                <p>{{$subgroupproduct->product_name}}
                                            </strong> <br />
                                            <p>case of {{ $subgroupproduct->packsize }} = <i
                                                    class="fas fa-pound-sign"></i> {{ $subgroupproduct->case_price }}
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <strong>
                                                    <p class="text-danger fw-bold fs-4 mb-0"><i
                                                            class="fas fa-pound-sign"></i>
                                                        {{ $subgroupproduct->unit_price }}</p>
                                                </strong>

                                            </div>
                                        </div>

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
                                            {{-- Retrieve the main product image --}}
                                            <div class="fruite-img position-relative">
                                                @if($product->productImages->count() > 0)
                                                <img src="{{ asset($product->productImages->first()->large_image) }}"
                                                    class="img-fluid w-100 rounded-top product-image"
                                                    alt="Product Image" style="position: relative;">
                                                <!-- Ensure the image container has relative positioning -->

                                                @endif
                                            </div>

                                            {{-- Retrieve the product thumbnail --}}
                                            @if($product->productThumbnails->count() > 0)
                                            <div class="thumbnail">
                                                <img src="{{ asset($product->productThumbnails->first()->thumbnail_image) }}"
                                                    class="img-thumbnail product-thumbnail" alt="Product Thumbnail">
                                            </div>
                                            @endif
                                        </a>
                                        <div class="rounded-bottom">
                                            <strong class="d-flex justify-content-center">
                                                <p style="font-size: 14px;" class="tex-dark">{{$product->product_name}}
                                                </p>
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
                                                        <p class="info py-2 rounded px-1"
                                                            style="display: none; font-size:11px; background-color:rgb(235,235,235)">
                                                            {{$product->bcqty_1}} for
                                                            <i class="fas fa-pound-sign"></i>{{$product->bcp_1}}
                                                        </p>
                                                    </strong>
                                                    <strong>
                                                        <p class="info py-2 rounded px-1"
                                                            style="display: none; font-size:11px; background-color:rgb(235,235,235)">
                                                            {{$product->bcqty_2}} for
                                                            <i class="fas fa-pound-sign"></i>{{$product->bcp_2}}
                                                        </p>
                                                    </strong>
                                                    <strong>
                                                        <p class="info py-2 rounded px-1"
                                                            style="display: none; font-size:11px; background-color:rgb(235,235,235)">
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