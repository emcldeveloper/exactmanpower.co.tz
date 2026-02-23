<div class="row-fluid testimony" id="img-fluid" style="height: 300px">
        <div class=" bg-transparent">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol> 


<div id="myCarousel1" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
    </ol>


    <div class="carousel-inner bg-transparent" style="height: 100px; width: 100%;" >
        @foreach(\App\Models\Post::where('post_type_id','testimony')->get() as $key => $testimony)
         {{-- $testimony->status!="0" && --}} 
	       <div class="carousel-item {{$key == 0 ? 'active' : '' }}" >
              <div class=" container-fluid">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="{{ asset($testimony->image) }}" width="100%" class="bg-image mx-auto rounded-circle border-white" style="width:100px; height:100px;margin-top:0px; border:3px solid; z-index: 1;">
                    </div>

                    <div class="col-md-12 carousel-caption  text-center " style="margin-left: -3em;" >
                      
                      
                      <div class="col-md-12">
                        <p class="border-bottom border-warning d-flex justify-content-center" style=" margin-top:-12em; font-size: 20px;">
                            {{$testimony->post_title}}  
                           </p>

                          <p  style=" font-size: 18px; margin-top: -1em;">
                            <img class="mb-2 mr-2" src="{{ asset('img/icons/quet.svg') }}" width="30" alt="">
                                {!! $testimony->post_summary !!}       
                          </p>
                      </div>
                </div>
              </div>
           </div>

        @endforeach
    </div>

   {{-- <a class="carousel-control-prev" href="#myCarousel1" role="button"  data-slide="prev">
        <i class="fa fa-angle-left fa-3x" style="color: #D36314"></i>
        <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next"  href="#myCarousel1" role="button" data-slide="next">
        <i class="fa fa-angle-right fa-3x" style="color: #D36314"></i>
        <span class="sr-only">Next</span>
    </a> --}}

</div>
</div>
</div>




</div>