 
<style>
.item-list td,
.item-list th {
    padding-top:3px;
    padding-bottom:3px;
    padding-left:0px;
}

.item-list .form-control {
    background: none;
    border-color: transparent;
    border-bottom-color: gainsboro;
}
</style>
<form action="{{ url('admin/manage-users/logs/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ old('name') }}" placeholder="Name" id="_input_name">
            <div class="invalid-feedback" id="_input_help_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
        
        <!----- Start form field url ----->
        <div class="form-group">
            <label class="mb-1" for="url">Url</label>
            <input type="text" class="form-control {{ $errors->has('url')? 'is-invalid': null }}" name="url" value="{{ old('url') }}" placeholder="Url" id="_input_url">
            <div class="invalid-feedback" id="_input_help_url">{{ $errors->has('url')? $errors->first('url'): null }}</div>
        </div>
        <!----- End form field url ----->
        

        <!----- Start form field user_logs_list ----->
        <div class="clearfix mb-3 user-logs-item-container" data-children="manage_users_logs_user_logs_list">
            <label class="mb-1" for="name">User Logs items: </label>
            <table class="table table-borderless table-sm">
                @if(false)
                <thead>
                    <tr>
                        <th>Account</th>
                        <th>User</th>
                        <th>Datail</th>
                        <th>Timestamp</th>
                        <th></th>
                    </tr>
                </thead>
                @endif
                <tbody class="item-list">
                </tbody>
            </table>
            <div class="btn btn-outline-dark btn-block add-item"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new line</div>
        </div>
        <!----- End form field user_logs_list ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {};
if(typeof window.form_children_input_value == 'undefined') window.form_children_input_value = {};
if(typeof window.form_children_input_error == 'undefined') window.form_children_input_error = {};
    
window.form_children_input_value['insert_item_manage_users_logs_user_logs_list'] = {!! old('manage_users_logs_user_logs')? json_encode(old('manage_users_logs_user_logs')): '[{}]' !!};
window.form_children_input_error['insert_item_manage_users_logs_user_logs_list'] = {!! ($errors->get('manage_users_logs_user_logs.*')? json_encode($errors->get('manage_users_logs_user_logs.*')): 'null') !!};
window.form_children_input_template['insert_item_manage_users_logs_user_logs_list'] = function(i, random_id, data, error){ 
    if(!random_id) {
        random_id = Math.random().toString().substr(2) + i;
    }
    
    var str = `
        <td>
            <input type="text" class="form-control ${ ((error && error.account_id)? 'is-invalid': '') }" name="user_logs_list[${random_id}][account_id]" value="${ ((data.account_id != null)? data.account_id:'') }" id="_input_account_id_${random_id}" placeholder="Account">
        </td>
        <td>
            <select class="form-control ${ ((error && error.user_id)? 'is-invalid': '') }" name="user_logs_list[${random_id}][user_id]" id="_input_user_id_${random_id}">
                <option value="">Please select user</option>
                @if(isset($users_list))
                @foreach($users_list as $key => $item)
                <option value="{{ $item->user_id }}" ${ ((data.user_id == '{{ $item->user_id }}')? 'selected':'') }>{{ $item->name }}</option>
                @endforeach
                @endif
            </select>
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.datail)? 'is-invalid': '') }" name="user_logs_list[${random_id}][datail]" value="${ ((data.datail != null)? data.datail:'') }" id="_input_datail_${random_id}" placeholder="Datail">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.timestamp)? 'is-invalid': '') }" name="user_logs_list[${random_id}][timestamp]" value="${ ((data.timestamp != null)? data.timestamp:'') }" id="_input_timestamp_${random_id}" placeholder="Timestamp">
        </td>
        <td class="text-right" width="100">
            <input type="hidden" name="user_logs_list[${random_id}][user_log_id]" value="${ ((data.user_log_id != null)? data.user_log_id:'') }">
            <div class="btn btn-danger btn-delete btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;

    return str;
}


</script>

