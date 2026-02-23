 
<form action="{{ url('admin/account-orders/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">
        <!----- Start form field account_id ----->
        @if(!isset($hidden) || (isset($hidden) && !in_array("account_id", $hidden)))
        <div class="form-group">
            <label class="mb-1" for="account_id">Account</label>
            <select class="form-control {{ $errors->has('account_id')? 'is-invalid': null }}" name="account_id" id="_input_account_id">
                <option value="">Please select account</option>
                <option value="<new>">Add new account</option>
                @foreach($accounts_list as $row)
                <option value="{{ $row->account_id }}" {{ ( (old('account_id') == $row->account_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_input_help_account_id">{{ $errors->has('account_id')? $errors->first('account_id'): null }}</div>
        </div>
        @elseif(isset($account_id) && !is_null($account_id))
        <input type="hidden" name="account_id" value="{{ $account_id }}">
        @endif
        <!----- End form field account_id ----->
        
        <!----- Start form field post_id ----->
        @if(!isset($hidden) || (isset($hidden) && !in_array("post_id", $hidden)))
        <div class="form-group">
            <label class="mb-1" for="post_id">Post</label>
            <select class="form-control {{ $errors->has('post_id')? 'is-invalid': null }}" name="post_id" id="_input_post_id">
                <option value="">Please select post</option>
                <option value="<new>">Add new post</option>
                @foreach($posts_list as $row)
                <option value="{{ $row->post_id }}" {{ ( (old('post_id') == $row->post_id)? 'selected':null ) }}>{{ $row->post_title }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_input_help_post_id">{{ $errors->has('post_id')? $errors->first('post_id'): null }}</div>
        </div>
        @elseif(isset($post_id) && !is_null($post_id))
        <input type="hidden" name="post_id" value="{{ $post_id }}">
        @endif
        <!----- End form field post_id ----->
        
        <!----- Start form field amount ----->
        <div class="form-group">
            <label class="mb-1" for="amount">Amount</label>
            <input type="text" class="form-control {{ $errors->has('amount')? 'is-invalid': null }}" name="amount" value="{{ old('amount') }}" placeholder="Amount" id="_input_amount">
            <div class="invalid-feedback" id="_input_help_amount">{{ $errors->has('amount')? $errors->first('amount'): null }}</div>
        </div>
        <!----- End form field amount ----->
        
        <!----- Start form field is_paid ----->
        <div class="form-group">
            <label class="mb-1" for="is_paid">Is Paid</label>
            <div class="custom-control custom-switch {{ $errors->has('is_paid')? 'is-invalid': null }}">
                <input type="checkbox" class="custom-control-input" id="is_paid" name="is_paid" id="_input_is_paid" {{ old('is_paid')? 'checked':null }}>
                <label class="custom-control-label" for="is_paid">Please check if is paid</label>
            </div>
            <div class="invalid-feedback" id="_input_help_is_paid">{{ $errors->has('is_paid')? $errors->first('is_paid'): null }}</div>
        </div>
        <!----- End form field is_paid ----->
        
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
        
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 


</script>

