 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
            <!----- Start form field source_table ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="source_table">Source Table</label>
                <input type="text" class="form-control col {{ $errors->has('source_table')? 'is-invalid': null }}" name="source_table" value="{{ $model_info->source_table }}" placeholder="Source Table" disabled>
                <div class="invalid-feedback">{{ $errors->has('source_table')? $errors->first('source_table'): null }}</div>
            </div>
            <!----- End form field source_table ----->
        
            <!----- Start form field source_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="source_id">Source</label>
                <input type="text" class="form-control col {{ $errors->has('source_id')? 'is-invalid': null }}" name="source_id" value="{{ $model_info->source_id }}" placeholder="Source" disabled>
                <div class="invalid-feedback">{{ $errors->has('source_id')? $errors->first('source_id'): null }}</div>
            </div>
            <!----- End form field source_id ----->
        
            <!----- Start form field referent_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="referent_id">Referent</label>
                <input type="text" class="form-control col {{ $errors->has('referent_id')? 'is-invalid': null }}" name="referent_id" value="{{ $model_info->referent_id }}" placeholder="Referent" disabled>
                <div class="invalid-feedback">{{ $errors->has('referent_id')? $errors->first('referent_id'): null }}</div>
            </div>
            <!----- End form field referent_id ----->
        
            <!----- Start form field amount ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="amount">Amount</label>
                <input type="text" class="form-control col {{ $errors->has('amount')? 'is-invalid': null }}" name="amount" value="{{ $model_info->amount }}" placeholder="Amount" disabled>
                <div class="invalid-feedback">{{ $errors->has('amount')? $errors->first('amount'): null }}</div>
            </div>
            <!----- End form field amount ----->
        
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
            <a class="btn btn-success" href="{{ url('admin/payments/transaction-requests/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>