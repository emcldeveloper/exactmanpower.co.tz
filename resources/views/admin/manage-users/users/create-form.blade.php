 
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
<form action="{{ url('admin/manage-users/users/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">
        <!----- Start form field first_name ----->
        <div class="form-group">
            <label class="mb-1" for="first_name">First Name</label>
            <input type="text" class="form-control {{ $errors->has('first_name')? 'is-invalid': null }}" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" id="_input_first_name">
            <div class="invalid-feedback" id="_input_help_first_name">{{ $errors->has('first_name')? $errors->first('first_name'): null }}</div>
        </div>
        <!----- End form field first_name ----->
        
        <!----- Start form field second_name ----->
        <div class="form-group">
            <label class="mb-1" for="second_name">Second Name</label>
            <input type="text" class="form-control {{ $errors->has('second_name')? 'is-invalid': null }}" name="second_name" value="{{ old('second_name') }}" placeholder="Second Name" id="_input_second_name">
            <div class="invalid-feedback" id="_input_help_second_name">{{ $errors->has('second_name')? $errors->first('second_name'): null }}</div>
        </div>
        <!----- End form field second_name ----->
        
        <!----- Start form field last_name ----->
        <div class="form-group">
            <label class="mb-1" for="last_name">Last Name</label>
            <input type="text" class="form-control {{ $errors->has('last_name')? 'is-invalid': null }}" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" id="_input_last_name">
            <div class="invalid-feedback" id="_input_help_last_name">{{ $errors->has('last_name')? $errors->first('last_name'): null }}</div>
        </div>
        <!----- End form field last_name ----->
        
        <!----- Start form field username ----->
        <div class="form-group">
            <label class="mb-1" for="username">Username</label>
            <input type="text" class="form-control {{ $errors->has('username')? 'is-invalid': null }}" name="username" value="{{ old('username') }}" placeholder="Username" id="_input_username">
            <div class="invalid-feedback" id="_input_help_username">{{ $errors->has('username')? $errors->first('username'): null }}</div>
        </div>
        <!----- End form field username ----->
        
        <!----- Start form field social_name ----->
        <div class="form-group">
            <label class="mb-1" for="social_name">Social Name</label>
            <input type="text" class="form-control {{ $errors->has('social_name')? 'is-invalid': null }}" name="social_name" value="{{ old('social_name') }}" placeholder="Social Name" id="_input_social_name">
            <div class="invalid-feedback" id="_input_help_social_name">{{ $errors->has('social_name')? $errors->first('social_name'): null }}</div>
        </div>
        <!----- End form field social_name ----->
        
        <!----- Start form field social_id ----->
        <div class="form-group">
            <label class="mb-1" for="social_id">Social</label>
            <input type="text" class="form-control {{ $errors->has('social_id')? 'is-invalid': null }}" name="social_id" value="{{ old('social_id') }}" placeholder="Social" id="_input_social_id">
            <div class="invalid-feedback" id="_input_help_social_id">{{ $errors->has('social_id')? $errors->first('social_id'): null }}</div>
        </div>
        <!----- End form field social_id ----->
        
        <!----- Start form field email ----->
        <div class="form-group">
            <label class="mb-1" for="email">Email</label>
            <input type="text" class="form-control {{ $errors->has('email')? 'is-invalid': null }}" name="email" value="{{ old('email') }}" placeholder="Email" id="_input_email">
            <div class="invalid-feedback" id="_input_help_email">{{ $errors->has('email')? $errors->first('email'): null }}</div>
        </div>
        <!----- End form field email ----->
        
        <!----- Start form field phone ----->
        <div class="form-group">
            <label class="mb-1" for="phone">Phone</label>
            <input type="text" class="form-control {{ $errors->has('phone')? 'is-invalid': null }}" name="phone" value="{{ old('phone') }}" placeholder="Phone" id="_input_phone">
            <div class="invalid-feedback" id="_input_help_phone">{{ $errors->has('phone')? $errors->first('phone'): null }}</div>
        </div>
        <!----- End form field phone ----->
        
        <!----- Start form field password ----->
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="mb-1" for="password">Password</label>
                    <input type="password" class="form-control {{ $errors->has('password')? 'is-invalid': null }}" name="password" value="{{ old('password') }}" placeholder="Password" id="_input_password">
                    <div class="invalid-feedback" id="_input_help_password">{{ $errors->has('password')? $errors->first('password'): null }}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="mb-1" for="password_confirmation">Password confirmation</label>
                    <input type="password" class="form-control {{ $errors->has('password_confirmation')? 'is-invalid': null }}" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Password confirmation" id="_input_password">
                    <div class="invalid-feedback" id="_input_help_password_confirmation">{{ $errors->has('password_confirmation')? $errors->first('password_confirmation'): null }}</div>
                </div>
            </div>
        </div>
        <!----- End form field password ----->
        
        <!----- Start form field role ----->
        <div class="form-group">
            <label class="mb-1" for="role">Role</label>
            <div class="clearfix">
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('role')? 'is-invalid': null }}" id="role_1" name="role" value="1" {{ (old('role') == 1)? 'checked':null }}>
                    <span class="custom-control-label" for="role_1">Super admin</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('role')? 'is-invalid': null }}" id="role_2" name="role" value="2" {{ (old('role') == 2)? 'checked':null }}>
                    <span class="custom-control-label" for="role_2">Admin</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('role')? 'is-invalid': null }}" id="role_3" name="role" value="3" {{ (old('role') == 3)? 'checked':null }}>
                    <span class="custom-control-label" for="role_3">Member</span>
                </label>
            </div>
            <div class="invalid-feedback" id="_input_help_role">{{ $errors->has('role')? $errors->first('role'): null }}</div>
        </div>
        <!----- End form field role ----->
        
        <!----- Start form field profile_url ----->
        <div class="form-group">
            <label class="mb-1" for="profile_url">Profile Url</label>
            <div class="custom-file">
                <input name="profile_url" type="file" class="custom-file-input"  id="_input_profile_url">
                <label class="custom-file-label" for="_input_profile_url">Choose profile url file</label>
            </div>
            <div class="invalid-feedback" id="_input_help_profile_url">{{ $errors->has('profile_url')? $errors->first('profile_url'): null }}</div>
        </div>
        <!----- End form field profile_url ----->
        
        <!----- Start form field status ----->
        <div class="form-group">
            <label class="mb-1" for="status">Status</label>
            <div class="clearfix">
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_1" name="status" value="1" {{ (old('status') == 1)? 'checked':null }}>
                    <span class="custom-control-label" for="status_1">Active</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_0" name="status" value="0" {{ (old('status') == 0)? 'checked':null }}>
                    <span class="custom-control-label" for="status_0">Inactive</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_2" name="status" value="2" {{ (old('status') == 2)? 'checked':null }}>
                    <span class="custom-control-label" for="status_2">Banned</span>
                </label>
            </div>
            <div class="invalid-feedback" id="_input_help_status">{{ $errors->has('status')? $errors->first('status'): null }}</div>
        </div>
        <!----- End form field status ----->
        
        <!----- Start form field email_verified_at ----->
        <div class="form-group">
            <label class="mb-1" for="email_verified_at">Email Verified Time</label>
            <input type="text" class="form-control datepicker {{ $errors->has('email_verified_at')? 'is-invalid': null }}" name="email_verified_at" value="{{ old('email_verified_at') }}" placeholder="Email Verified Time" id="_input_email_verified_at">
            <div class="invalid-feedback" id="_input_help_email_verified_at">{{ $errors->has('email_verified_at')? $errors->first('email_verified_at'): null }}</div>
        </div>
        <!----- End form field email_verified_at ----->
        

        <!----- Start form field user_logs_list ----->
        <div class="clearfix mb-3 user-logs-item-container" data-children="manage_users_users_user_logs_list">
            <label class="mb-1" for="name">User Logs items: </label>
            <table class="table table-borderless table-sm">
                @if(false)
                <thead>
                    <tr>
                        <th>Account</th>
                        <th>Log</th>
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
    
window.form_children_input_value['insert_item_manage_users_users_user_logs_list'] = {!! old('manage_users_users_user_logs')? json_encode(old('manage_users_users_user_logs')): '[{}]' !!};
window.form_children_input_error['insert_item_manage_users_users_user_logs_list'] = {!! ($errors->get('manage_users_users_user_logs.*')? json_encode($errors->get('manage_users_users_user_logs.*')): 'null') !!};
window.form_children_input_template['insert_item_manage_users_users_user_logs_list'] = function(i, random_id, data, error){ 
    if(!random_id) {
        random_id = Math.random().toString().substr(2) + i;
    }
    
    var str = `
        <td>
            <input type="text" class="form-control ${ ((error && error.account_id)? 'is-invalid': '') }" name="user_logs_list[${random_id}][account_id]" value="${ ((data.account_id != null)? data.account_id:'') }" id="_input_account_id_${random_id}" placeholder="Account">
        </td>
        <td>
            <select class="form-control ${ ((error && error.log_id)? 'is-invalid': '') }" name="user_logs_list[${random_id}][log_id]" id="_input_log_id_${random_id}">
                <option value="">Please select log</option>
                @if(isset($logs_list))
                @foreach($logs_list as $key => $item)
                <option value="{{ $item->log_id }}" ${ ((data.log_id == '{{ $item->log_id }}')? 'selected':'') }>{{ $item->name }}</option>
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

