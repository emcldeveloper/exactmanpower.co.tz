 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
            <!----- Start form field name ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="name">Name</label>
                <input type="text" class="form-control col {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" disabled>
                <div class="invalid-feedback">{{ $errors->has('name')? $errors->first('name'): null }}</div>
            </div>
            <!----- End form field name ----->
        
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
        
            <!----- Start form field logo ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="logo">Logo</label>
                <div class="custom-file col">
                    <input name="logo" type="file" class="custom-file-input" id="file_logo" disabled>
                    <label class="custom-file-label" for="file_logo">Choose logo file</label>
                </div>
                <div class="invalid-feedback">{{ $errors->has('logo')? $errors->first('logo'): null }}</div>
            </div>
            <!----- End form field logo ----->
        
            <!----- Start form field type ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="type">Type</label>
                <div class="clearfix col">
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_0" name="type" value="0" {{ ($model_info->type == 0)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="type_0">Type Zero</span>
                    </label>
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_1" name="type" value="1" {{ ($model_info->type == 1)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="type_1">Type One</span>
                    </label>
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_2" name="type" value="2" {{ ($model_info->type == 2)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="type_2">Type Two</span>
                    </label>
                </div>
                <div class="invalid-feedback">{{ $errors->has('type')? $errors->first('type'): null }}</div>
            </div>
            <!----- End form field type ----->
        
            <!----- Start form field address ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="address">Address</label>
                <textarea name="address" class="form-control col {{ $errors->has('address')? 'is-invalid': null }}" placeholder="Address" rows="4" disabled>{{ $model_info->address }}</textarea>
                <div class="invalid-feedback">{{ $errors->has('address')? $errors->first('address'): null }}</div>
            </div>
            <!----- End form field address ----->
        
            <!----- Start form field email ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="email">Email</label>
                <input type="text" class="form-control col {{ $errors->has('email')? 'is-invalid': null }}" name="email" value="{{ $model_info->email }}" placeholder="Email" disabled>
                <div class="invalid-feedback">{{ $errors->has('email')? $errors->first('email'): null }}</div>
            </div>
            <!----- End form field email ----->
        
            <!----- Start form field phone ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="phone">Phone</label>
                <input type="text" class="form-control col {{ $errors->has('phone')? 'is-invalid': null }}" name="phone" value="{{ $model_info->phone }}" placeholder="Phone" disabled>
                <div class="invalid-feedback">{{ $errors->has('phone')? $errors->first('phone'): null }}</div>
            </div>
            <!----- End form field phone ----->
        
            <!----- Start form field mobile ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="mobile">Mobile</label>
                <input type="text" class="form-control col {{ $errors->has('mobile')? 'is-invalid': null }}" name="mobile" value="{{ $model_info->mobile }}" placeholder="Mobile" disabled>
                <div class="invalid-feedback">{{ $errors->has('mobile')? $errors->first('mobile'): null }}</div>
            </div>
            <!----- End form field mobile ----->
        
            <!----- Start form field fax ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="fax">Fax</label>
                <input type="text" class="form-control col {{ $errors->has('fax')? 'is-invalid': null }}" name="fax" value="{{ $model_info->fax }}" placeholder="Fax" disabled>
                <div class="invalid-feedback">{{ $errors->has('fax')? $errors->first('fax'): null }}</div>
            </div>
            <!----- End form field fax ----->
        
            <!----- Start form field location_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="location_id">Location</label>
                <select class="form-control col {{ $errors->has('location_id')? 'is-invalid': null }}" name="location_id" disabled>
                    <option value="">Please select location</option>
                    <option value="<new>">Add new location</option>
                    @foreach($locations_list as $row)
                    <option value="{{ $row->location_id }}" {{ ( ($model_info->location_id == $row->location_id)? 'selected':null ) }}>{{ $row->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('location_id')? $errors->first('location_id'): null }}</div>
            </div>
            <!----- End form field location_id ----->
        
            <!----- Start form field currency ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="currency">Currency</label>
                <input type="text" class="form-control col {{ $errors->has('currency')? 'is-invalid': null }}" name="currency" value="{{ $model_info->currency }}" placeholder="Currency" disabled>
                <div class="invalid-feedback">{{ $errors->has('currency')? $errors->first('currency'): null }}</div>
            </div>
            <!----- End form field currency ----->
        
            <!----- Start form field language ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="language">Language</label>
                <input type="text" class="form-control col {{ $errors->has('language')? 'is-invalid': null }}" name="language" value="{{ $model_info->language }}" placeholder="Language" disabled>
                <div class="invalid-feedback">{{ $errors->has('language')? $errors->first('language'): null }}</div>
            </div>
            <!----- End form field language ----->
        
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
            <a class="btn btn-success" href="{{ url('admin/manage-users/accounts/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>