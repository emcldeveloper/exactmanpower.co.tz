
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($sub_page_list) !!}
            </div>
            {!! pagination_header_search($sub_page_list) !!}
        </div>
    </div>

    <div class="p-3">
        @foreach ($sub_page_list as $index => $post)
        <div class="card mt-3">
            {!! $post->featured() !!}
            <div class="media p-3">

                <a href="{{ $post->relative_link() }}" 
                    style="background-image:url('{{ $post->get_featured_image() }}')"
                    class="d-block media-image align-self-center mr-5" >
                </a>

                <div class="media-body text-left">
                    @if($post->is_business())
                    <h5 class="title mt-0 mb-2"><a href="{{ $post->relative_link() }}" class="text-primary">{{ $post->post_title }}</a> </h5>
                    <div class="location font-weight-bold  mb-2">{!! ($post->location)? $post->location->name: null !!}</div>
                    <div class="location">{!! $post->summary() !!}</div>
                    @else
                    <h5 class="title mt-0 mb-2"><a href="{{ $post->relative_link() }}" class="text-secondary">{{ $post->post_title }}</a> </h5>
                    <div class="condition text-primary font-weight-bold mb-2">{!! ($post->condition)? $post->condition->label: null !!}</div>
                    <div class="location mb-2">{!! ($post->location)? $post->location->name: null !!}</div>
                    <div class="created-at mb-2">{{ Helper::time_ago($post->created_at) }}</div>
                    <div class="price text-primary font-weight-bold"> <span class="currence">Tsh</span> {{ number_format($post->price) }}/=</div>
                    @endif
                </div>

                @if(Request::is('admin/manage-ads/banner/*'))
                <div class="col text-center">
                    <img class="border" src="{{ $post->get_featured_image() }}" style="max-height:200px; max-width:100%"/>
                </div>
                
                @endif
            </div>
            <div class="card-footer py-2">
                <div class="row">
                    <div class="mr-5" style="min-width:300px;">
                        <div class="btn-group btn-group-sm ml-2">
                            @if(Request::is('admin/manage-ads/banner/*'))
                                <a class="btn btn-light border py-1 px-2 mr-2" href="javascript:;"><i class="fa fa-eye text-primary mr-2"></i> {{ $post->views }}</a>
                                <a class="btn btn-light border py-1 px-2 mr-2" href="javascript:;"><i class="fa fa-hand-pointer text-primary mr-2"></i> {{ $post->clicks }}</a>
                            @endif

                            @if($post->is_business() || $post->is_ads())
                                <a class="btn btn-light border py-1 px-2 mr-2" href="javascript:;"><i class="icon-eye text-primary mr-2"></i> {{ $post->views()->count() }}</a>
                                @if($post->call_link())
                                <a class="btn btn-light border py-1 px-2 mr-2" href="{{ $post->call_link() }}"><i class="icon-Call text-primary mr-2"></i> {{ $post->calls()->count() }}</a>
                                @endif
                                @if($post->whatsapp_link())
                                <a class="btn btn-light border py-1 px-2 mr-2" href="{{ $post->whatsapp_link() }}" target="_blank"><i class="icon-whatsapp1 text-primary mr-2"></i> {{ $post->whatsapps()->count() }}</a>
                                @endif
                                <a class="btn btn-light border py-1 px-2" href="javascript:;" data-toggle="collapse" data-target="#contact_seller_{{ $post->id }}"><i class="icon-My-Messages text-primary mr-2"></i> {{ $post->emails()->count() }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary btn-sm" href="{{ $post->action_link('edit/package') }}">Upgrade</a>
                    </div>
                    <div class="col">
                        <div class="custom-control custom-checkbox d-flex">
                            <input type="checkbox" name="selected[{{ $post->id }}]" class="custom-control-input" id="select_{{ $post->id }}">
                            <label class="custom-control-label" for="select_{{ $post->id }}">Select</label>
                        </div>
                    </div>
                    <div class="col text-right">
                        <div class="btn btn-outline-dark btn-sm dropdown">
                            <span class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ $post->action_link('edit/details') }}">Edit</a>
                                <a class="dropdown-item" href="{{ $post->action_link('delete') }}" data-confirmation="Are you sure, you want to delete?">Delete</a>
                                <!-- <a class="dropdown-item" href="#">Submit</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        

        @if($sub_page_list->count() == 0) 
        <div class="text-center p-5">
            No data found
        </div>
        @endif 
    </div>

    {!! pagination_footer($sub_page_list) !!}
</div>