<div class=" container">
    <style type="text/css">
        
        .read-more-show{
      cursor:pointer;
      color: #ed8323;
    }
    .read-more-hide{
      cursor:pointer;
      color: #ed8323;
    }

    .hide_content{
      display: none;
    }
    </style>
    <div class="col-md-12 ">
    <h2 class="text-primary d-flex justify-content-center">Our Team </h2>
    <br>
    <label class="d-flex justify-content-center" style="margin-top: -2em">
        THE GENIUS BEHIND OUR WORK 
    </label>
</div>
@if($team->count()>0)
<div class="row " style="padding-top: 3em;">
        @foreach($team as $key => $testimony)
        <div class="col-md-4 ">
            <div class="row">
                <div class="col-md-5 d-flex justify-content-center">
                    <img src="{{ asset($testimony->image) }}" width="100%" class="bg-image  rounded-circle border-white" style="width:11em; height:160px; border:3px solid; z-index: 1; ">
                </div>
                <div class="col-md-7 text-dark">
                    <h4>
                        {{Illuminate\Support\Str::limit($testimony->post_title, 1000)}}
                    </h4>
                    <p class="text-primary">
                        {{Illuminate\Support\Str::limit($testimony->post_team_position, 1000)}}
                    </p>
                      <label>
                          {{-- !! Illuminate\Support\Str::limit($testimony->post_summary, 109) !! --}}

                       <div class="comment more">
                            @if(strlen($testimony->post_summary) > 78)
                            {!!substr($testimony->post_summary,0,78) !!}
                            <span class="read-more-show hide_content">More <i class="fa fa-angle-down"></i> ...
                            </span>
                            <span class="read-more-content"> {!! substr($testimony->post_summary,78,strlen($testimony->post_summary)) !!} 
                            <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span>
                             </span>
                            @else
                            {!! $testimony->post_summary !!}
                            @endif

                        </div>
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
                </div>
             </div>
        </div>
        <script type="text/javascript">
                        // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
                                    $('.read-more-content').addClass('hide_content')
                                    $('.read-more-show, .read-more-hide').removeClass('hide_content')

                                    // Set up the toggle effect:
                                    $('.read-more-show').on('click', function(e) {
                                      $(this).next('.read-more-content').removeClass('hide_content');
                                      $(this).addClass('hide_content');
                                      e.preventDefault();
                                    });

                                    // Changes contributed by @diego-rzg
                                    $('.read-more-hide').on('click', function(e) {
                                      var p = $(this).parent('.read-more-content');
                                      p.addClass('hide_content');
                                      p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
                                      e.preventDefault();
                                    });
                        </script>
    @endforeach
    @endif
    <div class="col-md-12 d-flex justify-content-center">
        {{-- $team->links('pagination-4') --}}
        {{$team->links(data: ['scrollTo'=>false]) }}
        {{-- $team->onEachSide(1)->links('pagination::simple-tailwind',data: ['scrollTo'=>false]) --}} 
     </div>
</div>
</div>
