  

<form action="{{ url('admin/manage-users/account-users/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->

    <div class="clearfix">
        <!----- Start form field account_id ----->
        @if(!in_array("account_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="account_id">Account</label>
            <select class="form-control {{ $errors->has('account_id')? 'is-invalid': null }}" name="account_id" id="_input_account_id">
                <option value="">Please select account</option>
                <option value="<new>">Add new account</option>
                @foreach($accounts_list as $row)
                <option value="{{ $row->account_id }}" {{ ( ($model_info->account_id == $row->account_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_account_id">{{ $errors->has('account_id')? $errors->first('account_id'): null }}</div>
        </div>
        @endif
        <!----- End form field account_id ----->
        <!----- Start form field user_id ----->
        @if(!in_array("user_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="user_id">User</label>
            <select class="form-control {{ $errors->has('user_id')? 'is-invalid': null }}" name="user_id" id="_input_user_id">
                <option value="">Please select user</option>
                <option value="<new>">Add new user</option>
                @foreach($users_list as $row)
                <option value="{{ $row->user_id }}" {{ ( ($model_info->user_id == $row->user_id)? 'selected':null ) }}>{{ $row->first_name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_user_id">{{ $errors->has('user_id')? $errors->first('user_id'): null }}</div>
        </div>
        @endif
        <!----- End form field user_id ----->
        <!----- Start form field role ----->
        <div class="form-group">
            <label class="mb-1" for="role">Role</label>
            <div class="clearfix">
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('role')? 'is-invalid': null }}" id="role_1" name="role" value="1" {{ ($model_info->role == 1)? 'checked':null }}>
                    <span class="custom-control-label" for="role_1">Super admin</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('role')? 'is-invalid': null }}" id="role_2" name="role" value="2" {{ ($model_info->role == 2)? 'checked':null }}>
                    <span class="custom-control-label" for="role_2">Admin</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('role')? 'is-invalid': null }}" id="role_3" name="role" value="3" {{ ($model_info->role == 3)? 'checked':null }}>
                    <span class="custom-control-label" for="role_3">Member</span>
                </label>
            </div>
            <div class="invalid-feedback" id="_help_input_role">{{ $errors->has('role')? $errors->first('role'): null }}</div>
        </div>
        <!----- End form field role ----->
        <!----- Start form field status ----->
        <div class="form-group">
            <label class="mb-1" for="status">Status</label>
            <div class="clearfix">
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_1" name="status" value="1" {{ ($model_info->status == 1)? 'checked':null }}>
                    <span class="custom-control-label" for="status_1">Active</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_0" name="status" value="0" {{ ($model_info->status == 0)? 'checked':null }}>
                    <span class="custom-control-label" for="status_0">Inactive</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_2" name="status" value="2" {{ ($model_info->status == 2)? 'checked':null }}>
                    <span class="custom-control-label" for="status_2">Banned</span>
                </label>
            </div>
            <div class="invalid-feedback" id="_help_input_status">{{ $errors->has('status')? $errors->first('status'): null }}</div>
        </div>
        <!----- End form field status ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
