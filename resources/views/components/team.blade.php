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
            <h2>Our Team</h2>
            <br>
            <label class="d-flex justify-content-center" style="margin-top: -2em">
                THE GENIUS BEHIND OUR WORK 
            </label>
        </div>
        <div class="container section-padding-bottom">
            @if(Post::team()->count())
            <section class="customer-logos slider " style="width: 100%; position: relative;">

                @foreach(Post::team()->get() as $row)

                <img src="{{ asset($row->image) }}" width="100%" class="bg-image  rounded-circle border-white" style="width:3em; height:150px; border:3px solid; z-index: 1; ">

                <section style="width: 100%; ">
                    <h4 style="white-space: nowrap;">
                          {{Illuminate\Support\Str::limit($row->post_title, 14)}}
                      </h4>
                      <p class="text-primary">
                          {{Illuminate\Support\Str::limit($row->post_team_position, 18)}}
                      </p>
                        <label>
                            {!! Illuminate\Support\Str::limit($row->post_summary, 78) !!}
                        </label>
                          <label>
                              <table class="table "> 
                                  {{-- the implementation is from https://www.itsolutionstuff.com/post/how-to-add-social-media-share-buttons-in-laravelexample.html --}}
                                      <tr>
                                          <td style="border: none;">
                                     {{-- !! Share::page(url('get_updated_with/post/'.$row->post_slug))->whatsapp()->facebook()->linkedin() !! --}}
                                        </td>
                                      </tr>
                              </table>

                          </label>
                </section>


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
            slidesToShow: 13,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            arrows: false,
            dots: false,
            pauseOnHover: true,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 13
                }
            }]
        });
    }
    
});
</script>