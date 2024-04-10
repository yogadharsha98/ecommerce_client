<div class="container-fluid mt-3">
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