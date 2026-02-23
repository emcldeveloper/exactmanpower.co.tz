@extends('customer')

@section('title', 'Blog')

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

<div class="clearfix">
    <div class="container py-5">
        <div class="clearfix">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card p-4">
                        <!-- <h3 class="mb-4">{{ 'Blog' }}</h3> -->
                        <!-- <form class="mb-4" action="{{ url()->full() }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="__search" value="{{ request('__search') }}" class="form-control" placeholder="Quick search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form> -->
                        <div class="row">
                        @if(isset($blog_list) && $blog_list->count())
                            @foreach($blog_list as $row)
                            <div class="col-12 col-lg-6  mb-4">
                                <div class="border h-100">
                                    <a href="{{ url('blog/'.$row->id) }}" 
                                        style="background-image:url('{{ $row->get_featured_image() }}');min-width:240px;"
                                        class="d-block media-image align-self-center" >
                                    </a>
                                    
                                    <div class="media-body text-left align-self-center px-4 pb-4 pt-2">
                                        <div class="text-light mb-3">{{ date('d M, Y', strtotime($row->post_date)) }}</div>
                                        <h5 class="title m-0"><a href="{{ url('blog/'.$row->id) }}" class="text-primary">{{ $row->post_title }}</a> </h5>
                                        
                                        <div class="location mt-1">{!! $row->summary() !!}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <div class="col-12">
                                {{ $blog_list->onEachSide(1)->links() }}
                            </div>
                        @else
                            <div class="col">No blog post</div>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card p-4">
                        <form class="clearfix" action="{{ url()->full() }}">
                            <div class="input-group input-group-search">
                                <input class="form-control" type="search" value="{{ request('__search') }}" name="__search" placeholder="Search..."/>
                                <span class="input-group-append">
                                    <button type="submit" class="btn px-3">
                                        <i class="fa fa-search text-light"></i>
                                    </button >
                                </span>
                            </div>
                        </form>
                        <h6 class="text-center text-uppercase mt-5 mb-3 p font-weight-bold">Popular Blog Categories</h6>
                        <a href="{{ url('blog') }}" class="btn btn-outline-dark mb-3">All category</a>
                        @if(isset($categories_list))
                            @foreach($categories_list as $row)
                            <a href="{{ url('blog/category/'.$row->id) }}" class="btn btn-outline-dark mb-3">{{ $row->name }}</a>
                            @endforeach
                        @endif

                        @if(isset($resent_list) && $resent_list->count())
                            <h6 class="text-center text-uppercase mt-5 mb-3 p font-weight-bold">Hot blogs</h6>
                        
                            @foreach($resent_list as $row)
                            <div class="border mb-4">
                                <a href="{{ url('blog/'.$row->id) }}" 
                                    style="background-image:url('{{ $row->get_featured_image() }}');min-width:240px;"
                                    class="d-block media-image align-self-center" >
                                </a>
                                
                                <div class="media-body text-left align-self-center px-4 pb-4 pt-2">
                                    <div class="text-light mb-3">{{ date('d M, Y', strtotime($row->post_date)) }}</div>
                                    <h5 class="title m-0"><a href="{{ url('blog/'.$row->id) }}" class="text-primary">{{ $row->post_title }}</a> </h5>
                                    
                                    <div class="location mt-1">{!! $row->summary() !!}</div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
