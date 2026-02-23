@extends('admin')

@section('title', 'Navigation Slider')

@section('content')


<div class="main-container-middle">
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">
            <span class="h5 m-0">Navigation Slider</span>
            <div>
                <a href="{{ route('slider-create') }}" class="btn btn-primary"><i class="fas fa-plus-circle mr-1"></i> Add new</a>
            </div>
        </div>
    </div>
    <div class="container-detail">
        <div class="clearfix">
            
            @include('admin.posts.home.index-table')
        </div>
    </div>
</div>


@endsection
