<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.css')

    <style type='text/css'>
        .carousel,
        .carousel-inner,
        .carousel-item {
            height: 230px;

        }

        .fruite-item:hover .bulk-info {
            display: block;
        }


        .product-image,
        .product-thumbnail {
            height: 100px;
            /* Adjust this value as needed */
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
    </style>
</head>

<body>


    <!-- Navbar start -->

    @include('components.navbar')

    <!-- Navbar End -->

    <!-- Modal Search Start -->
    @include('components.search')
    <!-- Modal Search End -->

    <!-- Hero Start -->
    @include('components.hero')
    <!-- Hero End -->

    @include('components.home_banner')

    <!-- Fruits Shop Start-->
    @include('components.home_categories')
    <!-- Fruits Shop End-->


    <!-- Banner Section Start-->

    <img src="img/banner.png" alt="banner" class="mt-5 w-100" style="height: 170px;">

    <!-- Banner Section End -->

    <div class="container-fluid fruite">
        <div class="container-fluid text-center">
            @include('components.home_products')
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
    <script src="home/lib/easing/easing.min.js"></script>
    <script src="home/lib/waypoints/waypoints.min.js"></script>
    <script src="home/lib/lightbox/js/lightbox.min.js"></script>
    <script src="home/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="home/js/main.js"></script>
</body>

</html>