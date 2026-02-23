
<div class="clearfix">
    <div class="px-3 pb-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="row align-items-center justify-content-between m-0">
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {!! pagination_header_limit($posts_list) !!}
            </div>
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {!! pagination_header_search($posts_list) !!}
            </div>
        </div>
    </div>

    <div class="px-3">
        <div class="card-columns">
        @foreach ($posts_list as $index => $row)
            <div class="card">
                <img src="{{ $row->image_thumbnail }}" class="card-img-top" alt="...">
                <div class="card-footer text-muted">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>{{ $row->post_title }}</div>
                        <div>
                            <div class="btn-group btn-group-sm">
                                @if($row->is_active)
                                <a href="{{ url('admin/posts/post/stauts/disable/'. $row->post_id) }}" class="btn text-success px-1 py-0 mr-4"> <i class="fas fa-check-circle"></i> </a>
                                @else
                                <a href="{{ url('admin/posts/post/stauts/enable/'. $row->post_id) }}" class="btn text-danger px-1 py-0 mr-4"> <i class="fas fa-ban"></i> </a>
                                @endif
                                <a href="{{ url('admin/posts/'.request('post_type_id').'/show/'. $row->post_id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                <a href="{{ url('admin/posts/'.request('post_type_id').'/edit/'. $row->post_id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                                <a href="{{ url('admin/posts/'.request('post_type_id').'/delete/'. $row->post_id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->post_title }}"?'> <i class="fas fa-trash"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>


    {!! pagination_footer($posts_list) !!}
</div>