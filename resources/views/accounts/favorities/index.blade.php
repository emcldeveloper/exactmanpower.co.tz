@extends('account')

@section('title', 'Home')

@section('content')

<h4 class="pb-2 pt-3">Favorities</h4>
<div class="clearfix">
    
    @foreach($post_list as $post)
    <div class="card mt-3">
        <div class="p-3">
            <div class="media">
                <a href="javascript:;" 
                    style="background-image:url('{{ $post->get_featured_image() }}')"
                    class="d-block media-image align-self-center mr-5" >
                </a>
                
                <div class="media-body text-left">
                    @if($post->is_business())
                    <h5 class="title m-0"><a href="{{ url('post/'.$post->id) }}" class="text-primary">{{ $post->post_title }}</a> </h5>
                    <div class="location font-weight-bold">{!! ($post->location)? $post->location->name: null !!}</div>
                    <div class="location">{!! $post->summary() !!}</div>
                    @else
                    <h5 class="title m-0"><a href="{{ url('post/'.$post->id) }}" class="text-secondary">{{ $post->post_title }}</a> </h5>
                    <div class="condition text-primary font-weight-bold">{!! ($post->condition)? $post->condition->label: null !!}</div>
                    <div class="location">{!! ($post->location)? $post->location->name: null !!}</div>
                    <div class="created-at">{{ Helper::time_ago($post->created_at) }}</div>
                    <div class="price text-primary font-weight-bold"> <span class="currence">Tsh</span> {{ number_format($post->price) }}/=</div>
                    @endif    
                </div>
            </div>
            
            <div class="row mx-0 mt-3">
                <div class="mr-5" style="min-width:300px;">
                    <div class="btn-group btn-group-sm">
                        @if($post->call_link())
                        <a class="btn btn-circle btn-primary p-1" href="{{ $post->call_link() }}"><i class="icon-Call"></i></a>
                        @endif
                        @if($post->whatsapp_link())
                        <a class="btn btn-circle btn-primary p-1 mx-2" href="{{ $post->whatsapp_link() }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        @endif
                        <a class="btn btn-circle btn-primary p-1" href="javascript:;" data-toggle="collapse" data-target="#contact_seller_{{ $post->id }}"><i class="icon-Email-Message"></i></a>
                    </div>
                </div>
                <div class="col text-left pl-0">
                    <div href="javascript:;" class="btn py-0">
                        <div class="icon-Like"></div>
                    </div>
                </div>
            </div>

            <div class="collapse" id="contact_seller_{{ $post->id }}">
                <hr class="p-0">
                <h3>
                    @if($post->is_business())
                    Contact
                    @else
                    Contact Seller
                    @endif
                    <span class="fa fa-times-circle text-danger close" data-toggle="collapse" data-target="#contact_seller_{{ $post->id }}"></span>
                </h3>
                <form method="POST" action="{{ url('contact-seller') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="redirect" value="{{ url()->full() }}">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" class="sr-only">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Your Name">
                                <small class="form-text text-muted"></small>
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="sr-only">Email address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Your Email">
                                <small class="form-text text-muted"></small>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone" class="sr-only">Phone number</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter Your phone">
                                <small class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col pl-0">
                            <div class="form-group">
                                <label for="message" class="sr-only">Message</label>
                                <textarea name="message" class="form-control " rows="5" placeholder="Your Message"></textarea>
                                <small class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">Subscribe</button>
                        </div>
                        <div class="col text-right">
                            <a class="btn btn-link" href="#">Read our safety tips</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    @endforeach

    @if($post_list->count() == 0) 
    <div class="text-center p-5">
        No data found
    </div>
    @endif
</div>



@endsection
