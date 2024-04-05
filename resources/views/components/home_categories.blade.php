<div class="container-fluid fruite">
    <div class="container-fluid">
        <div class="tab-class text-center">
            <div class="row g-4 mt-2">
                <div class="col-lg-4 text-start">

                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-1">
                                @foreach($data as $data)
                                <div class="col-md-6 col-lg-4 col-xl-2 h-100">
                                    <div class="rounded position-relative fruite-item" style="height: 100%;">
                                        <a href="{{ url('category', $data->id) }}">
                                            <div class="fruite-img" style="height: 100%;">
                                                <img src="{{ $data->image }}" class="img-fluid w-100 rounded-top" alt=""
                                                    style="height: 200px; object-fit: cover;">
                                            </div>
                                        </a>
                                        <div class="p-2 border rounded-bottom">
                                            <strong>
                                                <p style="font-size: 12px;">{{ $data->department_title }}</p>
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