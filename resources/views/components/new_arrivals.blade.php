<div class="container-fluid vesitable mb-0">
    <div class="owl-carousel vegetable-carousel justify-content-center" data-items="6" data-nav="true"
        data-dots="false">
        @foreach($new_arrivals as $new)
        <div class="border border-primary rounded position-relative vesitable-item">
            <div class="vesitable-img">
                <a href="{{url('product_details',$new->id)}}">
                    @if ($new->productImages->count() > 0)
                    <!-- If product has images in product_images table -->
                    <img src="{{ asset($new->productImages->first()->large_image) }}"
                        class="img-fluid w-100 rounded-top product-image" alt="Product Image"
                        style="position: relative;">
                    @elseif ($new->productThumbnails->count() > 0)
                    <!-- If product has images in product_thumbnails table -->
                    <img src="{{ asset($new->productThumbnails->first()->image) }}"
                        class="img-fluid w-100 rounded-top product-thumbnail" alt="Product Thumbnail"
                        style="position: relative;">
                    @endif
                </a>
            </div>
            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">
                New Arraivals</div>
            <div class="p-4 rounded-bottom">
                <h6>{{ $new->product_name }}</h6>
                <div class="d-flex align-items-center" style="color:red">
                    <p class="fs-5 fw-bold mb-0"><i class="fas fa-pound-sign"></i>{{
                        $new->unit_price }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

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