
<div class="clearfix">
    <div class="p-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="d-flex align-items-center justify-content-between">
            <div>
                {!! pagination_header_limit($account_users_list) !!}
            </div>
            {!! pagination_header_search($account_users_list) !!}
        </div>
    </div>

    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Account</th>
                <th>User</th>
                <th>Role</th>
                <th>Status</th>
                <th>Updated Time</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($account_users_list as $index => $row)
            <tr>
                <td scope="row">{{ ($account_users_list->firstItem() + $index) }}</td>
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
                <td class="text-uppercase">
                    @if($row->role == 1)
                    <div>Super Admin</div>
                    @elseif($row->role == 2)
                    <div>Admin</div>
                    @else
                    <div>Member</div>
                    @endif
                </td>
                <td class="">
                    @if($row->status == 1)
                    <div class="badge badge-custom badge-success">Active</div>
                    @elseif($row->status == 2)
                    <div class="badge badge-custom badge-danger">Banned</div>
                    @else
                    <div class="badge badge-custom badge-dark">Inactive</div>
                    @endif
                </td>
                <td>
                    <span class="d-block"><?= $row->updated_at;?></span>
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/manage-users/account-users/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/manage-users/account-users/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/manage-users/account-users/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->id }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! pagination_footer($account_users_list) !!}
</div>