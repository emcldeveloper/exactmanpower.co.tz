 
<form action="{{ url('admin/payments/transactions/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">
        <!----- Start form field source_id ----->
        <div class="form-group">
            <label class="mb-1" for="source_id">Source</label>
            <input type="text" class="form-control {{ $errors->has('source_id')? 'is-invalid': null }}" name="source_id" value="{{ old('source_id') }}" placeholder="Source" id="_input_source_id">
            <div class="invalid-feedback" id="_input_help_source_id">{{ $errors->has('source_id')? $errors->first('source_id'): null }}</div>
        </div>
        <!----- End form field source_id ----->
        
        <!----- Start form field source_table ----->
        <div class="form-group">
            <label class="mb-1" for="source_table">Source Table</label>
            <input type="text" class="form-control {{ $errors->has('source_table')? 'is-invalid': null }}" name="source_table" value="{{ old('source_table') }}" placeholder="Source Table" id="_input_source_table">
            <div class="invalid-feedback" id="_input_help_source_table">{{ $errors->has('source_table')? $errors->first('source_table'): null }}</div>
        </div>
        <!----- End form field source_table ----->
        
        <!----- Start form field telecom ----->
        <div class="form-group">
            <label class="mb-1" for="telecom">Telecom</label>
            <input type="text" class="form-control {{ $errors->has('telecom')? 'is-invalid': null }}" name="telecom" value="{{ old('telecom') }}" placeholder="Telecom" id="_input_telecom">
            <div class="invalid-feedback" id="_input_help_telecom">{{ $errors->has('telecom')? $errors->first('telecom'): null }}</div>
        </div>
        <!----- End form field telecom ----->
        
        <!----- Start form field amount ----->
        <div class="form-group">
            <label class="mb-1" for="amount">Amount</label>
            <input type="text" class="form-control {{ $errors->has('amount')? 'is-invalid': null }}" name="amount" value="{{ old('amount') }}" placeholder="Amount" id="_input_amount">
            <div class="invalid-feedback" id="_input_help_amount">{{ $errors->has('amount')? $errors->first('amount'): null }}</div>
        </div>
        <!----- End form field amount ----->
        
        <!----- Start form field charge ----->
        <div class="form-group">
            <label class="mb-1" for="charge">Charge</label>
            <input type="text" class="form-control {{ $errors->has('charge')? 'is-invalid': null }}" name="charge" value="{{ old('charge') }}" placeholder="Charge" id="_input_charge">
            <div class="invalid-feedback" id="_input_help_charge">{{ $errors->has('charge')? $errors->first('charge'): null }}</div>
        </div>
        <!----- End form field charge ----->
        
        <!----- Start form field reference_id ----->
        <div class="form-group">
            <label class="mb-1" for="reference_id">Reference</label>
            <input type="text" class="form-control {{ $errors->has('reference_id')? 'is-invalid': null }}" name="reference_id" value="{{ old('reference_id') }}" placeholder="Reference" id="_input_reference_id">
            <div class="invalid-feedback" id="_input_help_reference_id">{{ $errors->has('reference_id')? $errors->first('reference_id'): null }}</div>
        </div>
        <!----- End form field reference_id ----->
        
        <!----- Start form field txn_id ----->
        <div class="form-group">
            <label class="mb-1" for="txn_id">Txn</label>
            <input type="text" class="form-control {{ $errors->has('txn_id')? 'is-invalid': null }}" name="txn_id" value="{{ old('txn_id') }}" placeholder="Txn" id="_input_txn_id">
            <div class="invalid-feedback" id="_input_help_txn_id">{{ $errors->has('txn_id')? $errors->first('txn_id'): null }}</div>
        </div>
        <!----- End form field txn_id ----->
        
        <!----- Start form field txn_time ----->
        <div class="form-group">
            <label class="mb-1" for="txn_time">Txn Time</label>
            <input type="text" class="form-control datepicker {{ $errors->has('txn_time')? 'is-invalid': null }}" name="txn_time" value="{{ old('txn_time') }}" placeholder="Txn Time" id="_input_txn_time">
            <div class="invalid-feedback" id="_input_help_txn_time">{{ $errors->has('txn_time')? $errors->first('txn_time'): null }}</div>
        </div>
        <!----- End form field txn_time ----->
        
        <!----- Start form field msisdn ----->
        <div class="form-group">
            <label class="mb-1" for="msisdn">Msisdn</label>
            <input type="text" class="form-control {{ $errors->has('msisdn')? 'is-invalid': null }}" name="msisdn" value="{{ old('msisdn') }}" placeholder="Msisdn" id="_input_msisdn">
            <div class="invalid-feedback" id="_input_help_msisdn">{{ $errors->has('msisdn')? $errors->first('msisdn'): null }}</div>
        </div>
        <!----- End form field msisdn ----->
        
        <!----- Start form field timestamp ----->
        <div class="form-group">
            <label class="mb-1" for="timestamp">Timestamp</label>
            <input type="text" class="form-control datepicker {{ $errors->has('timestamp')? 'is-invalid': null }}" name="timestamp" value="{{ old('timestamp') }}" placeholder="Timestamp" id="_input_timestamp">
            <div class="invalid-feedback" id="_input_help_timestamp">{{ $errors->has('timestamp')? $errors->first('timestamp'): null }}</div>
        </div>
        <!----- End form field timestamp ----->
        
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
        
        <!----- Start form field status_discription ----->
        <div class="form-group">
            <label class="mb-1" for="status_discription">Status Discription</label>
            <input type="text" class="form-control {{ $errors->has('status_discription')? 'is-invalid': null }}" name="status_discription" value="{{ old('status_discription') }}" placeholder="Status Discription" id="_input_status_discription">
            <div class="invalid-feedback" id="_input_help_status_discription">{{ $errors->has('status_discription')? $errors->first('status_discription'): null }}</div>
        </div>
        <!----- End form field status_discription ----->
        
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 


</script>

