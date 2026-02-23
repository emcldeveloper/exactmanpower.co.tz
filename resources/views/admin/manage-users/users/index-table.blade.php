
<div class="clearfix">
    <div class="px-3 pb-3">
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="row align-items-center justify-content-between m-0">
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {!! pagination_header_limit($users_list) !!}
            </div>
            <div class="col-12 col-md-6 p-0 mb-3 mb-md-0">
                {!! pagination_header_search($users_list) !!}
            </div>
        </div>
    </div>
    
    <div class="px-3">
        @if(true)
        @foreach ($users_list as $index => $row)
        <div class="card zoom hover-container box-shadow rounded-0 py-2 px-4 mb-2">
            <div class="row align-items-center">
                <div class="col pr-0" style="max-width:50px;">{{ ($users_list->firstItem() + $index) }}</div>
                
                <div class="col pr-0">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-4">
                            <a href="{{ url('admin/manage-users/users/show/'.$row->user_id) }}" class="d-block">
                                {!! $row->get_profile_card() !!}
                            </a>
                        </div>
                        
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <span class="d-block">{{ $row->second_name }}</span>
                                </div>
                                <div class="col">
                                    <span class="d-block">{{ $row->last_name }}</span>
                                </div>
                                <div class="col">
                                    <span class="d-block">{{ $row->username }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col text-right" style="max-width:150px;">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('admin/manage-users/users/show/'.$row->user_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2"> <i class="fas fa-file"></i> </a>
                        <a href="{{ url('admin/manage-users/users/edit/'. $row->user_id) }}" class="btn btn-outline-dark btn-circle px-1 mr-2 "> <i class="fas fa-pencil-alt"></i> </a>
                        <a href="{{ url('admin/manage-users/users/delete/'. $row->user_id) }}?redirect={{ url()->full() }}" class="btn btn-outline-danger btn-circle px-1 mr-2" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                        <a data-toggle="collapse" href="#collapse-more-{{ $row->user_id }}" class="btn btn-link text-dark mr-1" title="More"> <i class="fas fa-ellipsis-v fa-sm"></i> </a>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapse-more-{{ $row->user_id }}">
                <div class="card bg-default p-3 my-3">
                    <div class="text-muted h6 m-0">Details</div>
                    <hr class="my-3"/>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">First Name</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->first_name)? $row->first_name: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Second Name</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->second_name)? $row->second_name: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Last Name</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->last_name)? $row->last_name: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Username</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->username)? $row->username: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Social Name</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->social_name)? $row->social_name: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Social</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->social_id)? $row->social_id: '-' }}
                                </dd>
                            </dl>
                        </div>
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
                                <dd class="col-sm-5 text-truncate">Phone</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->phone)? $row->phone: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Password</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->password)? $row->password: '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Role</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->role == 1)
                                        Super admin
                                    @elseif($row->role == 2)
                                        Admin
                                    @elseif($row->role == 3)
                                        Member
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Profile Url</dd>
                                <dd class="col-sm-7 text-truncate">
                                    @if($row->profile_url && trim($row->profile_url) != "")
                                    <a class="text-primary font-weight-bold" hre="javascript:;">Download file</a>
                                    @else
                                    <span class="text-danger">Not uploaded</span>
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
                        <div class="col-12 col-md-6 col-lg-4">
                            <dl class="row h-100 mb-0">
                                <dd class="col-sm-5 text-truncate">Email Verified Time</dd>
                                <dd class="col-sm-7 text-truncate">
                                    {{ ($row->email_verified_at)? $row->email_verified_at: '-' }}
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
                        <td>First Name</td>
                        <td>Username</td>
                        <td>Social Name</td>
                        <td>Social</td>
                        <td>Phone</td>
                        <td>Role</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users_list as $index => $row)
                    <tr>
                        <td scope="row">{{ ($users_list->firstItem() + $index) }}</td>
                        <td>
                            <a href="{{ url('admin/manage-users/users/show/'.$row->user_id) }}" class="d-block">
                                {!! $row->get_profile_card() !!}
                            </a>
                        </td>
                        <td>
                            <span class="d-block"><?= $row->username;?></span>
                        </td>
                        <td>
                            <span class="d-block"><?= $row->social_name;?></span>
                        </td>
                        <td>
                            <span class="d-block"><?= $row->social_id;?></span>
                        </td>
                        <td>
                            <span class="d-block"><?= $row->phone;?></span>
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
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ url('admin/manage-users/users/show/'. $row->user_id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a>
                                <a href="{{ url('admin/manage-users/users/edit/'. $row->user_id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a>
                                <a href="{{ url('admin/manage-users/users/delete/'. $row->user_id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->first_name }}"?'> <i class="fas fa-trash"></i> </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @if($users_list->count() > 0)
                <tfoot class="table-active">
                    <tr>
                        <td>#</td>
                        <td>First Name</td>
                        <td>Username</td>
                        <td>Social Name</td>
                        <td>Social</td>
                        <td>Phone</td>
                        <td>Role</td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
        @endif

        {!! pagination_footer($users_list) !!}
    </div>
</div>