 
<form action="{{ url('admin/subscriptions/subscribers/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">
        <!----- Start form field email ----->
        <div class="form-group">
            <label class="mb-1" for="email">Email</label>
            <input type="text" class="form-control {{ $errors->has('email')? 'is-invalid': null }}" name="email" value="{{ old('email') }}" placeholder="Email" id="_input_email">
            <div class="invalid-feedback" id="_input_help_email">{{ $errors->has('email')? $errors->first('email'): null }}</div>
        </div>
        <!----- End form field email ----->
        
        <!----- Start form field subscription_type_id ----->
        @if(!isset($hidden) || (isset($hidden) && !in_array("subscription_type_id", $hidden)))
        <div class="form-group">
            <label class="mb-1" for="subscription_type_id">Subscription Type</label>
            <select class="form-control {{ $errors->has('subscription_type_id')? 'is-invalid': null }}" name="subscription_type_id" id="_input_subscription_type_id">
                <option value="">Please select subscription type</option>
                <option value="<new>">Add new subscription type</option>
                @foreach($subscription_types_list as $row)
                <option value="{{ $row->subscription_type_id }}" {{ ( (old('subscription_type_id') == $row->subscription_type_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_input_help_subscription_type_id">{{ $errors->has('subscription_type_id')? $errors->first('subscription_type_id'): null }}</div>
        </div>
        @elseif(isset($subscription_type_id) && !is_null($subscription_type_id))
        <input type="hidden" name="subscription_type_id" value="{{ $subscription_type_id }}">
        @endif
        <!----- End form field subscription_type_id ----->
        
        <!----- Start form field is_valid ----->
        <div class="form-group">
            <label class="mb-1" for="is_valid">Is Valid</label>
            <div class="custom-control custom-switch {{ $errors->has('is_valid')? 'is-invalid': null }}">
                <input type="checkbox" class="custom-control-input" id="is_valid" name="is_valid" id="_input_is_valid" {{ old('is_valid')? 'checked':null }}>
                <label class="custom-control-label" for="is_valid">Please check if is valid</label>
            </div>
            <div class="invalid-feedback" id="_input_help_is_valid">{{ $errors->has('is_valid')? $errors->first('is_valid'): null }}</div>
        </div>
        <!----- End form field is_valid ----->
        
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
        
        <!----- Start form field notes ----->
        <div class="form-group">
            <label class="mb-1" for="notes">Notes</label>
            <textarea name="notes" class="form-control {{ $errors->has('notes')? 'is-invalid': null }}" placeholder="Notes" rows="4" id="_input_notes">{{ old('notes') }}</textarea>
            <div class="invalid-feedback" id="_input_help_notes">{{ $errors->has('notes')? $errors->first('notes'): null }}</div>
        </div>
        <!----- End form field notes ----->
        
        <!----- Start form field timestamp ----->
        <div class="form-group">
            <label class="mb-1" for="timestamp">Timestamp</label>
            <input type="text" class="form-control datepicker {{ $errors->has('timestamp')? 'is-invalid': null }}" name="timestamp" value="{{ old('timestamp') }}" placeholder="Timestamp" id="_input_timestamp">
            <div class="invalid-feedback" id="_input_help_timestamp">{{ $errors->has('timestamp')? $errors->first('timestamp'): null }}</div>
        </div>
        <!----- End form field timestamp ----->
        
        <!----- Start form field deactivated_at ----->
        <div class="form-group">
            <label class="mb-1" for="deactivated_at">Deactivated Time</label>
            <input type="text" class="form-control datepicker {{ $errors->has('deactivated_at')? 'is-invalid': null }}" name="deactivated_at" value="{{ old('deactivated_at') }}" placeholder="Deactivated Time" id="_input_deactivated_at">
            <div class="invalid-feedback" id="_input_help_deactivated_at">{{ $errors->has('deactivated_at')? $errors->first('deactivated_at'): null }}</div>
        </div>
        <!----- End form field deactivated_at ----->
        
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 


</script>

