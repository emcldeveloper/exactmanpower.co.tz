 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
            <!----- Start form field email ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="email">Email</label>
                <input type="text" class="form-control col {{ $errors->has('email')? 'is-invalid': null }}" name="email" value="{{ $model_info->email }}" placeholder="Email" disabled>
                <div class="invalid-feedback">{{ $errors->has('email')? $errors->first('email'): null }}</div>
            </div>
            <!----- End form field email ----->
        
            <!----- Start form field subscription_type_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="subscription_type_id">Subscription Type</label>
                <select class="form-control col {{ $errors->has('subscription_type_id')? 'is-invalid': null }}" name="subscription_type_id" disabled>
                    <option value="">Please select subscription type</option>
                    <option value="<new>">Add new subscription type</option>
                    @foreach($subscription_types_list as $row)
                    <option value="{{ $row->subscription_type_id }}" {{ ( ($model_info->subscription_type_id == $row->subscription_type_id)? 'selected':null ) }}>{{ $row->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('subscription_type_id')? $errors->first('subscription_type_id'): null }}</div>
            </div>
            <!----- End form field subscription_type_id ----->
        
            <!----- Start form field is_valid ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="is_valid">Is Valid</label>
                <div class="clearfix col">
                    <div class="custom-control custom-switch {{ $errors->has('is_valid')? 'is-invalid': null }}">
                        <input type="checkbox" class="custom-control-input" id="is_valid" name="is_valid" {{ ($model_info->is_valid)? 'checked':null }} disabled>
                        <label class="custom-control-label" for="is_valid">Please check if is valid</label>
                    </div>
                </div>
                <div class="invalid-feedback">{{ $errors->has('is_valid')? $errors->first('is_valid'): null }}</div>
            </div>
            <!----- End form field is_valid ----->
        
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
        
            <!----- Start form field notes ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="notes">Notes</label>
                <textarea name="notes" class="form-control col {{ $errors->has('notes')? 'is-invalid': null }}" placeholder="Notes" rows="4" disabled>{{ $model_info->notes }}</textarea>
                <div class="invalid-feedback">{{ $errors->has('notes')? $errors->first('notes'): null }}</div>
            </div>
            <!----- End form field notes ----->
        
            <!----- Start form field timestamp ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="timestamp">Timestamp</label>
                <input type="text" class="form-control col datepicker {{ $errors->has('timestamp')? 'is-invalid': null }}" name="timestamp" value="{{ $model_info->timestamp }}" placeholder="Timestamp" disabled>
                <div class="invalid-feedback">{{ $errors->has('timestamp')? $errors->first('timestamp'): null }}</div>
            </div>
            <!----- End form field timestamp ----->
        
            <!----- Start form field deactivated_at ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="deactivated_at">Deactivated Time</label>
                <input type="text" class="form-control col {{ $errors->has('deactivated_at')? 'is-invalid': null }}" name="deactivated_at" value="{{ $model_info->deactivated_at }}" placeholder="Deactivated Time" disabled>
                <div class="invalid-feedback">{{ $errors->has('deactivated_at')? $errors->first('deactivated_at'): null }}</div>
            </div>
            <!----- End form field deactivated_at ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/subscriptions/subscribers/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>