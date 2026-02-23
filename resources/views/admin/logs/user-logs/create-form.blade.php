 
<form action="{{ url('admin/logs/user-logs/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
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
        
        <!----- Start form field user_id ----->
        @if(!isset($hidden) || (isset($hidden) && !in_array("user_id", $hidden)))
        <div class="form-group">
            <label class="mb-1" for="user_id">User</label>
            <select class="form-control {{ $errors->has('user_id')? 'is-invalid': null }}" name="user_id" id="_input_user_id">
                <option value="">Please select user</option>
                <option value="<new>">Add new user</option>
                @foreach($users_list as $row)
                <option value="{{ $row->user_id }}" {{ ( (old('user_id') == $row->user_id)? 'selected':null ) }}>{{ $row->first_name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_input_help_user_id">{{ $errors->has('user_id')? $errors->first('user_id'): null }}</div>
        </div>
        @elseif(isset($user_id) && !is_null($user_id))
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        @endif
        <!----- End form field user_id ----->
        
        <!----- Start form field log_id ----->
        @if(!isset($hidden) || (isset($hidden) && !in_array("log_id", $hidden)))
        <div class="form-group">
            <label class="mb-1" for="log_id">Log</label>
            <select class="form-control {{ $errors->has('log_id')? 'is-invalid': null }}" name="log_id" id="_input_log_id">
                <option value="">Please select log</option>
                <option value="<new>">Add new log</option>
                @foreach($logs_list as $row)
                <option value="{{ $row->log_id }}" {{ ( (old('log_id') == $row->log_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_input_help_log_id">{{ $errors->has('log_id')? $errors->first('log_id'): null }}</div>
        </div>
        @elseif(isset($log_id) && !is_null($log_id))
        <input type="hidden" name="log_id" value="{{ $log_id }}">
        @endif
        <!----- End form field log_id ----->
        
        <!----- Start form field datail ----->
        <div class="form-group">
            <label class="mb-1" for="datail">Datail</label>
            <input type="text" class="form-control {{ $errors->has('datail')? 'is-invalid': null }}" name="datail" value="{{ old('datail') }}" placeholder="Datail" id="_input_datail">
            <div class="invalid-feedback" id="_input_help_datail">{{ $errors->has('datail')? $errors->first('datail'): null }}</div>
        </div>
        <!----- End form field datail ----->
        
        <!----- Start form field timestamp ----->
        <div class="form-group">
            <label class="mb-1" for="timestamp">Timestamp</label>
            <input type="text" class="form-control datepicker {{ $errors->has('timestamp')? 'is-invalid': null }}" name="timestamp" value="{{ old('timestamp') }}" placeholder="Timestamp" id="_input_timestamp">
            <div class="invalid-feedback" id="_input_help_timestamp">{{ $errors->has('timestamp')? $errors->first('timestamp'): null }}</div>
        </div>
        <!----- End form field timestamp ----->
        
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 


</script>

