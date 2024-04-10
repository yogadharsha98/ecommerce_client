<div class="container-fluid fruite">
    <div class="container-fluid text-center">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    @foreach($offer_banners as $off)
                    <div class="col-lg-4">
                        @if($off->image)
                        {{-- @if($off->offers=='seasonal_offers')
                        <h1>Seasonal offers</h1>
                        @elseif ($off->offers=='monthly_offers')
                        <h1>Monthly offers</h1>
                        @else
                        <h1>Weekly offers</h1>
                        @endif --}}
                        <img src="{{ asset($off->image) }}" class="img-fluid w-100 rounded-top"
                            alt="Offer Banner Image">

                        @endif
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>