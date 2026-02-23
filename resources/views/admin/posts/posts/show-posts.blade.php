
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="row align-items-center justify-content-between m-0">
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {!! pagination_header_limit($sub_page_list) !!}
            </div>
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {!! pagination_header_search($sub_page_list) !!}
            </div>
        </div>
    </div>

    <div class="p-3">
        @if(true)
        @foreach ($sub_page_list as $index => $row)
        <div class="card zoom hover-container box-shadow rounded-0 py-2 px-4 mb-2">
            <div class="row align-items-center">
                <div class="col pr-0" style="max-width:50px;">{{ ($sub_page_list->firstItem() + $index) }}</div>
                
                <div class="col pr-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-4">
                            <a href="{{ url('admin/posts/posts/show/'.$row->post_id) }}" class="media align-items-center">
                                <div class="madia-body">
                                    <div>{{ $row->post_title }}</div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <span class="d-block">{{ $row->post_slug }}</span>
                                </div>
                                <div class="col">
                                    <span class="d-block">{{ $row->post_summary }}</span>
                                </div>
                                <div class="col">
                                    <span class="d-block">{{ $row->post_content }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col text-right" style="max-width:150px;">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/posts/posts/show/'.$row->post_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/posts/posts/edit/'. $row->post_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2 "> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/posts/posts/delete/'. $row->post_id) }}?redirect={{ url()->full() }}" class="btn btn-outline-danger btn-circle px-1 mr-2" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                        <a data-toggle="collapse" href="#collapse-more-{{ $row->post_id }}" class="btn btn-link text-dark mr-1" title="More"> <i class="fas fa-ellipsis-v fa-sm"></i> </a>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapse-more-{{ $row->post_id }}">
                <div class="card bg-default p-3 my-3">
                    <div class="text-muted h6 m-0">Details</div>
                    <hr class="my-3"/>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Post Title</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->post_title)? $row->post_title: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Post Slug</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->post_slug)? $row->post_slug: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Post Summary</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->post_summary)? $row->post_summary: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Post Content</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->post_content)? $row->post_content: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Post Featured Image</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->post_featured_image && trim($row->post_featured_image) != "")
                                    <a class="text-primary font-weight-bold" hre="javascript:;">Download file</a>
                                    @else
                                    <span class="text-danger">Not uploaded</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Post Author</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->user)
                                    {{ $row->user->undefined }}
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Post Date</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->post_date)? $row->post_date: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Post Status</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->post_status)? $row->post_status: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Post Modified</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->post_modified)? $row->post_modified: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Post Type</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->post_type)
                                    {{ $row->post_type->name }}
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Parent Post</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->post)
                                    {{ $row->post->undefined }}
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Location</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->location)
                                    {{ $row->location->name }}
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Created Time</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->created_at)? $row->created_at: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Updated Time</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->updated_at)? $row->updated_at: '-' }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="border bg-white">
            <table class="table table-hover table-sm mb-0">
                <thead class="table-primary">
                    <tr>
                        <td>#</td>
                        <td>Post Title</td>
                        <td>Post Slug</td>
                        <td>Post Summary</td>
                        <td>Post Content</td>
                        <td>Post Featured Image</td>
                        <td>Post Author</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($sub_page_list as $index => $row)
                    <tr>
                        <td scope="row">{{ ($sub_page_list->firstItem() + $index) }}</td>
                        <td>
                            <a class="d-block" href="{{ url('admin/posts/posts/show/'. $row->post_id) }}"><?= $row->post_title;?></a>
                        </td>
                        <td>
                            <span class="d-block">{{ $row->post_slug }}</span>
                        </td>
                        <td>
                            <span class="d-block">{{ $row->post_summary }}</span>
                        </td>
                        <td>
                            <span class="d-block">{{ $row->post_content }}</span>
                        </td>
                        <td>
                            <span class="d-block">{{ $row->post_featured_image }}</span>
                        </td>
                        <td>
                            @if($row->undefined)
                            <a class="d-block" href="{{ url('admin/undefined/show/'. $row->undefined->undefined) }}">{{ $row->undefined->undefined }}</a>
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ url('admin/posts/posts/show/'. $row->post_id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                <a href="{{ url('admin/posts/posts/edit/'. $row->post_id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                                <a href="{{ url('admin/posts/posts/delete/'. $row->post_id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->post_title }}"?'> <i class="fas fa-trash"></i> </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @if($sub_page_list->count() > 0)
                <tfoot class="table-active">
                    <tr>
                        <td>#</td>
                        <td>Post Title</td>
                        <td>Post Slug</td>
                        <td>Post Summary</td>
                        <td>Post Content</td>
                        <td>Post Featured Image</td>
                        <td>Post Author</td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
        @endif

        {!! pagination_footer($sub_page_list) !!}
    </div>
</div>