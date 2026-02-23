
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
                            <a href="{{ url('admin/subscribers/show/'.$row->subscriber_id) }}" class="media align-items-center">
                                <div class="madia-body">
                                    <div>{{ $row->id }}</div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <span class="d-block">{{ $row->email }}</span>
                                </div>
                                <div class="col">
                                    <span class="d-block">{{ $row->query }}</span>
                                </div>
                                <div class="col">
                                    @if($row->is_valid == 1)
                                    <i class="fa fa-check text-success" aria-hidden="true"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col text-right" style="max-width:150px;">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/subscribers/show/'.$row->subscriber_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/subscribers/edit/'. $row->subscriber_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2 "> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/subscribers/delete/'. $row->subscriber_id) }}?redirect={{ url()->full() }}" class="btn btn-outline-danger btn-circle px-1 mr-2" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                        <a data-toggle="collapse" href="#collapse-more-{{ $row->subscriber_id }}" class="btn btn-link text-dark mr-1" title="More"> <i class="fas fa-ellipsis-v fa-sm"></i> </a>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapse-more-{{ $row->subscriber_id }}">
                <div class="card bg-default p-3 my-3">
                    <div class="text-muted h6 m-0">Details</div>
                    <hr class="my-3"/>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Email</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->email)? $row->email: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Query</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->query)? $row->query: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Subscription Type</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->subscription_type)
                                    {{ $row->subscription_type->name }}
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Is Valid</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->is_valid) 
                                        <span class="text-success">YES</span>
                                    @else
                                        <span class="text-danger">No</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Status</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->status == 0)
                                        Active
                                    @elseif($row->status == 1)
                                        Inactive
                                    @elseif($row->status == 2)
                                        Banned
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Notes</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->notes)? $row->notes: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Timestamp</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->timestamp)? $row->timestamp: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Deactivated Time</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->deactivated_at)? $row->deactivated_at: '-' }}
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
                        <td>Email</td>
                        <td>Query</td>
                        <td>Is Valid</td>
                        <td>Status</td>
                        <td>Notes</td>
                        <td>Timestamp</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($sub_page_list as $index => $row)
                    <tr>
                        <td scope="row">{{ ($sub_page_list->firstItem() + $index) }}</td>
                        <td>
                            <span class="d-block">{{ $row->email }}</span>
                        </td>
                        <td>
                            <span class="d-block">{{ $row->query }}</span>
                        </td>
                        <td>
                            @if($row->is_valid == 1)
                            <i class="fa fa-check text-success" aria-hidden="true"></i>
                            @endif
                        </td>
                        <td class="">
                            @if($row->status == 1)
                            <div class="badge badge-success badge-custom">Active</div>
                            @elseif($row->status == 2)
                            <div class="badge badge-danger badge-custom">Banned</div>
                            @else
                            <div class="badge badge-dark badge-custom">Inactive</div>
                            @endif
                        </td>
                        <td>
                            <span class="d-block">{{ $row->notes }}</span>
                        </td>
                        <td>
                            <span class="d-block">{{ $row->timestamp }}</span>
                        </td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ url('admin/subscribers/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                <a href="{{ url('admin/subscribers/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                                <a href="{{ url('admin/subscribers/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->id }}"?'> <i class="fas fa-trash"></i> </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @if($sub_page_list->count() > 0)
                <tfoot class="table-active">
                    <tr>
                        <td>#</td>
                        <td>Email</td>
                        <td>Query</td>
                        <td>Is Valid</td>
                        <td>Status</td>
                        <td>Notes</td>
                        <td>Timestamp</td>
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