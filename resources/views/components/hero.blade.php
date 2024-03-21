<div class="container-fluid mb-5 hero-header">
    <div class="container-fluid px-0">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-12">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach ($slider as $index => $sliderItem)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" id="bannerItem{{ $index }}">
                            <img src="{{ $sliderItem->image }}" class="img-fluid w-100 h-100 bg-secondary rounded"
                                alt="Banner {{ $index }}">
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