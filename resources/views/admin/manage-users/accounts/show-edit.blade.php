  

<form class="clearfix p-3" action="{{ url('admin/manage-users/accounts/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    <div class="clearfix">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->
    
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" id="_input_name">
            <div class="invalid-feedback" id="_help_input_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
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
        <!----- Start form field logo ----->
        <div class="form-group">
            <label class="mb-1" for="logo">Logo</label>
            <div class="custom-file">
                <input name="logo" type="file" class="custom-file-input" id="_input_logo">
                <label class="custom-file-label" for="_input_logo">Choose logo file</label>
            </div>
            <div class="invalid-feedback" id="_help_input_logo">{{ $errors->has('logo')? $errors->first('logo'): null }}</div>
        </div>
        <!----- End form field logo ----->
        <!----- Start form field type ----->
        <div class="form-group">
            <label class="mb-1" for="type">Type</label>
            <div class="clearfix">
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_0" name="type" value="0" {{ ($model_info->type == 0)? 'checked':null }}>
                    <span class="custom-control-label" for="type_0">Type Zero</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_1" name="type" value="1" {{ ($model_info->type == 1)? 'checked':null }}>
                    <span class="custom-control-label" for="type_1">Type One</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_2" name="type" value="2" {{ ($model_info->type == 2)? 'checked':null }}>
                    <span class="custom-control-label" for="type_2">Type Two</span>
                </label>
            </div>
            <div class="invalid-feedback" id="_help_input_type">{{ $errors->has('type')? $errors->first('type'): null }}</div>
        </div>
        <!----- End form field type ----->
        <!----- Start form field address ----->
        <div class="form-group">
            <label class="mb-1" for="address">Address</label>
            <textarea name="address" class="form-control {{ $errors->has('address')? 'is-invalid': null }}" placeholder="Address" rows="4" id="_input_address">{{ $model_info->address }}</textarea>
            <div class="invalid-feedback" id="_help_input_address">{{ $errors->has('address')? $errors->first('address'): null }}</div>
        </div>
        <!----- End form field address ----->
        <!----- Start form field email ----->
        <div class="form-group">
            <label class="mb-1" for="email">Email</label>
            <input type="text" class="form-control {{ $errors->has('email')? 'is-invalid': null }}" name="email" value="{{ $model_info->email }}" placeholder="Email" id="_input_email">
            <div class="invalid-feedback" id="_help_input_email">{{ $errors->has('email')? $errors->first('email'): null }}</div>
        </div>
        <!----- End form field email ----->
        <!----- Start form field phone ----->
        <div class="form-group">
            <label class="mb-1" for="phone">Phone</label>
            <input type="text" class="form-control {{ $errors->has('phone')? 'is-invalid': null }}" name="phone" value="{{ $model_info->phone }}" placeholder="Phone" id="_input_phone">
            <div class="invalid-feedback" id="_help_input_phone">{{ $errors->has('phone')? $errors->first('phone'): null }}</div>
        </div>
        <!----- End form field phone ----->
        <!----- Start form field mobile ----->
        <div class="form-group">
            <label class="mb-1" for="mobile">Mobile</label>
            <input type="text" class="form-control {{ $errors->has('mobile')? 'is-invalid': null }}" name="mobile" value="{{ $model_info->mobile }}" placeholder="Mobile" id="_input_mobile">
            <div class="invalid-feedback" id="_help_input_mobile">{{ $errors->has('mobile')? $errors->first('mobile'): null }}</div>
        </div>
        <!----- End form field mobile ----->
        <!----- Start form field fax ----->
        <div class="form-group">
            <label class="mb-1" for="fax">Fax</label>
            <input type="text" class="form-control {{ $errors->has('fax')? 'is-invalid': null }}" name="fax" value="{{ $model_info->fax }}" placeholder="Fax" id="_input_fax">
            <div class="invalid-feedback" id="_help_input_fax">{{ $errors->has('fax')? $errors->first('fax'): null }}</div>
        </div>
        <!----- End form field fax ----->
        <!----- Start form field location_id ----->
        @if(!in_array("location_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="location_id">Location</label>
            <select class="form-control {{ $errors->has('location_id')? 'is-invalid': null }}" name="location_id" id="_input_location_id">
                <option value="">Please select location</option>
                <option value="<new>">Add new location</option>
                @foreach($locations_list as $row)
                <option value="{{ $row->location_id }}" {{ ( ($model_info->location_id == $row->location_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_location_id">{{ $errors->has('location_id')? $errors->first('location_id'): null }}</div>
        </div>
        @endif
        <!----- End form field location_id ----->
        <!----- Start form field currency ----->
        <div class="form-group">
            <label class="mb-1" for="currency">Currency</label>
            <input type="text" class="form-control {{ $errors->has('currency')? 'is-invalid': null }}" name="currency" value="{{ $model_info->currency }}" placeholder="Currency" id="_input_currency">
            <div class="invalid-feedback" id="_help_input_currency">{{ $errors->has('currency')? $errors->first('currency'): null }}</div>
        </div>
        <!----- End form field currency ----->
        <!----- Start form field language ----->
        <div class="form-group">
            <label class="mb-1" for="language">Language</label>
            <input type="text" class="form-control {{ $errors->has('language')? 'is-invalid': null }}" name="language" value="{{ $model_info->language }}" placeholder="Language" id="_input_language">
            <div class="invalid-feedback" id="_help_input_language">{{ $errors->has('language')? $errors->first('language'): null }}</div>
        </div>
        <!----- End form field language ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
