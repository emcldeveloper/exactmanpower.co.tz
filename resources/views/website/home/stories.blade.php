@extends('website')

@section('title', $page_title)
@section('page-title', Helper::trans('general.stories', $page_title))

@section('content')

<div class="clearfix">
    <div class="container py-5">
        <h5 class="text-center">{{ Helper::trans('general.descriptions', ' #116Stories come to us through thousands of calls we receive each day about children lives, stories about their families, about their moms and dads and about their surrounding communities.') }}</h5>

        <div class="clearfix pt-5">
            <div class="row justify-content-md-center">
                @if(isset($posts_list) && $posts_list->count())
                @foreach($posts_list as $index => $row)
                @if($index === 0) 
                <div class="col-12 col-md-8 col-lg-9 mb-4">
                    <a href="{{ url('stories/'.$row->post_slug) }}" class="card box-shadow h-100">
                        <div class="row no-gutters h-100">
                            @if($row->has_image)
                            <div class="col-md-7 bg-image section-padding px-0" style="background-image:url('{{ $row->image_thumbnail }}');">
                            </div>
                            @endif
                            <div class="col-md-5">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $row->post_title }}</h5>
                                    <p class="card-text"><small class="text-muted">Last updated {{ Helper::friendly_time($row->post_date) }}</small></p>
                                    <p class="card-text">{!! $row->post_summary !!}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @else 
                <div class="col-12 col-md-4 col-lg-3 mb-4">
                    <a href="{{ url('stories/'.$row->post_slug) }}" class="card box-shadow h-100">
                        @if($row->has_image)
                        <img src="{{ $row->image_thumbnail }}" class="card-img-top" alt="...">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $row->post_title }}</h5>
                            <p class="card-text"><small class="text-muted">Last updated {{ Helper::friendly_time($row->post_date) }}</small></p>
                            <p class="card-text">{!! $row->post_summary !!}</p>
                            
                        </div>
                    </a>
                </div>
                @endif
                @endforeach
                @else
                <div class="col-12 text center">{{ Helper::trans('general.no_data_found', 'No data found') }}</div>
                @endif
            </div>
            {!! pagination_footer($posts_list) !!}
        </div>
    </div>
</div>



@endsection
