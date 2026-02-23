  

<form class="clearfix p-3" action="{{ url('admin/payments/transaction-requests/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    <div class="clearfix">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->
    
        <!----- Start form field source_table ----->
        <div class="form-group">
            <label class="mb-1" for="source_table">Source Table</label>
            <input type="text" class="form-control {{ $errors->has('source_table')? 'is-invalid': null }}" name="source_table" value="{{ $model_info->source_table }}" placeholder="Source Table" id="_input_source_table">
            <div class="invalid-feedback" id="_help_input_source_table">{{ $errors->has('source_table')? $errors->first('source_table'): null }}</div>
        </div>
        <!----- End form field source_table ----->
        <!----- Start form field source_id ----->
        <div class="form-group">
            <label class="mb-1" for="source_id">Source</label>
            <input type="text" class="form-control {{ $errors->has('source_id')? 'is-invalid': null }}" name="source_id" value="{{ $model_info->source_id }}" placeholder="Source" id="_input_source_id">
            <div class="invalid-feedback" id="_help_input_source_id">{{ $errors->has('source_id')? $errors->first('source_id'): null }}</div>
        </div>
        <!----- End form field source_id ----->
        <!----- Start form field referent_id ----->
        <div class="form-group">
            <label class="mb-1" for="referent_id">Referent</label>
            <input type="text" class="form-control {{ $errors->has('referent_id')? 'is-invalid': null }}" name="referent_id" value="{{ $model_info->referent_id }}" placeholder="Referent" id="_input_referent_id">
            <div class="invalid-feedback" id="_help_input_referent_id">{{ $errors->has('referent_id')? $errors->first('referent_id'): null }}</div>
        </div>
        <!----- End form field referent_id ----->
        <!----- Start form field amount ----->
        <div class="form-group">
            <label class="mb-1" for="amount">Amount</label>
            <input type="text" class="form-control {{ $errors->has('amount')? 'is-invalid': null }}" name="amount" value="{{ $model_info->amount }}" placeholder="Amount" id="_input_amount">
            <div class="invalid-feedback" id="_help_input_amount">{{ $errors->has('amount')? $errors->first('amount'): null }}</div>
        </div>
        <!----- End form field amount ----->
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
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
