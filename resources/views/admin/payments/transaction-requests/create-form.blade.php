 
<form action="{{ url('admin/payments/transaction-requests/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">
        <!----- Start form field source_table ----->
        <div class="form-group">
            <label class="mb-1" for="source_table">Source Table</label>
            <input type="text" class="form-control {{ $errors->has('source_table')? 'is-invalid': null }}" name="source_table" value="{{ old('source_table') }}" placeholder="Source Table" id="_input_source_table">
            <div class="invalid-feedback" id="_input_help_source_table">{{ $errors->has('source_table')? $errors->first('source_table'): null }}</div>
        </div>
        <!----- End form field source_table ----->
        
        <!----- Start form field source_id ----->
        <div class="form-group">
            <label class="mb-1" for="source_id">Source</label>
            <input type="text" class="form-control {{ $errors->has('source_id')? 'is-invalid': null }}" name="source_id" value="{{ old('source_id') }}" placeholder="Source" id="_input_source_id">
            <div class="invalid-feedback" id="_input_help_source_id">{{ $errors->has('source_id')? $errors->first('source_id'): null }}</div>
        </div>
        <!----- End form field source_id ----->
        
        <!----- Start form field referent_id ----->
        <div class="form-group">
            <label class="mb-1" for="referent_id">Referent</label>
            <input type="text" class="form-control {{ $errors->has('referent_id')? 'is-invalid': null }}" name="referent_id" value="{{ old('referent_id') }}" placeholder="Referent" id="_input_referent_id">
            <div class="invalid-feedback" id="_input_help_referent_id">{{ $errors->has('referent_id')? $errors->first('referent_id'): null }}</div>
        </div>
        <!----- End form field referent_id ----->
        
        <!----- Start form field amount ----->
        <div class="form-group">
            <label class="mb-1" for="amount">Amount</label>
            <input type="text" class="form-control {{ $errors->has('amount')? 'is-invalid': null }}" name="amount" value="{{ old('amount') }}" placeholder="Amount" id="_input_amount">
            <div class="invalid-feedback" id="_input_help_amount">{{ $errors->has('amount')? $errors->first('amount'): null }}</div>
        </div>
        <!----- End form field amount ----->
        
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
        
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 


</script>

