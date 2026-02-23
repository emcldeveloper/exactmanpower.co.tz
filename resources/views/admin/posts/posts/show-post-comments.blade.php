
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
                        <div class="col-12 col-lg-2">
                            <a href="{{ url('admin/posts/post-comments/show/'.$row->post_comment_id) }}" class="media align-items-center">
                                <div class="madia-body">
                                    <div>{{ $row->user->username }}</div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <span class="d-block">{{ Illuminate\Support\Str::limit($row->user->email, 25) }}</span>
                                </div>
                                <div class="col">
                                    <span class="d-block">{{ $row->created_at }}</span>
                                </div>
                                <div class="col">
                                    <span class="d-block">{!! Illuminate\Support\Str::limit($row->comment_content, 25) !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col text-right" style="max-width:150px;">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/posts/post-comments/show/'.$row->post_comment_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/posts/post-comments/edit/'. $row->post_comment_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2 "> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/posts/post-comments/delete/'. $row->post_comment_id) }}?redirect={{ url()->full() }}" class="btn btn-outline-danger btn-circle px-1 mr-2" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                        <a data-toggle="collapse" href="#collapse-more-{{ $row->post_comment_id }}" class="btn btn-link text-dark mr-1" title="More"> <i class="fas fa-ellipsis-v fa-sm"></i> </a>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapse-more-{{ $row->post_comment_id }}">
                <div class="card bg-default p-3 my-3">
                    <div class="text-muted h6 m-0">Details</div>
                    <hr class="my-3"/>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Post</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->post)
                                    {{ $row->post->post_title }}
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Comment Author</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->comment_author)? $row->comment_author: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Comment Date</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->comment_date)? $row->comment_date: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Comment Content</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->comment_content)? $row->comment_content: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Comment Type</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->comment_type)? $row->comment_type: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Parent Post Comment</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->post_comment)
                                    {{ $row->post_comment->undefined }}
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
                        <td>Comment Author</td>
                        <td>Comment Date</td>
                        <td>Comment Content</td>
                        <td>Comment Type</td>
                        <td>Parent Post Comment</td>
                        <td>Updated Time</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($sub_page_list as $index => $row)
                    <tr>
                        <td scope="row">{{ ($sub_page_list->firstItem() + $index) }}</td>
                        <td>
                            <span class="d-block">{{ $row->comment_author }}</span>
                        </td>
                        <td>
                            <span class="d-block">{{ $row->comment_date }}</span>
                        </td>
                        <td>
                            <span class="d-block">{{ $row->comment_content }}</span>
                        </td>
                        <td>
                            <span class="d-block">{{ $row->comment_type }}</span>
                        </td>
                        <td>
                            @if($row->undefined)
                            <a class="d-block" href="{{ url('admin/undefined/show/'. $row->undefined->undefined) }}">{{ $row->undefined->undefined }}</a>
                            @endif
                        </td>
                        <td>
                            <span class="d-block">{{ $row->updated_at }}</span>
                        </td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ url('admin/posts/post-comments/show/'. $row->post_id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                <a href="{{ url('admin/posts/post-comments/edit/'. $row->post_id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                                <a href="{{ url('admin/posts/post-comments/delete/'. $row->post_id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->post_id }}"?'> <i class="fas fa-trash"></i> </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @if($sub_page_list->count() > 0)
                <tfoot class="table-active">
                    <tr>
                        <td>#</td>
                        <td>Comment Author</td>
                        <td>Comment Date</td>
                        <td>Comment Content</td>
                        <td>Comment Type</td>
                        <td>Parent Post Comment</td>
                        <td>Updated Time</td>
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