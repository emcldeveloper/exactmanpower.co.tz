<div>
    <style>
.slick-slide {
    margin: 0px 20px;
}

.slick-slide img {
    width: 100%;
}

.slick-slider
{
    position: relative;
    display: block;
    box-sizing: border-box;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
            user-select: none;
    -webkit-touch-callout: none;
    -khtml-user-select: none;
    -ms-touch-action: pan-y;
        touch-action: pan-y;
    -webkit-tap-highlight-color: transparent;
}

.slick-list
{
    position: relative;
    display: block;
    overflow: hidden;
    margin: 0;
    padding: 0;
}
.slick-list:focus
{
    outline: none;
}
.slick-list.dragging
{
    cursor: pointer;
    cursor: hand;
}

.slick-slider .slick-track,
.slick-slider .slick-list
{
    -webkit-transform: translate3d(0, 0, 0);
       -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
         -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
}

.slick-track
{
    position: relative;
    top: 0;
    left: 0;
    display: block;
}
.slick-track:before,
.slick-track:after
{
    display: table;
    content: '';
}
.slick-track:after
{
    clear: both;
}
.slick-loading .slick-track
{
    visibility: hidden;
}

.slick-slide
{
    display: none;
    float: left;
    height: 100%;
    min-height: 1px;
}
[dir='rtl'] .slick-slide
{
    float: right;
}
.slick-slide img
{
    display: block;
}
.slick-slide.slick-loading img
{
    display: none;
}
.slick-slide.dragging img
{
    pointer-events: none;
}
.slick-initialized .slick-slide
{
    display: block;
}
.slick-loading .slick-slide
{
    visibility: hidden;
}
.slick-vertical .slick-slide
{
    display: block;
    height: auto;
    border: 1px solid transparent;
}
.slick-arrow.slick-hidden {
    display: none;
}
</style>

<div class="clearfix bg-white ">
    <div class="text-dark">
        <div class="container section-padding text-center ">
            <h2>Our Clients</h2>
        </div>
        <div class="container section-padding-bottom">
            @if(Post::client()->count())
            <section class="customer-logos slider">
                @foreach(Post::client()->get() as $row)
                <a href="{{ url('magazine/'.$row->post_slug) }}" class="slide" target="__blank"><img src="{{ $row->image }}"></a>
                @endforeach
            </section>
            
            @else
            <div class="col-12 text-center">No data found</div>
            @endif
            
        </div>
    </div>  
</div>

<script>
jQuery(document).ready(function(){

    if(jQuery.fn.slick) {
        jQuery('.customer-logos').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            arrows: false,
            dots: false,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 4 
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 3
                }
            }]
        });
    }
    
});
</script>




{{-- <div class=" container bg-light">

<div class="col-md-12" style="padding-top: 2em;">
    <h2 class="text-primary d-flex justify-content-center">
        Our Clients 
    </h2>
</div>

@if($clients->count()>0)
<div class="row " style="padding-top: 2em;">
    
    @foreach($clients as $key => $client)
        <div class="col-md-2" >
            <a href="{{ url('/'.$client->post_id) }}"  class="d-flex justify-content-center bg-image" target="__blank"><img src="{{ $client->image }}" style="width:11em;  height:160px;   z-index: 1; "></a>

             <img src="{{ asset($testimony->image) }}" width="100%" class="bg-image  rounded-circle border-white" style="width:11em; height:160px; border:3px solid; z-index: 1; "> 
            <br>
        </div>

    @endforeach
    @endif
    <div class="col-md-12 d-flex justify-content-center" style="padding-top: 3em; padding-bottom: 1em;">
        {{ $clients->links('pagination-4') }}
        {{$clients->onEachSide(3)->links(data: ['scrollTo'=>false]) }}
        {{ $clients->onEachSide(1)->links('pagination::simple-tailwind',data: ['scrollTo'=>false]) }} 
     </div>
</div>

</div>
--}}
</div>