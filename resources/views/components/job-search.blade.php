<form action="{{ url('job/search') }}" class="row page-search-form mt-4 mb-0">
    <div class="col-12 col-lg-3 pr-lg-0">
        <div class="form-group m-lg-0">
            <label for="search" class="sr-only">Search</label>
            <input name="main_search" type="text" value="{{ request('main_search') }}" class="form-control form-control-lg search-input border-right-0" placeholder="Looking for jobs...">
        </div>
    </div>
    <div class="col-12 col-lg-3 px-lg-0">
        <div class="form-group m-lg-0">
            <label for="category" class="sr-only">Category</label>
            <select name="category_id" class="form-control form-control-lg category-input">
                @foreach(Helper::job_categories() as $menu)
                <option value="{{ $menu }}" {{ (request('category_id') == $menu)? 'selected':null }}>{{ $menu }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-2 px-lg-0">
        <div class="form-group m-lg-0">
            <label for="location" class="sr-only">Location</label>
            <select name="location_id" class="form-control form-control-lg category-input">
                @foreach(Helper::job_locations() as $menu)
                <option value="{{ $menu }}" {{ (request('location_id') == $menu)? 'selected':null }}>{{ $menu }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-4 pl-lg-0 mb-3 m-lg-0 ">
        <div class="btn-group btn-block flex-column flex-lg-row">
            <button type="submit" class="btn btn-primary btn-lg mb-3 mb-lg-0">Search </button>
            <div class="btn btn-dark btn-lg" data-toggle="collapse" data-target="#collapse-search" >Other search</div>
        </div>
    </div>
</form>