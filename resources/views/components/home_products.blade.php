<div class="container-fluid fruite">
    <div class="container-fluid">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Our best Products</h1>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @foreach($data as $data)
                                <div class="col-md-3 col-lg-4 col-xl-2 h-100">
                                    <div class="rounded position-relative fruite-item" style="height: 100%;">
                                        <a href="{{url('category',$data->id)}}">
                                            <div class="fruite-img" style="height: 100%;">
                                                <img src="{{$data->image}}" class="img-fluid w-100 rounded-top" alt=""
                                                    style="height: 200px; object-fit: cover;">
                                            </div>
                                        </a>
                                        <div class="p-2 border border-secondary border-top-0 rounded-bottom">
                                            <strong>
                                                <p style="font-size: 12px;">{{$data->department_title}}</p>
                                            </strong>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mt-3">
                        <div class="col-lg-4 text-start">
                            <h1>All Products</h1>
                        </div>
                    </div>
                    <div class="row g-4 mt-2">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @foreach($products as $product)
                                <div class="col-md-3 col-lg-4 col-xl-2 h-100">
                                    <div class="rounded position-relative fruite-item border border-secondary "
                                        style="height: 100%;">

                                        <a href="{{url('product_details',$product->id)}}">
                                            {{-- Retrieve the main product image --}}
                                            <div class="fruite-img position-relative">
                                                @if($product->productImages->count() > 0)
                                                <img src="{{ asset($product->productImages->first()->large_image) }}"
                                                    class="img-fluid w-100 rounded-top product-image"
                                                    alt="Product Image" style="position: relative;">
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

                                        <div class="p-2  rounded-bottom">
                                            <strong>
                                                <p style="font-size: 10px;">{{$product->product_name}}</p>
                                            </strong>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>