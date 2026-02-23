 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
            <!----- Start form field account_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="account_id">Account</label>
                <select class="form-control col {{ $errors->has('account_id')? 'is-invalid': null }}" name="account_id" disabled>
                    <option value="">Please select account</option>
                    <option value="<new>">Add new account</option>
                    @foreach($accounts_list as $row)
                    <option value="{{ $row->account_id }}" {{ ( ($model_info->account_id == $row->account_id)? 'selected':null ) }}>{{ $row->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('account_id')? $errors->first('account_id'): null }}</div>
            </div>
            <!----- End form field account_id ----->
        
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
        
            <!----- Start form field log_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="log_id">Log</label>
                <select class="form-control col {{ $errors->has('log_id')? 'is-invalid': null }}" name="log_id" disabled>
                    <option value="">Please select log</option>
                    <option value="<new>">Add new log</option>
                    @foreach($logs_list as $row)
                    <option value="{{ $row->log_id }}" {{ ( ($model_info->log_id == $row->log_id)? 'selected':null ) }}>{{ $row->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('log_id')? $errors->first('log_id'): null }}</div>
            </div>
            <!----- End form field log_id ----->
        
            <!----- Start form field datail ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="datail">Datail</label>
                <input type="text" class="form-control col {{ $errors->has('datail')? 'is-invalid': null }}" name="datail" value="{{ $model_info->datail }}" placeholder="Datail" disabled>
                <div class="invalid-feedback">{{ $errors->has('datail')? $errors->first('datail'): null }}</div>
            </div>
            <!----- End form field datail ----->
        
            <!----- Start form field timestamp ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="timestamp">Timestamp</label>
                <input type="text" class="form-control col datepicker {{ $errors->has('timestamp')? 'is-invalid': null }}" name="timestamp" value="{{ $model_info->timestamp }}" placeholder="Timestamp" disabled>
                <div class="invalid-feedback">{{ $errors->has('timestamp')? $errors->first('timestamp'): null }}</div>
            </div>
            <!----- End form field timestamp ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/logs/user-logs/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>