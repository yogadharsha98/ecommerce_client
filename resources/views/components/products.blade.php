@foreach ($products as $product)
<div class="col-md-6 col-lg-3 col-xl-3 h-20 p-2">
    <div class="rounded position-relative fruite-item border border-secondary">
        <a href="{{ url('product_details', $product->id) }}">
            {{-- Retrieve the main product image --}}
            <div class="fruite-img position-relative">
                @if ($product->productImages->count() > 0)
                <!-- If product has images in product_images table -->
                <img src="{{ asset($product->productImages->first()->large_image) }}"
                    class="img-fluid w-100 rounded-top product-image" alt="Product Image" style="position: relative;">
                @elseif ($product->productThumbnails->count() > 0)
                <!-- If product has images in product_thumbnails table -->
                <img src="{{ asset($product->productThumbnails->first()->image) }}"
                    class="img-fluid w-100 rounded-top product-thumbnail" alt="Product Thumbnail"
                    style="position: relative;">
                @endif
            </div>
        </a>

        <div class="rounded-bottom">
            <strong class="d-flex justify-content-center">
                <p style="font-size: 14px;" class="text-dark">{{$product->product_name}}</p>
            </strong>
            <div class="d-flex justify-content-center">
                <p class="info" style="display: none; font-size:13px;">
                    {{$product->product_description}}
                </p>
            </div>


            <div>
                <strong class="d-flex justify-content-center">
                    <p style="font-size: 18px; color:red"> <i class="fas fa-pound-sign"></i>{{$product->unit_price}}</p>
                </strong>
                <div class="d-flex justify-content-center gap-1 flex-row text-center">
                    <strong>
                        <p class="info py-2 rounded px-1 text-dark"
                            style="display: none; font-size:11px; background-color:rgb(235, 235, 235)">
                            {{$product->bcqty_1}} for
                            <i class="fas fa-pound-sign"></i>{{$product->bcp_1}}
                        </p>
                    </strong>
                    <strong>
                        <p class="info py-2 rounded px-1 text-dark"
                            style="display: none; font-size:11px; background-color:rgb(235, 235, 235)">
                            {{$product->bcqty_2}} for
                            <i class="fas fa-pound-sign"></i>{{$product->bcp_2}}
                        </p>
                    </strong>
                    <strong>
                        <p class="info py-2 rounded px-1 text-dark"
                            style="display: none; font-size:11px; background-color:rgb(235, 235, 235)">
                            {{$product->bcqty_3}} for
                            <i class="fas fa-pound-sign"></i>{{$product->bcp_3}}
                        </p>
                    </strong>

                </div>
            </div>


        </div>
    </div>
</div>
@endforeach




<script>
    document.addEventListener("DOMContentLoaded", function () {
        const fruiteItems = document.querySelectorAll('.fruite-item');

        fruiteItems.forEach(item => {
            item.addEventListener('mouseenter', function () {
                const bulkInfo = item.querySelectorAll('.info');
                bulkInfo.forEach(info => {
                    info.style.display = 'block';
                });
            });

            item.addEventListener('mouseleave', function () {
                const bulkInfo = item.querySelectorAll('.info');
                bulkInfo.forEach(info => {
                    info.style.display = 'none';
                });
            });
        });
    });
</script>