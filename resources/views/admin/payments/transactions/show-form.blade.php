 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
            <!----- Start form field source_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="source_id">Source</label>
                <input type="text" class="form-control col {{ $errors->has('source_id')? 'is-invalid': null }}" name="source_id" value="{{ $model_info->source_id }}" placeholder="Source" disabled>
                <div class="invalid-feedback">{{ $errors->has('source_id')? $errors->first('source_id'): null }}</div>
            </div>
            <!----- End form field source_id ----->
        
            <!----- Start form field source_table ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="source_table">Source Table</label>
                <input type="text" class="form-control col {{ $errors->has('source_table')? 'is-invalid': null }}" name="source_table" value="{{ $model_info->source_table }}" placeholder="Source Table" disabled>
                <div class="invalid-feedback">{{ $errors->has('source_table')? $errors->first('source_table'): null }}</div>
            </div>
            <!----- End form field source_table ----->
        
            <!----- Start form field telecom ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="telecom">Telecom</label>
                <input type="text" class="form-control col {{ $errors->has('telecom')? 'is-invalid': null }}" name="telecom" value="{{ $model_info->telecom }}" placeholder="Telecom" disabled>
                <div class="invalid-feedback">{{ $errors->has('telecom')? $errors->first('telecom'): null }}</div>
            </div>
            <!----- End form field telecom ----->
        
            <!----- Start form field amount ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="amount">Amount</label>
                <input type="text" class="form-control col {{ $errors->has('amount')? 'is-invalid': null }}" name="amount" value="{{ $model_info->amount }}" placeholder="Amount" disabled>
                <div class="invalid-feedback">{{ $errors->has('amount')? $errors->first('amount'): null }}</div>
            </div>
            <!----- End form field amount ----->
        
            <!----- Start form field charge ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="charge">Charge</label>
                <input type="text" class="form-control col {{ $errors->has('charge')? 'is-invalid': null }}" name="charge" value="{{ $model_info->charge }}" placeholder="Charge" disabled>
                <div class="invalid-feedback">{{ $errors->has('charge')? $errors->first('charge'): null }}</div>
            </div>
            <!----- End form field charge ----->
        
            <!----- Start form field reference_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="reference_id">Reference</label>
                <input type="text" class="form-control col {{ $errors->has('reference_id')? 'is-invalid': null }}" name="reference_id" value="{{ $model_info->reference_id }}" placeholder="Reference" disabled>
                <div class="invalid-feedback">{{ $errors->has('reference_id')? $errors->first('reference_id'): null }}</div>
            </div>
            <!----- End form field reference_id ----->
        
            <!----- Start form field txn_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="txn_id">Txn</label>
                <input type="text" class="form-control col {{ $errors->has('txn_id')? 'is-invalid': null }}" name="txn_id" value="{{ $model_info->txn_id }}" placeholder="Txn" disabled>
                <div class="invalid-feedback">{{ $errors->has('txn_id')? $errors->first('txn_id'): null }}</div>
            </div>
            <!----- End form field txn_id ----->
        
            <!----- Start form field txn_time ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="txn_time">Txn Time</label>
                <input type="text" class="form-control col datepicker {{ $errors->has('txn_time')? 'is-invalid': null }}" name="txn_time" value="{{ $model_info->txn_time }}" placeholder="Txn Time" disabled>
                <div class="invalid-feedback">{{ $errors->has('txn_time')? $errors->first('txn_time'): null }}</div>
            </div>
            <!----- End form field txn_time ----->
        
            <!----- Start form field msisdn ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="msisdn">Msisdn</label>
                <input type="text" class="form-control col {{ $errors->has('msisdn')? 'is-invalid': null }}" name="msisdn" value="{{ $model_info->msisdn }}" placeholder="Msisdn" disabled>
                <div class="invalid-feedback">{{ $errors->has('msisdn')? $errors->first('msisdn'): null }}</div>
            </div>
            <!----- End form field msisdn ----->
        
            <!----- Start form field timestamp ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="timestamp">Timestamp</label>
                <input type="text" class="form-control col datepicker {{ $errors->has('timestamp')? 'is-invalid': null }}" name="timestamp" value="{{ $model_info->timestamp }}" placeholder="Timestamp" disabled>
                <div class="invalid-feedback">{{ $errors->has('timestamp')? $errors->first('timestamp'): null }}</div>
            </div>
            <!----- End form field timestamp ----->
        
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
        
            <!----- Start form field status_discription ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="status_discription">Status Discription</label>
                <input type="text" class="form-control col {{ $errors->has('status_discription')? 'is-invalid': null }}" name="status_discription" value="{{ $model_info->status_discription }}" placeholder="Status Discription" disabled>
                <div class="invalid-feedback">{{ $errors->has('status_discription')? $errors->first('status_discription'): null }}</div>
            </div>
            <!----- End form field status_discription ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/payments/transactions/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>