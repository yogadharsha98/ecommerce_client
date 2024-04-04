<div class="container-fluid vesitable">
    <div class="owl-carousel vegetable-carousel justify-content-center" data-items="6" data-nav="true"
        data-dots="false">
        @foreach($featuredProducts as $pro)
        <div class="border border-primary rounded position-relative vesitable-item">
            <div class="vesitable-img">
                <a href="{{url('product_details',$pro->id)}}">
                    @if($pro->productImages->count() > 0)
                    <img src="{{ asset($pro->productImages->first()->large_image) }}"
                        class="img-fluid w-100 rounded-top product-image" alt="Product Image"
                        style="position: relative;">
                    <!-- Ensure the image container has relative positioning -->
                    @endif
                    {{-- Retrieve the product thumbnail --}}
                    @if($pro->productThumbnails->count() > 0)
                    <div class="thumbnail">
                        <img src="{{ asset($pro->productThumbnails->first()->thumbnail_image) }}"
                            class="product-thumbnail" alt="Product Thumbnail" style="position: relative;">
                    </div>
                    @endif
                </a>
            </div>
            <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">
                Featured</div>
            <div class="p-4 rounded-bottom">
                <h6>{{ $pro->product_name }}</h6>
                <div class="d-flex align-items-center" style="color:red">
                    <p class="fs-5 fw-bold mb-0"><i class="fas fa-pound-sign"></i>{{
                        $pro->unit_price }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>