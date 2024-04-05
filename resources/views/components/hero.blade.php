<div class="container-fluid mb-3 hero-header">
    <div class="container-fluid px-0">
        <div class="row align-items-stretch">
            <!-- Changed align-items-center to align-items-stretch -->
            <div class="col-md-12 col-lg-3  align-items-start d-flex flex-column"
                style="background-color: rgb(255, 121, 10); height:230px;">
                <strong>
                    <h1 style="font-size: 60px;">Welcome!</h1>
                    <br />
                    <h3 class="text-light" style="">Let's experience our best wholesale services</h3>
                </strong>
            </div>
            <div class="col-md-12 col-lg-9 px-0">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach ($slider as $index => $sliderItem)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" id="bannerItem{{ $index }}">
                            <img src="{{ $sliderItem->image }}" class="w-100 h-100" alt="Banner {{ $index }}">
                            <!-- Set the image's height to 100% -->
                            <a href="#" class="btn px-4 py-2 text-white rounded">{{ $sliderItem->title }}</a>
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