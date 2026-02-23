@extends('website')

@section('title', $page_title)
@section('page-title', 'Services')
@section('page-description', 'We Help you transform your business through effective use of Human Resources. We work in partnership with you to implement appropriate HR services, interventions and solutions that ultimately deliver desired outcomes for your business.')

@section('content')

<style>
.card-custom:hover {
    background: #33A3DC !important;
    color: white !important;
}

.card-custom:hover * {
    color: white !important;
}

.card-custom:hover .bg-custom {
    background: #EE7822 !important;
}
</style>

<div class="clearfix bg-default">
    <div class="container section-padding">

        <div class="clearfix">
            <div class="row justify-content-md-center h-100 mb-5">
                @if(isset($posts_list) && $posts_list->count())
                @foreach($posts_list as $index => $row)
                 
                <div class="col-12 col-md-4 col-lg-4 h-100 mb-4">
                    <a href="{{ url('services/'.$row->post_slug) }}" class="card card-body card-custom box-shadow px-4 border-0 h-100 d-flex" style="background-color:rgba(255,255,255,1);border-radius:5px;font-size:18px;margin-top:55px;">
                        <div class="bg-secondary bg-custom rounded-circle mx-auto border-white p-3" style="
                            
                            margin-top:-55px; margin-bottom:30px;
                            border:3px solid;">
                            <div class="bg-image rounded-circle" style="
                                @if($row->has_image)
                                background-image:url('{{ $row->icon }}');
                                @else
                                background-image:url('{{ asset('img/avatar-placeholder.jpg') }}');
                                @endif
                                width:70px;height:70px;"></div>
                        </div>
                        <div class="clearfix text-center">
                            <h3 class="text-secondary text-truncate w-100 mb-3">{{ $row->post_title }}</h3>
                            <p class="clearfix">
                                {!! Illuminate\Support\Str::limit($row->post_summary,85) !!}
                            </p>
                        </div>

                        <div class="text-center">
                            <span class="btn btn-primary btn-lg rounded-pill box-shadow py-3" style="margin-bottom:-68px;">Read More</span>
                        </div>
                    </a>
                </div>
                @endforeach
                @else
                <div class="col-12 text-center">{{ Helper::trans('general.no_data_found', 'No data found') }}</div>
                @endif
            </div>
            @if(isset($posts_list) && $posts_list->count())
            {!! pagination_footer($posts_list) !!}
            @endif
        </div>
    </div>
</div>

@include('components.bridging-process', ['background'=>'bg-white'])

@endsection
