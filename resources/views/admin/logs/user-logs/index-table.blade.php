
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($user_logs_list) !!}
            </div>
            {!! pagination_header_search($user_logs_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Account</th>
                <th>User</th>
                <th>Log</th>
                <th>Datail</th>
                <th>Timestamp</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($user_logs_list as $index => $row)
            <tr>
                <td scope="row">{{ ($user_logs_list->firstItem() + $index) }}</td>
                <td>
                    @if($row->account)
                    <a class="d-block" href="{{ url('admin/manage-users/accounts/show/'. $row->account->id) }}"><?= $row->account->name;?></a>
                    @endif
                </td>
                <td>
                    @if($row->user)
                    <a class="d-block" href="{{ url('admin/manage-users/users/show/'. $row->user->id) }}"><?= $row->user->first_name;?></a>
                    @endif
                </td>
                <td>
                    @if($row->log)
                    <a class="d-block" href="{{ url('admin/logs/logs/show/'. $row->log->id) }}"><?= $row->log->name;?></a>
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
                        <a href="{{ url('admin/logs/user-logs/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/logs/user-logs/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/logs/user-logs/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->id }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($user_logs_list) !!}
</div>