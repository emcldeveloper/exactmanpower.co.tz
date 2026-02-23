@extends('website')

@section('title', Helper::trans('general.team', 'Our Team'))
@section('page-title', Helper::trans('general.team', 'Our Team'))

@section('content')
<style>

.cover-background {
    position: relative;
    background: url('{{ url('img/bg-about.jpg') }}');
    background-position: center;
    background-size: 100%;
    background-repeat: no-repeat;

}
.cover-background > div {
    position: relative;
    z-index: 99;
}
.cover-background:after {
    content: " ";
    position: absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background: rgba(252, 215, 68, 0.8);
}
</style>

<div class="section-padding clearfix">
    <div class="container text-center">
        <!-- <h2>{{ Helper::trans('team.title', 'The Team') }}</h2> -->

        <div class="clearfix pt-4 w-0 w-lg-70 m-auto text-center">
            <p class="h5">{{ Helper::trans('team.about_paragraph_1', 'Our team consists of a Supervisory Board of Directors (responsible for overseeing C-Sema’s governance framework with appropriate accountability and control systems in place) and the Management in charge of daily running of the organisation. ') }}</p>
        </div>

    </div>  
</div>


<section class="section-padding clearfix bg-dark" id="values">
    <div class="container">
        <h2 class="text-center text-white">{{ Helper::trans('team.supervisory', 'Supervisory Board of Directors') }}</h2>
    </div>
</section>

<section class="clearfix bg-dark" id="values">
    <div class="container-fluid">
        <div class="clearfix">
            <div class="row justify-content-md-center mb-0">
                <div class="col-12 col-md-4 col-lg-3 py-5">
                    <div class="text-center pb-3 pb-lg-4">
                        <i class="fa fa-chair fa-5x text-primary"></i>
                    </div>
                    <div class="inner-bottom-xs">
                        <h4 class="text-white">{{ Helper::trans('team.supervisory_step_1', 'i. Board Chairperson') }}</h4>
                        <p class="text-small text-light">{{ Helper::trans('team.supervisory_description_step_1', 'Ambassador Nyasugara P. Kadege (Retired Ambassador, worked as Tanzania ambassador in different countries in Europe and Africa).') }}</p>
                    </div>
                </div>
                
                <div class="col-12 col-md-4 col-lg-3 py-5 bg-primary">
                    <div class="text-center pb-3 pb-lg-4">
                        <i class="fa fa-donate fa-5x text-white"></i>
                    </div>
                    <div class="inner-bottom-xs">
                        <h4 class="text-white">{{ Helper::trans('team.supervisory_step_2', 'ii. Finance & Planning') }}</h4>
                        <p class="text-small">{{ Helper::trans('team.supervisory_description_step_2', 'Richard Raynerius Manamba (certified public accountant, with far-reaching experience in finance systems management and currently working with KPMG as financial analyst in a World Bank funded project. He’s also a consultant and Principal Business Advisor for Tanzania Capital Market Authority and serves the Tanzania Tax Appeal Board as Jurist).') }}</p>
                    </div>
                </div>
                
                <div class="col-12 col-md-4 col-lg-3 py-5">
                    <div class="text-center pb-3 pb-lg-4">
                        <i class="fa fa-venus-mars fa-5x text-primary"></i>
                    </div>
                    <div class="inner-bottom-xs">
                        <h4 class="text-white">{{ Helper::trans('team.supervisory_step_3', 'iii. Gender, Research, Monitoring & Evaluation') }}</h4>
                        <p class="text-small text-light">{{ Helper::trans('team.supervisory_description_step_3', 'Ishika Mshaghuley Mcharo (Principal Researcher, Ministry of Food and Agriculture Development).') }}</p>
                    </div>
                </div>
                
                <div class="col-12 col-md-4 col-lg-3 py-5 bg-primary">
                    <div class="text-center pb-3 pb-lg-4">
                        <i class="fa fa-chart-line fa-5x text-white"></i>
                    </div>
                    <div class="inner-bottom-xs">
                        <h4 class="text-white">{{ Helper::trans('team.supervisory_step_4', 'iv. Social Entrepreneurship – Income Generating Activities') }}</h4>
                        <p class="text-small text-dark">{{ Helper::trans('team.supervisory_description_step_4', 'Saida Segesela (Entrepreneur).') }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="section-padding bg-default">
    <div class="container">
        <h1 class="text-center">The Management</h1>

        <div class="clearfix section-padding-top mt-3">
            <div class="row justify-content-md-center">
                @if(isset($team_list) && $team_list->count())
                @foreach($team_list as $index => $row)
                
                <div class="col-12 col-lg-4 mb-4">
                    <a href="{{ url('team/'.$row->post_slug) }}" class="h-100 text-center">
                        <div class="rounded-circle bg-image border border-primary box-shadow m-auto" style="width:180px;height:180px;background-image:url({{ $row->image_thumbnail }})"></div>
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $row->post_title }}</h5>
                            @if(false)
                            <p class="card-text"><small class="text-muted">Last updated {{ Helper::friendly_time($row->post_modified) }}</small></p>
                            <!-- <p class="card-text">{!! $row->post_summary !!}</p> -->
                            @endif
                        </div>
                    </a>
                </div>
                @endforeach
                @else
                <div class="col-12 text center">{{ Helper::trans('general.no_data_found', 'No data found') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>



@endsection
