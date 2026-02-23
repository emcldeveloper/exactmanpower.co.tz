
<div class="clearfix">
    <div class="px-3 pb-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="row align-items-center justify-content-between m-0">
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {!! pagination_header_limit($user_logs_list) !!}
            </div>
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {!! pagination_header_search($user_logs_list) !!}
            </div>
        </div>
    </div>
    
    <div class="px-3">
        @if(true)
        @foreach ($user_logs_list as $index => $row)
        <div class="card zoom hover-container box-shadow rounded-0 py-2 px-4 mb-2">
            <div class="row align-items-center">
                <div class="col pr-0" style="max-width:50px;">{{ ($user_logs_list->firstItem() + $index) }}</div>
                
                <div class="col pr-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-4">
                            <a href="{{ url('admin/manage-users/user-logs/show/'.$row->user_log_id) }}" class="media align-items-center">
                                <div class="madia-body">
                                    <div>{{ $row->id }}</div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    @if($row->user)
                                    <a class="d-block" href="{{ url('admin/manage-users/users/show/'. $row->user->user_id) }}">
                                        {!! $row->user->get_profile_card() !!}
                                    </a>
                                    @endif
                                </div>
                                <div class="col">
                                    @if($row->log)
                                    <a class="d-block" href="{{ url('admin/manage-users/logs/show/'. $row->log->log_id) }}">
                                        {{ $row->log->name }}
                                    </a>
                                    @endif
                                </div>
                                <div class="col">
                                    <span class="d-block">{{ $row->datail }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col text-right" style="max-width:150px;">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/manage-users/user-logs/show/'.$row->user_log_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/manage-users/user-logs/edit/'. $row->user_log_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2 "> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/manage-users/user-logs/delete/'. $row->user_log_id) }}?redirect={{ url()->full() }}" class="btn btn-outline-danger btn-circle px-1 mr-2" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                        <a data-toggle="collapse" href="#collapse-more-{{ $row->user_log_id }}" class="btn btn-link text-dark mr-1" title="More"> <i class="fas fa-ellipsis-v fa-sm"></i> </a>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapse-more-{{ $row->user_log_id }}">
                <div class="card bg-default p-3 my-3">
                    <div class="text-muted h6 m-0">Details</div>
                    <hr class="my-3"/>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Account</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->account_id)? $row->account_id: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">User</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->user)
                                    {{ $row->user->first_name }}
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Log</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->log)
                                    {{ $row->log->name }}
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Datail</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->datail)? $row->datail: '-' }}
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
                        <td>Account</td>
                        <td>User</td>
                        <td>Log</td>
                        <td>Datail</td>
                        <td>Timestamp</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($user_logs_list as $index => $row)
                    <tr>
                        <td scope="row">{{ ($user_logs_list->firstItem() + $index) }}</td>
                        <td>
                            <span class="d-block"><?= $row->account_id;?></span>
                        </td>
                        <td>
                            @if($row->user)
                            <a class="d-block" href="{{ url('admin/manage-users/users/show/'. $row->user->user_id) }}">
                                {!! $row->user->get_profile_card() !!}
                            </a>
                            @endif
                        </td>
                        <td>
                            @if($row->log)
                            <a class="d-block" href="{{ url('admin/manage-users/logs/show/'. $row->log->log_id) }}">
                                <?= $row->log->name;?>
                            </a>
                            @endif
                        </td>
                        <td>
                            <span class="d-block"><?= $row->datail;?></span>
                        </td>
                        <td>
                            <span class="d-block"><?= $row->timestamp;?></span>
                        </td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ url('admin/manage-users/user-logs/show/'. $row->user_log_id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                <a href="{{ url('admin/manage-users/user-logs/edit/'. $row->user_log_id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                                <a href="{{ url('admin/manage-users/user-logs/delete/'. $row->user_log_id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->id }}"?'> <i class="fas fa-trash"></i> </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @if($user_logs_list->count() > 0)
                <tfoot class="table-active">
                    <tr>
                        <td>#</td>
                        <td>Account</td>
                        <td>User</td>
                        <td>Log</td>
                        <td>Datail</td>
                        <td>Timestamp</td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
        @endif

        {!! pagination_footer($user_logs_list) !!}
    </div>
</div>