

<div class="card card-body border-0">
    <form action="{{ url()->current() }}" class="row page-search-form  mb-3">
        <div class="col-12 col-lg-5 pr-lg-0">
            <div class="form-group m-lg-0">
                <label for="search" class="sr-only">Quick Search</label>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control search-input" placeholder="Quick search">
            </div>
        </div>
        <div class="col-12 col-lg-4 px-lg-0">
            <div class="form-group m-lg-0">
                <label for="category" class="sr-only">Filter</label>
                <select name="category_id" class="form-control">
                    <option value="">Filter</option>
                    @foreach(Helper::categories() as $row)
                        <option value="{{ $row->id }}" {{ (request('category_id') == $row->id)? 'selected':null }}>{{ $row->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-3 pl-lg-0 m-lg-0 ">
            <button type="submit" class="btn btn-primary btn-block">Search </button>
        </div>
    </form>

    <form action="{{ url()->current() }}">
        <div class="form-inline page-search-form mb-3">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            <div class="form-group ml-lg-0 ml-0">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="select_all" class="custom-control-input" id="select_all" required>
                    <label class="custom-control-label" for="select_all">Select All</label>
                </div>
            </div>
            <div class="form-group ml-lg-3 ml-0">
                <label for="category" class="sr-only">Bulk Action</label>
                <select name="action" class="form-control">
                    <option value="">Bulk action</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary ml-lg-3 ml-0">Apply </button>
        </div>

        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        @foreach($reported_posts_list as $row)
        @php 
        $post = $row->post;  
        $alert = 'alert-warning';
        if($row->status == 1){
            $alert = 'alert-success';
        } elseif($row->status == 2) {
            $alert = 'alert-danger';
        }
        @endphp
        @if($post)
        <div class="card mt-3">
            {!! $post->featured() !!}
            <div class="{{ $alert }}">
                <div class="media p-3">

                    <a href="{{ url($post->route('show').'/'.$post->post_id) }}" 
                        style="background-image:url('{{ $post->get_featured_image() }}')"
                        class="d-block media-image align-self-center mr-5" >
                    </a>

                    <div class="media-body text-left">
                        @if($post->is_business())
                        <h5 class="title mt-0 mb-2"><a href="{{ url($post->route('show').'/'.$post->post_id) }}" class="text-primary">{{ $post->post_title }}</a> </h5>
                        <div class="location font-weight-bold  mb-2">{!! ($post->location)? $post->location->name: null !!}</div>
                        <div class="location">{!! $post->summary() !!}</div>
                        @else
                        <h5 class="title mt-0 mb-2"><a href="{{ url($post->route('show').'/'.$post->post_id) }}" class="text-secondary">{{ $post->post_title }}</a> </h5>
                        <div class="condition text-primary font-weight-bold mb-2">{!! ($post->condition)? $post->condition->label: null !!}</div>
                        <div class="location mb-2">{!! ($post->location)? $post->location->name: null !!}</div>
                        <div class="created-at mb-2">{{ Helper::time_ago($post->created_at) }}</div>
                        <div class="price text-primary font-weight-bold"> <span class="currence">Tsh</span> {{ number_format($post->price) }}/=</div>
                        @endif
                    </div>
                </div>
                <div class="px-3">
                    <div class="alert alert-light font-italic">
                        <div >{{ date('M d, Y', strtotime($row->reported_time)) }}</div>
                        <div>{{ $row->notes }}</div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer py-2">
                <div class="row">
                    <div class="mr-5" style="min-width:300px;">
                        <div class="btn-group btn-group-sm ml-2">
                            <a class="btn btn-light border py-1 px-2 mr-2" href="javascript:;"><i class="icon-eye text-primary mr-2"></i> {{ $post->views()->count() }}</a>
                            @if($post->call_link())
                            <a class="btn btn-light border py-1 px-2 mr-2" href="{{ $post->call_link() }}"><i class="icon-Call text-primary mr-2"></i> {{ $post->calls()->count() }}</a>
                            @endif
                            @if($post->whatsapp_link())
                            <a class="btn btn-light border py-1 px-2 mr-2" href="{{ $post->whatsapp_link() }}" target="_blank"><i class="icon-whatsapp1 text-primary mr-2"></i> {{ $post->whatsapps()->count() }}</a>
                            @endif
                            <a class="btn btn-light border py-1 px-2" href="javascript:;" data-toggle="collapse" data-target="#contact_seller_{{ $post->id }}"><i class="icon-My-Messages text-primary mr-2"></i> {{ $post->emails()->count() }}</a>
                        </div>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary btn-sm" href="{{ url($post->route('show').'/'.$post->post_id) }}">View</a>
                        
                    </div>
                    <div class="col text-right">
                        <div class="btn btn-outline-dark btn-sm dropdown">
                            <span class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url($route.'/details/'.$post->post_id) }}">Edit</a>
                                <a class="dropdown-item" href="{{ url($route.'/delete/'.$post->post_id) }}" data-confirmation="Are you sure, you want to delete?">Delete</a>
                                <!-- <a class="dropdown-item" href="#">Submit</a> -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        <div class="clearfix mt-3">
            {{ $reported_posts_list->onEachSide(1)->links() }}
        </div>

        @if($reported_posts_list->count() == 0) 
        <div class="text-center p-5">
            No data found
        </div>
        @endif
    </form>
    
</div>