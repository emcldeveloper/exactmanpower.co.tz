@extends('admin')

@section('title', Str::title(request('post_type_id')))

@section('content')
<div class="main-container-middle">
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">
            <div class="h5 m-0">
                <a href="{{ route('slider-list') }}" class="btn btn-outline-primary mr-3" title="Back to posts list"><i class="fas fa-arrow-left"></i></a>
                <span>Create Slider </span>
            </div>
            <div>
                <!-- <a href="{{ url('admin/posts/posts/list') }}" class="btn btn-primary"><i class="fas fa-list mr-1"></i> List</a> -->
            </div>
        </div>
    </div>
    <div class="container-detail bg-white">
        <div class="p-3">
            @include('admin.posts.home.create-form')
        </div>
    </div>
</div>
@endsection