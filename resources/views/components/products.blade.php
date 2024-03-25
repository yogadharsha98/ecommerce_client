@foreach ($products as $product)
<div class="col-md-6 col-lg-3 col-xl-3 h-20">
    <div class="rounded position-relative fruite-item border border-secondary">
        <a href="{{url('product_details',$product->id)}}">
            {{-- Retrieve the main product image --}}
            <div class="fruite-img position-relative">
                @if($product->productImages->count() > 0)
                <img src="{{ asset($product->productImages->first()->large_image) }}"
                    class="img-fluid w-100 rounded-top product-image" alt="Product Image" style="position: relative;">
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
        <div class="border-top-0 rounded-bottom">
            <p style="font-size: 14px" class="mt-2 mb-2 ms-2">{{$product->product_name}}</p>

        </div>
    </div>
</div>
@endforeach