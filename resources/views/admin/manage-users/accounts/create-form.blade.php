 
<form action="{{ url('admin/manage-users/accounts/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
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
        
        <!----- Start form field user_id ----->
        @if(!isset($hidden) || (isset($hidden) && !in_array("user_id", $hidden)))
        <div class="form-group">
            <label class="mb-1" for="user_id">User</label>
            <select class="form-control {{ $errors->has('user_id')? 'is-invalid': null }}" name="user_id" id="_input_user_id">
                <option value="">Please select user</option>
                <option value="<new>">Add new user</option>
                @foreach($users_list as $row)
                <option value="{{ $row->user_id }}" {{ ( (old('user_id') == $row->user_id)? 'selected':null ) }}>{{ $row->first_name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_input_help_user_id">{{ $errors->has('user_id')? $errors->first('user_id'): null }}</div>
        </div>
        @elseif(isset($user_id) && !is_null($user_id))
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        @endif
        <!----- End form field user_id ----->
        
        <!----- Start form field logo ----->
        <div class="form-group">
            <label class="mb-1" for="logo">Logo</label>
            <div class="custom-file">
                <input name="logo" type="file" class="custom-file-input"  id="_input_logo">
                <label class="custom-file-label" for="_input_logo">Choose logo file</label>
            </div>
            <div class="invalid-feedback" id="_input_help_logo">{{ $errors->has('logo')? $errors->first('logo'): null }}</div>
        </div>
        <!----- End form field logo ----->
        
        <!----- Start form field type ----->
        <div class="form-group">
            <label class="mb-1" for="type">Type</label>
            <div class="clearfix">
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_0" name="type" value="0" {{ (old('type') == 0)? 'checked':null }}>
                    <span class="custom-control-label" for="type_0">Type Zero</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_1" name="type" value="1" {{ (old('type') == 1)? 'checked':null }}>
                    <span class="custom-control-label" for="type_1">Type One</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_2" name="type" value="2" {{ (old('type') == 2)? 'checked':null }}>
                    <span class="custom-control-label" for="type_2">Type Two</span>
                </label>
            </div>
            <div class="invalid-feedback" id="_input_help_type">{{ $errors->has('type')? $errors->first('type'): null }}</div>
        </div>
        <!----- End form field type ----->
        
        <!----- Start form field address ----->
        <div class="form-group">
            <label class="mb-1" for="address">Address</label>
            <textarea name="address" class="form-control {{ $errors->has('address')? 'is-invalid': null }}" placeholder="Address" rows="4" id="_input_address">{{ old('address') }}</textarea>
            <div class="invalid-feedback" id="_input_help_address">{{ $errors->has('address')? $errors->first('address'): null }}</div>
        </div>
        <!----- End form field address ----->
        
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
        
        <!----- Start form field mobile ----->
        <div class="form-group">
            <label class="mb-1" for="mobile">Mobile</label>
            <input type="text" class="form-control {{ $errors->has('mobile')? 'is-invalid': null }}" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile" id="_input_mobile">
            <div class="invalid-feedback" id="_input_help_mobile">{{ $errors->has('mobile')? $errors->first('mobile'): null }}</div>
        </div>
        <!----- End form field mobile ----->
        
        <!----- Start form field fax ----->
        <div class="form-group">
            <label class="mb-1" for="fax">Fax</label>
            <input type="text" class="form-control {{ $errors->has('fax')? 'is-invalid': null }}" name="fax" value="{{ old('fax') }}" placeholder="Fax" id="_input_fax">
            <div class="invalid-feedback" id="_input_help_fax">{{ $errors->has('fax')? $errors->first('fax'): null }}</div>
        </div>
        <!----- End form field fax ----->
        
        <!----- Start form field location_id ----->
        @if(!isset($hidden) || (isset($hidden) && !in_array("location_id", $hidden)))
        <div class="form-group">
            <label class="mb-1" for="location_id">Location</label>
            <select class="form-control {{ $errors->has('location_id')? 'is-invalid': null }}" name="location_id" id="_input_location_id">
                <option value="">Please select location</option>
                <option value="<new>">Add new location</option>
                @foreach($locations_list as $row)
                <option value="{{ $row->location_id }}" {{ ( (old('location_id') == $row->location_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_input_help_location_id">{{ $errors->has('location_id')? $errors->first('location_id'): null }}</div>
        </div>
        @elseif(isset($location_id) && !is_null($location_id))
        <input type="hidden" name="location_id" value="{{ $location_id }}">
        @endif
        <!----- End form field location_id ----->
        
        <!----- Start form field currency ----->
        <div class="form-group">
            <label class="mb-1" for="currency">Currency</label>
            <input type="text" class="form-control {{ $errors->has('currency')? 'is-invalid': null }}" name="currency" value="{{ old('currency') }}" placeholder="Currency" id="_input_currency">
            <div class="invalid-feedback" id="_input_help_currency">{{ $errors->has('currency')? $errors->first('currency'): null }}</div>
        </div>
        <!----- End form field currency ----->
        
        <!----- Start form field language ----->
        <div class="form-group">
            <label class="mb-1" for="language">Language</label>
            <input type="text" class="form-control {{ $errors->has('language')? 'is-invalid': null }}" name="language" value="{{ old('language') }}" placeholder="Language" id="_input_language">
            <div class="invalid-feedback" id="_input_help_language">{{ $errors->has('language')? $errors->first('language'): null }}</div>
        </div>
        <!----- End form field language ----->
        

        <!----- Start form field account_users_list ----->
        <div class="clearfix mb-3 account-users-item-container" data-children="manage_users_accounts_account_users_list">
            <h5>Account Users items: </h5>
            <table class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>Account</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="item-list">
                    <tr>
                        <td>
                            <select class="form-control {{ $errors->has('account_id')? 'is-invalid': null }}" name="account_users_list[0][account_id]" id="_input_account_id">
                                <option value="">Please select account</option>
                                <option value="<new>">Add new account</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control {{ $errors->has('user_id')? 'is-invalid': null }}" name="account_users_list[0][user_id]" id="_input_user_id">
                                <option value="">Please select user</option>
                                <option value="<new>">Add new user</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="account_users_list[0][role]" value="{{ old('account_users_list.0.role') }}" >
                        </td>
                        <td>
                            <input type="text" class="form-control" name="account_users_list[0][status]" value="{{ old('account_users_list.0.status') }}" >
                        </td>
                        <td class="text-right" width="100">
                            <!-- <div class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></div> -->
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="btn btn-outline-dark btn-block add-item"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new line</div>
        </div>
        <!----- End form field account_users_list ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 
window.form_children_input_template['insert_item_manage_users_accounts_account_users_list'] = function(i, data){ 
    return `
        <td>
            <select class="form-control {{ $errors->has('account_id')? 'is-invalid': null }}" name="account_users_list[${i}][account_id]" id="_input_account_id_${i}">
                <option value="">Please select account</option>
                <option value="<new>">Add new account</option>
            </select>
        </td>
        <td>
            <select class="form-control {{ $errors->has('user_id')? 'is-invalid': null }}" name="account_users_list[${i}][user_id]" id="_input_user_id_${i}">
                <option value="">Please select user</option>
                <option value="<new>">Add new user</option>
            </select>
        </td>
        <td>
            <input type="text" class="form-control" name="account_users_list[${i}][role]" value="${ ((data.role)? data.role:'') }" id="_input_role_${i}">
        </td>
        <td>
            <input type="text" class="form-control" name="account_users_list[${i}][status]" value="${ ((data.status)? data.status:'') }" id="_input_status_${i}">
        </td>
        <td>
            <div class="btn btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;
}


</script>

