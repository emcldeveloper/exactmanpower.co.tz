
<div class="clearfix">
    <div class="px-3 pb-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        @include('status')
        <!----- End include view from components/alert----->

        <div class="row align-items-center justify-content-between m-0">
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {{-- !! pagination_header_limit($post_types_list) !! --}}
            </div>
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {{-- !! pagination_header_search($post_types_list) !! --}}
            </div>
        </div>
    </div>
    
    <div class="px-3">

        @foreach (\App\Models\Post::where('post_type_id','slider')->latest()->get() as $index => $row)
        
        <div class="card zoom hover-container box-shadow rounded-0 py-2 px-4 mb-2">
            <div class="row align-items-center">
                <div class="col pr-0" style="max-width:50px;">{{$loop->iteration}}.</div>
                
                <div class="col pr-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-4">
                            <a href="{{ url('admin/posts/home/slider/show/'.$row->id) }}" class="media align-items-center">
                                <div class="madia-body">
                                    <div>{{ $row->post_title }}</div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col text-right" style="max-width:150px;">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/posts/home/slider/show/'.$row->id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2"> <i class="fas fa-file"></i> </a>

                        <a href="{{ url('admin/posts/home/slider/edit/'.$row->id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2 "> <i class="fas fa-pencil-alt"></i> </a>

                        <a href="{{ url('/admin/slider-delete/'.$row->id) }}?redirect={{ url()->full() }}" class="btn btn-outline-danger btn-circle px-1 mr-2" data-confirmation='I you sure, you want to delete "{{ $row->post_title }}"?'> <i class="fas fa-trash"></i> </a>

                        <a data-toggle="collapse" href="#collapse-more-{{ $row->id }}" class="btn btn-link text-dark mr-1" title="More"> <i class="fas fa-ellipsis-v fa-sm"></i> </a>

                    </div>
                </div>
            </div>
            <div class="collapse" id="collapse-more-{{ $row->id }}">
                <div class="card bg-default p-3 my-3">
                    <div class="text-muted h6 m-0">Details</div>
                    <hr class="my-3"/>
                    <div class="row">
                        <div class="col-6 col-md-6 col-lg-12">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-3 text-truncate">Name</dd>
                                <dd class="col-sm-5 text-truncate">
                                    {{ ($row->post_title), $row->post_content }}
                                </dd>
                                <div class="col-sm-4" >
                                    <a href="{{ $row->image }}">view-image</a>
                                
                            </div>
                            </dl>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>