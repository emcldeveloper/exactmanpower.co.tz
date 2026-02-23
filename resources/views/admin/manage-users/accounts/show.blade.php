@extends('admin')

@section('title', 'Accounts')

@section('content')


<div class="main-container-middle">
    <div class="container-sidebar bg-white border-left border-right">
        <div class="main-container-middle">
            <div class="container-summary-sidebar border-bottom d-flex p-3">
                <div class="d-block">
                    <div class="h5 mb-3">
                    <!-- <a href="{{ url('admin/manage-users/accounts/list') }}" class="btn btn-outline-primary mr-3" title="Back to accounts list"><i class="fas fa-arrow-left"></i></a> -->
                    <span>Accounts</span>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-search">
                            <input class="form-control" type="search" placeholder="Search..." #search (change)="getSearch($event.target.value)"/>
                            <span class="input-group-append">
                                <button  class="btn">
                                    <i class="fa fa-search text-light"></i>
                                </button >
                            </span>
                        </div>
                    </div>

                    <div class="btn-block dropdown">
                        <button class="btn btn-primary btn-block" (click)="showFilter()"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </div>
            </div>
            <div class="container-detail text-dark">
                <div class="main-container-middle">
                    <div class="container-detail" scroll-container>
                        <div class="clearfix">
                            @foreach ($model_list as $index => $row)
                            <div class="border-bottom p-2">
                                <a href="{{ url('admin/manage-users/accounts/show/'.$row->id.( request('sub_page')? '/'.request('sub_page'): '' )) }}">{{ $row->name }}</a>
                                <div class="font-italic text-light small">
                                Description of 
                                {{ $row->name }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">
            <div class="h5 m-0">
                <span>Account info ( {{ $model_info->name }} )</span>
            </div>
            
            <div>
                <!-- <a href="{{ url('admin/manage-users/accounts/edit/'.$model_info->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt mr-1"></i> Edit</a> -->
                <a href="{{ url('admin/manage-users/accounts/create') }}" class="btn btn-dark"><i class="fas fa-plus-circle mr-1"></i> Add Account</a>
                <!-- <a href="{{ url('admin/manage-users/accounts/delete/'. $model_info->id) }}?redirect={{ url('admin/manage-users/accounts/list') }}" class="btn btn-danger" data-confirmation='I you sure, you want to delete "{{ $model_info->name }}"?'><i class="fas fa-trash mr-1"></i> Delete</a> -->
                <div class="d-inline-block dropdown">
                    <div class="btn-group dropdown" data-toggle="dropdown">
                        <div class="btn btn-primary " >
                            <i class="fas fa-plus-circle mr-1"></i> Add another
                        </div>
                        <div class="btn btn-primary">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right" id="dropdown-add-another">
                        <div class="dropdown-item" data-toggle="modal" data-target="#model_new_account_orders" >Add account order</div>
                        <div class="dropdown-item" data-toggle="modal" data-target="#model_new_notifications" >Add notification</div>
                        <div class="dropdown-item" data-toggle="modal" data-target="#model_new_user_logs" >Add user log</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-summary">
        <div class="px-3 py-2">
            <div class="d-flex justify-content-between" style="height:65px;">
                <div class="d-inline-block h5">notes</div>
                <div class="d-inline-block h5 pr-3">
                    <div class="border-left border-danger mb-3 pl-3" style="border-width: 5px !important;">
                        <span>12000000</span>
                        <span class="small font-italic text-light ml-2">Summary One</span>
                    </div>
                    <div class="border-left border-warning pl-3" style="border-width: 5px !important;">
                        <span>15220000</span>
                        <span class="small font-italic text-light ml-2">Summary Two</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-navbar bg-white border-bottom" style="overflow:visible;">
        <nav class="nav">
            
            <a class="nav-link h-100 {{ Request::is('admin/manage-users/accounts/show/'.$model_info->id)? 'active': null }}" href="{{ url('admin/manage-users/accounts/show/' . $model_info->id) }}">Information</a>
            <a class="nav-link {{ Request::is('admin/manage-users/accounts/show/*/account-orders')? 'active': null }}" href="{{ url('admin/manage-users/accounts/show/' . $model_info->id . '/account-orders') }}">Account Orders</a>
            <a class="nav-link {{ Request::is('admin/manage-users/accounts/show/*/notifications')? 'active': null }}" href="{{ url('admin/manage-users/accounts/show/' . $model_info->id . '/notifications') }}">Notifications</a>
            <a class="nav-link {{ Request::is('admin/manage-users/accounts/show/*/user-logs')? 'active': null }}" href="{{ url('admin/manage-users/accounts/show/' . $model_info->id . '/user-logs') }}">User Logs</a>
        </nav>
    </div>
    <div class="container-detail bg-white">
        <div class="clearfix">
            {!! \App\Handlers\Admin\ManageUser\Account\ShowFormHandler::handler(request(), new \App\Models\Account(), $model_info->id) !!}
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="model_new_account_orders" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background:rgba(0,0,0,.2);">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border:4px solid #1193d7;">
            <div class="modal-header bg-white text-primary py-2">
                <h5 class="modal-title">New account order</h5>
                <button type="button" class="close py-1 my-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="clearfix">
                {!! \App\Handlers\Admin\AccountOrder\CreateFormHandler::handler(request(), url()->full(), ['account_id'=>$model_info->id]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="model_new_notifications" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background:rgba(0,0,0,.2);">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border:4px solid #1193d7;">
            <div class="modal-header bg-white text-primary py-2">
                <h5 class="modal-title">New notification</h5>
                <button type="button" class="close py-1 my-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="clearfix">
                {!! \App\Handlers\Admin\Notification\CreateFormHandler::handler(request(), url()->full(), ['account_id'=>$model_info->id]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="model_new_user_logs" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background:rgba(0,0,0,.2);">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border:4px solid #1193d7;">
            <div class="modal-header bg-white text-primary py-2">
                <h5 class="modal-title">New user log</h5>
                <button type="button" class="close py-1 my-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="clearfix">
                {!! \App\Handlers\Admin\ManageUser\UserLog\CreateFormHandler::handler(request(), url()->full(), ['account_id'=>$model_info->id]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var active_modal = location.hash.substr(1);


if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {};

function formChildInput() {
    if(! (this instanceof formChildInput)){
        return new formChildInput();
    }
    
}

formChildInput.prototype.init = function(){
    var $this = this;
    var containers_list = jQuery('[data-children]');

    for (const container of containers_list) {
        jQuery(container).on('click', '.add-item', function(){
            var c = jQuery(this).parent('[data-children]');
            var k = jQuery(c).attr('data-children');
            var i = "insert_item_" + k;

            $this.insert_item(c, 0, {}, i);
        });

        var list_key = jQuery(container).attr('data-children');
        var insert_key = "insert_item_" + list_key;
        var list = $this[list_key];

        if(Array.isArray(list)){
            for (var i = 1; i < list.length; i++) {
                var elem = list[i];
                $this.insert_item(container, i, elem, insert_key);
            }
        }
    }
}

formChildInput.prototype.insert_item = function(container, i, data, insert_key){
    // console.log(container);
    var template = '';
    var container_list = jQuery(container).find('.item-list').get(0);
    if(i == 0 && container_list){
        i = container_list.childElementCount;
    }

    if(typeof form_children_input_template[insert_key] == 'function') {
        template = form_children_input_template[insert_key](i, data)
    }

    var item_obj = null;
    item_obj = document.createElement('TR'); 
    item_obj.innerHTML = template;

    console.log(item_obj)
    if(container_list) {
        container_list.appendChild(item_obj);

        jQuery(item_obj).on('click', '.btn-delete', function(){
            if(container_list && item_obj){
                container_list.removeChild(item_obj);
            }
        });
    } else {
        console.log(container_list)
    }    
}

formChildInput().init();
</script>


@endsection
