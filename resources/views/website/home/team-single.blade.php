@extends('website')

@section('title', Helper::trans('general.team', 'Our Team'))
@section('page-title', Helper::trans('general.team', 'Our Team'))

@section('content')

<div class="clearfix">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-lg-8">
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
            <div class="col-12 col-lg-4">
                @if(isset($team_list) && $team_list->count())
                @foreach($team_list as $index => $row)
                <a href="{{ url('team/'.$row->post_slug) }}" class="media mb-3">
                    <div class="rounded-circle bg-image border border-primary mr-3" style="width:40px;height:40px;background-image:url({{ $row->image_thumbnail }})"></div>
                    <div class="media-body">
                        <h5 class="mt-0">{{ $row->post_title }}</h5>
                        @if(false)
                        <p class="card-text"><small class="text-muted">Last updated {{ Helper::friendly_time($row->post_modified) }}</small></p>
                        <!-- <p class="card-text">{!! $row->post_summary !!}</p> -->
                        @endif
                    </div>
                </a>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
