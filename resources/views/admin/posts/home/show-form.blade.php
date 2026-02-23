
<style>
.main-viewport {
    z-index: 1;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    /* height: calc(100% - 95px) !important; */
}

.carousel-indicators {
    margin-bottom: 110px;
}

.carousel-indicators li {
    width: 16px;
    height: 16px;
    border-radius: 16px;
    overflow: hidden;
    border-top: none;
    border-bottom: none;
    background-color: #ee7822;
    opacity: .3;
    margin-right: 6px;
    margin-left: 6px;
}

.carousel-caption {
    bottom: 160px;
    right: 10%;
    left: 10%;
    text-transform: normal;
    font-weight: bold;
    text-align: left;
}
.carousel-caption * {
    text-transform: none; 
    font-size: 3.0rem;
    text-shadow: 2px 2px 4px #969696;
}

.btn-light-custome {
    color:#33a3dc;
    background: white;
    border-color: white;
    font-weight: bold;
    font-size: 20px;
    text-align: left;
}

.btn-light-custome:hover {
    color: white;
    background: #ee7822;
    border-color: #ee7822;
}

.customer-says .slick-list {
    overflow-y: visible;
}

.customer-says  .slick-slide img {
    width: 30px;
}

.form-view {
    margin-bottom: 0;
    border-bottom: 1px dashed #ced4da;
}

.form-view .form-control {
    border: none;
    background: transparent;
}
</style>

<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent

    <!----- End include view from components/alert----->
    
    <div class="card card-body col-12 col-md-10 m-auto">
            <!----- Start form field name ----->
             @include('status')
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">


    <div class="carousel-inner">
 
        <div class="carousel-item active" style="background:url('{{ $slider->image }}') ;  width: 100%;">
            <div class="carousel-caption d-none d-md-block">
                <h5 class="display-4 font-weight-normal text-secondary mb-0">{!! $slider->post_title !!}</h5>
                <p class="display-4 defaut-font text-primary font-weight-bold">{!! $slider->post_content !!}</p>
            </div>
        </div>

        
    </div>
    <ol class="carousel-indicators">
        @if(isset($sliders_list) && $sliders_list->count() > 0 && false)
        @foreach($sliders_list as $index => $row)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ ($index == 0)? 'active': ''}}"></li>
        @endforeach
        @else
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        @endif
        
    </ol>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">{{ Helper::trans('general.previous', 'Previous') }}</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">{{ Helper::trans('general.next', 'Next') }}</span>
    </a>
</div>
            <!----- End form field name ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-outline-dark mt-4" href="{{ url('admin/posts/home/slider/edit/' . $slider->id) }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>