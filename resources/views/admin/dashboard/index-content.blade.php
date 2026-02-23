

<div class="card-body">
    
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3" >
            <div class="card border-primary mb-3 text-center cursor box-shadow">
                <div class="card-block py-2">
                    <div class="row align-items-center">
                        <div class="col"><i class="fa fa-users text-primary fa-3x p-2" aria-hidden="true"></i></div>
                        <div class="col pl-0">
                            <div class="h4 pr-2">{{ number_format($total_users) }}</div>
                            <div class="h6">Users</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary text-white py-2">
                    Total users
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-success mb-3 text-center cursor box-shadow">
                <div class="card-block py-2">
                    <div class="row align-items-center">
                        <div class="col"><i class="fa fa-user-plus fa-3x text-success p-2" aria-hidden="true"></i></div>
                        <div class="col pl-0">
                            <div class="h4 pr-2">{{ number_format($total_active_users) }}</div>
                            <div class="h6">Active users</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-success text-white py-2">
                    Active users for last 30 days
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-danger mb-3 text-center cursor box-shadow">
                <div class="card-block py-2">
                    <div class="row align-items-center">
                        <div class="col"><i class="fa fa-user-secret fa-3x text-danger p-2" aria-hidden="true"></i></div>
                        <div class="col pl-0">
                            <div class="h4 pr-2">{{ number_format($total_inactive_users) }}</div>
                            <div class="h6">Inactive users</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-danger text-white py-2">
                    Inactive users for last 30 days
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-dark mb-3 text-center box-shadow">
                <div class="card-block py-2">
                    <div class="row align-items-center">
                        <div class="col"><i class="fa fa-key fa-3x text-dark p-2" aria-hidden="true"></i></div>
                        <div class="col pl-0">
                            <div class="h4 pr-2">{{ number_format($total_admin_users) }}</div>
                            <div class="h6">Admins</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-dark text-white py-2">
                    Admin users
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card h-100  box-shadow">
                <div class="card-table">
                    <div class="clearfix">
                        <div class="p-3">
                            <!----- Include view from components/alert----->
                            @component('components.alert')@endcomponent
                            <!----- End include view from components/alert----->

                            <div class="row align-items-center justify-content-between m-0">
                                <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                                    {!! pagination_header_limit($summary_list) !!}
                                </div>
                                <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                                    {!! pagination_header_search($summary_list) !!}
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Updated At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($summary_list as $index => $row)
                                <tr>
                                    <td scope="row">{{ ($summary_list->firstItem() + $index) }}</td>
                                    <td>
                                        <a class="d-block" href="{{ url('manage-users/users/show/'. $row->id) }}"><?= $row->name;?></a>
                                    </td>
                                    <td>
                                        <span class="d-block"><?= $row->username;?></span>
                                    </td>
                                    <td>
                                        <span class="d-block"><?= $row->email;?></span>
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
                                        <div class="badge badge-success">Active</div>
                                        @elseif($row->status == 2)
                                        <div class="badge badge-danger">Banned</div>
                                        @else
                                        <div class="badge badge-dark">Inactive</div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="d-block"><?= $row->updated_at;?></span>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="{{ url('manage-users/users/show/'. $row->id) }}" class="btn px-1"> <i class="fas fa-file"></i> </a>
                                            <a href="{{ url('manage-users/users/edit/'. $row->id) }}" class="btn px-1"> <i class="fas fa-pencil-alt"></i> </a>
                                            <a href="{{ url('manage-users/users/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {!! pagination_footer($summary_list) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
