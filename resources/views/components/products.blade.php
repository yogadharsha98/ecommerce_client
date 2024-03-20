@foreach ($products as $product)
<div class="col-md-6 col-lg-6 col-xl-6 h-25">
    <div class="rounded position-relative fruite-item border border-secondary">
        {{-- Retrieve the main product image --}}
        @if($product->productImages->count() > 0)
        <div class="fruite-img">
            <img src="{{ asset($product->productImages->first()->large_image) }}"
                class="img-fluid w-100 rounded-top product-image" alt="Product Image">
        </div>
        @endif

        {{-- Retrieve the product thumbnail --}}
        @if($product->productThumbnails->count() > 0)
        <div class="thumbnail">
            <img src="{{ asset($product->productThumbnails->first()->thumbnail_image) }}"
                class="img-thumbnail product-thumbnail" alt="Product Thumbnail">
        </div>
        @endif

        {{-- <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
            Fruits</div> --}}
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
                <a href="{{ route('cart') }}" class="btn rounded-pill px-1 text-primary"><i
                        class="fa fa-shopping-bag  text-primary"></i> Add to cart</a>
            </div>
        </div>
    </div>
</div>
@endforeach