@foreach ($products as $product)
<div class="col-md-6 col-lg-6 col-xl-4 h-20">
    <div class="rounded position-relative fruite-item border border-secondary">
        {{-- Retrieve the main product image --}}
        <div class="fruite-img position-relative">
            @if($product->productImages->count() > 0)
            <img src="{{ asset($product->productImages->first()->large_image) }}"
                class="img-fluid w-100 rounded-top product-image" alt="Product Image" style="position: relative;">
            <!-- Ensure the image container has relative positioning -->

            {{-- View button --}}
            <a href="{{url('product_details',$product->id)}}" class="btn btn-secondary view-button text-light"
                style="position: absolute; top: 10px; left: 10px; z-index: 1;">View</a>
            @endif
        </div>

        {{-- Retrieve the product thumbnail --}}
        @if($product->productThumbnails->count() > 0)
        <div class="thumbnail">
            <img src="{{ asset($product->productThumbnails->first()->thumbnail_image) }}"
                class="img-thumbnail product-thumbnail" alt="Product Thumbnail">
        </div>
        @endif

        <div class="p-4  border-top-0 rounded-bottom">
            <div class="d-flex justify-content-between">
                <p>{{ $product->product_name }}</p>
                <p>{{ $product->case }} x {{ $product->units }} x {{ $product->kg_ml }}
                </p>
            </div>
            <p>case of {{ $product->case }}</p>
            <p>{{ $product->units }} x {{ $product->kg_ml }}</p>

            <div class="d-flex justify-content-between flex-lg-wrap">
                <p class="text-dark fw-bold mb-0"> <i class="fas fa-pound-sign"></i>
                    {{ $product->wscp_vat }}</p>
                <a href="{{ route('cart', ['productId' => $product->id]) }}"
                    class="btn rounded-pill border border-secondary px-1 text-primary"><i
                        class="fa fa-shopping-bag  text-primary"></i> Add to cart</a>
            </div>
        </div>
    </div>
</div>
@endforeach