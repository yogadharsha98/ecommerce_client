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


    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Get in touch</h1>
                            <p class="mb-4">The contact form is currently inactive. Get a functional and working contact
                                form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code
                                and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="h-100 rounded">
                            <iframe class="rounded w-100" style="height: 400px;"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387191.33750346623!2d-73.97968099999999!3d40.6974881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1694259649153!5m2!1sen!2sbd"
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form action="" class="">
                            <input type="text" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name">
                            <input type="email" class="w-100 form-control border-0 py-3 mb-4"
                                placeholder="Enter Your Email">
                            <textarea class="w-100 form-control border-0 mb-4" rows="5" cols="10"
                                placeholder="Your Message"></textarea>
                            <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary "
                                type="submit">Submit</button>
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Address</h4>
                                <p class="mb-2">123 Street New York.USA</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Mail Us</h4>
                                <p class="mb-2">info@example.com</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded bg-white">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Telephone</h4>
                                <p class="mb-2">(+012) 3456 7890</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


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