@extends('website')

@section('title', $page_title)
@section('page-title', Helper::trans('page.stories', 'Stories'))


@if(isset($post_model) && $post_model && $post_model->has_image)
@section('bg-image', $post_model->image)
@endif

@section('content')

<div class="clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-9 pr-3 pr-md-5 py-5">
                <h1 class="text-left h3">{{ $page_title }}</h1>
                
                <div class="clearfix mt-4">
                    @if(isset($post_model) && $post_model)
                    <p class="card-text"><small class="text-muted">Last updated {{ Helper::friendly_time($post_model->post_date) }}</small></p>
                    @if($post_model->has_image)
                    <img class="img-thumbnail" src="{{ $post_model->image }}" alt="{{ $page_title }}" srcset="">
                    @endif
                    <div class="clearfix mt-4">
                        {!! $post_model->post_content !!}
                    </div>
                    @else
                    {{ Helper::trans('general.coming_soon', 'Coming soon') }}
                    @endif
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class=" py-5">
                    <h3 class="text-center h4">Related</h3>
                    <div>
                    @if(isset($posts_list) && $posts_list->count())
                    @foreach($posts_list as $index => $row)
                    <a href="{{ url('stories/'.$row->post_slug) }}" class="card box-shadow mb-3">
                        @if($row->has_image)
                        <img src="{{ $row->image_thumbnail }}" class="card-img-top" alt="...">
                        @endif
                        <div class="card-body">
                            <h6 class="card-title mb-0">{{ $row->post_title }}</h6>
                        </div>
                    </a>
                    @endforeach
                    @else
                    <div class="col-12 text center">{{ Helper::trans('general.no_data_found', 'No data found') }}</div>
                    @endif
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
</div>



@endsection
