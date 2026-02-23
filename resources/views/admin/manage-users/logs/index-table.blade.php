
<div class="clearfix">
    <div class="px-3 pb-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="row align-items-center justify-content-between m-0">
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {!! pagination_header_limit($logs_list) !!}
            </div>
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {!! pagination_header_search($logs_list) !!}
            </div>
        </div>
    </div>
    
    <div class="px-3">
        @if(true)
        @foreach ($logs_list as $index => $row)
        <div class="card zoom hover-container box-shadow rounded-0 py-2 px-4 mb-2">
            <div class="row align-items-center">
                <div class="col pr-0" style="max-width:50px;">{{ ($logs_list->firstItem() + $index) }}</div>
                
                <div class="col pr-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-4">
                            <a href="{{ url('admin/manage-users/logs/show/'.$row->log_id) }}" class="media align-items-center">
                                <div class="madia-body">
                                    <div>{{ $row->name }}</div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <span class="d-block">{{ $row->url }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col text-right" style="max-width:150px;">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/manage-users/logs/show/'.$row->log_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/manage-users/logs/edit/'. $row->log_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2 "> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/manage-users/logs/delete/'. $row->log_id) }}?redirect={{ url()->full() }}" class="btn btn-outline-danger btn-circle px-1 mr-2" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                        <a data-toggle="collapse" href="#collapse-more-{{ $row->log_id }}" class="btn btn-link text-dark mr-1" title="More"> <i class="fas fa-ellipsis-v fa-sm"></i> </a>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapse-more-{{ $row->log_id }}">
                <div class="card bg-default p-3 my-3">
                    <div class="text-muted h6 m-0">Details</div>
                    <hr class="my-3"/>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Name</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->name)? $row->name: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Url</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->url)? $row->url: '-' }}
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
                        <td>Name</td>
                        <td>Url</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($logs_list as $index => $row)
                    <tr>
                        <td scope="row">{{ ($logs_list->firstItem() + $index) }}</td>
                        <td>
                            <a class="d-block" href="{{ url('admin/manage-users/logs/show/'.$row->log_id) }}"><?= $row->name;?></a>
                        </td>
                        <td>
                            <span class="d-block"><?= $row->url;?></span>
                        </td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ url('admin/manage-users/logs/show/'. $row->log_id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                <a href="{{ url('admin/manage-users/logs/edit/'. $row->log_id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                                <a href="{{ url('admin/manage-users/logs/delete/'. $row->log_id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @if($logs_list->count() > 0)
                <tfoot class="table-active">
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Url</td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
        @endif

        {!! pagination_footer($logs_list) !!}
    </div>
</div>