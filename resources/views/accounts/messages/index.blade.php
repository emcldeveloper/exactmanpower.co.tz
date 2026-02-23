@extends('account')

@section('title', 'Home')

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


<h4 class="pb-2 pt-3">My Messages</h4>

<form action="{{ url()->full() }}" method="GET">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Quick search">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>

<div class="clearfix">
    @foreach($messages_list as $row)
    <div class="card mt-4">
            <div class="media p-3">
                <div class="media-body text-left">
                    <h5 class="title m-0"><a href="{{ $row->link }}" class="text-secondary">{{ ($row->post)? $row->post->post_title: 'Untitled' }}</a> </h5>
                    <div class="created-at"> <span class="text-primary">{{ $row->fullname }}</span> - <span class="font-italic">{{ Helper::time_ago($row->created_at) }}</span></div>
                    <div class="">
                        {{ $row->content }}
                    </div>
                    <hr class="mb-1"/>
                    <div class="row">
                        <div class="btn-group ml-2">
                            <a class="btn collapsed py-1 px-2 mr-2" href="javascript:;" data-toggle="collapse" data-target="#multi-collapse-phone-{{ $row->id }}" aria-expanded="false"><i class="fa fa-phone mr-2"></i></a>
                            <a class="btn collapse py-1 px-2 mr-2" href="javascript:;" id="multi-collapse-phone-{{ $row->id }}">{{ $row->phone }}</a>
                        
                            <a class="btn collapsed py-1 px-2 mr-2" href="javascript:;" data-toggle="collapse" data-target="#multi-collapse-whatsapp-{{ $row->id }}" aria-expanded="false"><i class="fab fa-whatsapp mr-2"></i></a>
                            <a class="btn collapse py-1 px-2 mr-2" href="javascript:;" id="multi-collapse-whatsapp-{{ $row->id }}">{{ $row->phone }}</a>
                        
                            <a class="btn collapsed py-1 px-2 mr-2" href="javascript:;" data-toggle="collapse" data-target="#multi-collapse-email-{{ $row->id }}" aria-expanded="false"><i class="fa fa-envelope mr-2"></i></a>
                            <a class="btn collapse py-1 px-2 mr-2" href="javascript:;" id="multi-collapse-email-{{ $row->id }}">{{ $row->email }}</a>
                        </div>
                        <div class="col text-right">
                            <a class="btn text-danger py-1 px-2" href="javascript:;" data-toggle="collapse" data-target="#contact_seller_{{ $row->id }}"><i class="fa fa-trash mr-2"></i> Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    @endforeach

    <div class="clearfix mt-3">
        {{ $messages_list->onEachSide(1)->links() }}
    </div>

    @if($messages_list->count() == 0) 
    <div class="text-center p-5">
        No message
    </div>
    @endif
</div>

@endsection
