 
<style>
.form-view {
    margin-bottom: 0;
    border-bottom: 1px dashed #ced4da;
}

.form-view .form-control {
    border: none;
    background: transparent;
}
</style>

<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="card card-body col-12 col-md-10 m-auto">
        
            <!----- Start form field account_id ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Account</label>
                <div class="py-2 col">{{ ($model_info->account_id)? $model_info->account_id: '-' }}</div>
            </div>
            <!----- End form field account_id ----->
        
            <!----- Start form field user_id ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">User</label>
                <div class="form-control col">
                    @if($model_info->user)
                    {{ $model_info->user->first_name }}
                    @endif
                </div>
            </div>
            <!----- End form field user_id ----->
        
            <!----- Start form field log_id ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Log</label>
                <div class="form-control col">
                    @if($model_info->log)
                    {{ $model_info->log->name }}
                    @endif
                </div>
            </div>
            <!----- End form field log_id ----->
        
            <!----- Start form field datail ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Datail</label>
                <div class="py-2 col">{{ ($model_info->datail)? $model_info->datail: '-' }}</div>
            </div>
            <!----- End form field datail ----->
        
            <!----- Start form field timestamp ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Timestamp</label>
                <div class="py-2 col">{{ ($model_info->timestamp)? $model_info->timestamp: '-' }}</div>
            </div>
            <!----- End form field timestamp ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-outline-dark mt-4" href="{{ url('admin/manage-users/user-logs/show/'.$model_info->user_log_id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>