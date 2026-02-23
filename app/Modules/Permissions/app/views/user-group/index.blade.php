@extends('permissions::layout')


@section('permissions-content')

<div class="card border-0 ">
    <div class="">
        
        <div class="clearfix p-3">
            <div class="py-3">
                <!----- Include view from components/alert----->
                @component('components.alert')@endcomponent
                <!----- End include view from components/alert----->

                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        {!! pagination_header_limit($users_list) !!}
                    </div>

                    <div class="form-inline">
                        @if(!Request::is('admin/manage-users/customer/*'))
                        <div class="dropdown mr-2">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(request('status') == 'waiting-approvel')
                                    Waiting for approvel
                                @elseif(request('status') == 'approved')
                                    Approved
                                @elseif(request('status') == 'rejected')
                                    Rejected
                                @else
                                    Filter
                                @endif
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item px-1" href="{{ Helper::query_link('status', null) }}">All</a>
                                <a class="dropdown-item px-1" href="{{ Helper::query_link('status', 'waiting-approvel') }}">Waiting approvel</a>
                                <a class="dropdown-item px-1" href="{{ Helper::query_link('status', 'approved') }}">Approved</a>
                                <a class="dropdown-item px-1" href="{{ Helper::query_link('status', 'rejected') }}">Rejected</a>
                            </div>
                        </div>
                        @endif

                        <form>
                            <input type="hidden" name="page" value="1">
                            <input type="hidden" name="limit" value="10">

                            <div class="input-group input-group-sm input-group-search">
                                <input class="form-control" type="search" value="" name="__search" placeholder="Search...">
                                <span class="input-group-append">
                                    <button type="submit" class="btn">
                                        <i class="fa fa-search text-light"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table table-borderless table-sm mb-0">
                <tbody>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                @foreach ($users_list as $index => $row)
                    <tr>
                        <td scope="row">{{ ($users_list->firstItem() + $index) }}</td>
                        <td>
                            <a class="d-block" href="{{ url('admin/manage-users/'.request('type').'/show/'. $row->id) }}?status={{ request('status') }}">
                                {!! $row->get_profile_card() !!}
                            </a>
                        </td>
                        <td>
                            <span class="d-block"><?= $row->phone;?></span>
                        </td>
                        <td class="text-uppercase">
                            @if($row->groups)
                                {{ implode(', ', $row->groups->pluck('name')->toArray()) }}
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ url('permissions/user-assign/assign/'. $row->user_id) }}" title="Assign permission" class="btn btn-primary py-0"> <i class="fas fa-lock"></i> Permissions</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! pagination_footer($users_list) !!}
        </div>
        
    </div>  
</div>


@endsection
