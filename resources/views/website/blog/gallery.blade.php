@extends('website')
<!-- We have remove helper for a while and replace with Gallery, more study is needed to understand, to make it work, replace Gallery with Helper::trans('general.blog', 'Gallery') -->
@section('title', 'Gallery')
<!-- After page-tille add Helper::trans('general.blog_title', 'Stay Connected With Us' -->
@section('page-title', 'Gallery')
@section('content')
<style>
.pagination { 
    justify-content: center!important; 
}
.page-item .page-link {
    padding: .2rem .6rem;
    margin-right: 5px;
    border-radius: 5px !important;
}
.page-item.disabled, .page-item.readonly {
    background: none;
}
</style>
<div class="container">      
        @if(isset($blog_list) && $blog_list->count())
          <div class="row" style="padding: 10; margin-top: 10px;">
            @foreach($blog_list   as $row)
              @if($row->post_status == '1')
                    <div class="col-md-6" style="margin-bottom:10px;margin-top:10px;">
                        <div class="card border-top-0 border-left-0 border-right-0 border-bottom-0" >
                            <div class="card-body"  
                                class="d-block media-image card align-self-center">

                                <img src="{{ asset($row->image) }}" style="overflow: auto; max-height: 350px; border:2px solid black; background-size: cover; width: 100%; box-shadow: 6px 6px 4px 0 #6b6a6a, 0 6px 20px 0 rgba(0, 0, 0, 0.19)" alt="" title="">

                            </div>
                          <div class="card-footer bg-transparent">
                            <p class="card-title">@if(isset($row->event_date)){{ date('d M, Y', strtotime($row->event_date))}}, {{$row->post_summary}}@endif</p>
                            <h5 class="card-title" style="color: #33A3DC"><b>{{ $row->post_title }}</b></h5>
                            <p class="card-text">{{-- $row->post_summary --}}</p>
                            
                          </div>
                        </div>
                    </div>
                    @endif
            @endforeach
            <div class="col-12">
                {{$blog_list->onEachSide(1)->links('pagination::bootstrap-4')}}
                {{-- $blog_list->onEachSide(1)->links() --}}
            </div>
        @else
            <div class="col">No blog post</div>
        @endif
        </div>
          </div>
@endsection
