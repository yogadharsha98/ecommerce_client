<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group modal-body d-flex align-items-center">
                    <form action="{{url('product_search')}}" method="GET" class="w-75 mx-auto d-flex gap-2">
                        @csrf
                        <input type="search" name="search" class="form-control p-3" placeholder="search for something"
                            aria-describedby="search-icon-1">
                        <input type="submit" value="search" class="btn btn-primary px-3 ">

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>