<div class="card p-4">
    <div class="d-flex justify-content-between">
        <div class="small">
            <a href="{{ url($back_route) }}{{ session('status')? '?status='.session('status'): null }}" class="btn btn-sm btn-outline-dark px-3 mr-4">
                <i class="fa fa-arrow-left mr-2"></i> Back
            </a>
            
        </div>
        <ol class="breadcrumb bg-transparent small p-0 m-0">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            {!! $categories_tree !!}
        </ol>
    </div>

    <div class="clearfix mt-4">
        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
            @if($post->post_medias && $post->post_medias->count())
                @foreach($post->post_medias as $media)
                <li data-thumb="{{ $media->url() }}" data-src="{{ $media->url() }}">
                    <img class="w-100" src="{{ $media->url() }}" />
                </li>
                @endforeach
            
            @else 
                <li data-thumb="{{ $post->get_featured_image() }}" data-src="{{ $post->get_featured_image() }}">
                    <img class="w-100" src="{{ $post->get_featured_image() }}" />
                </li>
            @endif
        </ul>
    </div> 
</div>

<div class="w-100 p-4">
    <div class="d-flex justify-content-between">
        <div class="align-self-center">
            <span data-toggle="collapse" data-target="#map_location_post_id_{{ $post->id }}"><i class="fa fa-map-marker-alt fa-3x text-primary "></i></span>
        </div>
        <div class="font-weight-bold">
            <span class="d-block text-">{{ ucwords(Helper::time_ago($post->created_at)) }}</span>
            <span class="d-block">Ads ID: {{ $post->post_unique }}</span>
        </div>
    </div>
    
</div>
<div class="clearfix collapse" id="map_location_post_id_{{ $post->id }}">
    <div class="card mb-4">
        <iframe frameborder="0" height="400" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.961298247319!2d39.23898821518732!3d-6.774565195103095!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4e7db8c80bf5%3A0x2de5a8ecc5ebb87b!2s{{ config('app.name') }}!5e0!3m2!1sen!2stz!4v1495820491133" style="border:0" width="100%"></iframe>
    </div>
</div>

<div class="card p-4">
    <h3 class="font-weight-bold text-primary">Tsh {{ number_format($post->price) }}/=</h3>
    <div class="row">
        <span class="col-12 col-lg-7">{{ $post->post_title }}</span>
        <span class="col-12 col-lg-5">{{ ($post->location)? $post->location->name: null }}</span>
    </div>
    <hr>
    <h5>Details</h5>
    <div class="row secondary-font">
        <div class="col-12 col-lg-11">
            <div class="row">
                <div class="col-4">Price negotiable</div>
                <div class="col">{{ ($post->is_price_negotiable)? 'Yes': 'No' }}</div>
            </div><div class="row">
                <div class="col-4">Delivery offered</div>
                <div class="col">{{ ($post->is_delivery_offered)? 'Yes': 'No' }}</div>
            </div>
            <div class="row">
                <div class="col-4">Condition</div>
                <div class="col">{{ ($post->condition)? $post->condition->label: 'not specified' }}</div>
            </div>
            @foreach($post->category->category_elements as $row)

                @foreach($post->post_elements as $elem)
                    @if($elem->meta == $row->category_element_id)
                    <div class="row">
                        <div class="col-4">{{ $row->title }}</div>
                        <div class="col">{{ $elem->value }}</div>
                    </div>
                    @endif
                @endforeach
            @endforeach
        </div>
        
        
    </div>
    <hr>
    <h5>Description</h5>
    <div class="secondary-font">{!! $post->post_content !!}</div>
</div>