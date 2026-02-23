 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
            <!----- Start form field account_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="account_id">Account</label>
                <select class="form-control col {{ $errors->has('account_id')? 'is-invalid': null }}" name="account_id" disabled>
                    <option value="">Please select account</option>
                    <option value="<new>">Add new account</option>
                    @foreach($accounts_list as $row)
                    <option value="{{ $row->account_id }}" {{ ( ($model_info->account_id == $row->account_id)? 'selected':null ) }}>{{ $row->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('account_id')? $errors->first('account_id'): null }}</div>
            </div>
            <!----- End form field account_id ----->
        
            <!----- Start form field user_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="user_id">User</label>
                <select class="form-control col {{ $errors->has('user_id')? 'is-invalid': null }}" name="user_id" disabled>
                    <option value="">Please select user</option>
                    <option value="<new>">Add new user</option>
                    @foreach($users_list as $row)
                    <option value="{{ $row->user_id }}" {{ ( ($model_info->user_id == $row->user_id)? 'selected':null ) }}>{{ $row->first_name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('user_id')? $errors->first('user_id'): null }}</div>
            </div>
            <!----- End form field user_id ----->
        
            <!----- Start form field role ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="role">Role</label>
                <div class="clearfix col">
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('role')? 'is-invalid': null }}" id="role_1" name="role" value="1" {{ ($model_info->role == 1)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="role_1">Super admin</span>
                    </label>
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('role')? 'is-invalid': null }}" id="role_2" name="role" value="2" {{ ($model_info->role == 2)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="role_2">Admin</span>
                    </label>
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('role')? 'is-invalid': null }}" id="role_3" name="role" value="3" {{ ($model_info->role == 3)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="role_3">Member</span>
                    </label>
                </div>
                <div class="invalid-feedback">{{ $errors->has('role')? $errors->first('role'): null }}</div>
            </div>
            <!----- End form field role ----->
        
            <!----- Start form field status ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="status">Status</label>
                <div class="clearfix col">
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_1" name="status" value="1" {{ ($model_info->status == 1)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="status_1">Active</span>
                    </label>
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_0" name="status" value="0" {{ ($model_info->status == 0)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="status_0">Inactive</span>
                    </label>
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_2" name="status" value="2" {{ ($model_info->status == 2)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="status_2">Banned</span>
                    </label>
                </div>
                <div class="invalid-feedback">{{ $errors->has('status')? $errors->first('status'): null }}</div>
            </div>
            <!----- End form field status ----->
        
            <!----- Start form field created_at ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="created_at">Created Time</label>
                <input type="text" class="form-control col {{ $errors->has('created_at')? 'is-invalid': null }}" name="created_at" value="{{ $model_info->created_at }}" placeholder="Created Time" disabled>
                <div class="invalid-feedback">{{ $errors->has('created_at')? $errors->first('created_at'): null }}</div>
            </div>
            <!----- End form field created_at ----->
        
            <!----- Start form field updated_at ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="updated_at">Updated Time</label>
                <input type="text" class="form-control col datepicker {{ $errors->has('updated_at')? 'is-invalid': null }}" name="updated_at" value="{{ $model_info->updated_at }}" placeholder="Updated Time" disabled>
                <div class="invalid-feedback">{{ $errors->has('updated_at')? $errors->first('updated_at'): null }}</div>
            </div>
            <!----- End form field updated_at ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/manage-users/account-users/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>