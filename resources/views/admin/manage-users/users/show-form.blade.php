 
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
        
            <!----- Start form field first_name ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">First Name</label>
                <div class="py-2 col">{{ ($model_info->first_name)? $model_info->first_name: '-' }}</div>
            </div>
            <!----- End form field first_name ----->
        
            <!----- Start form field second_name ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Second Name</label>
                <div class="py-2 col">{{ ($model_info->second_name)? $model_info->second_name: '-' }}</div>
            </div>
            <!----- End form field second_name ----->
        
            <!----- Start form field last_name ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Last Name</label>
                <div class="py-2 col">{{ ($model_info->last_name)? $model_info->last_name: '-' }}</div>
            </div>
            <!----- End form field last_name ----->
        
            <!----- Start form field username ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Username</label>
                <div class="py-2 col">{{ ($model_info->username)? $model_info->username: '-' }}</div>
            </div>
            <!----- End form field username ----->
        
            <!----- Start form field social_name ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Social Name</label>
                <div class="py-2 col">{{ ($model_info->social_name)? $model_info->social_name: '-' }}</div>
            </div>
            <!----- End form field social_name ----->
        
            <!----- Start form field social_id ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Social</label>
                <div class="py-2 col">{{ ($model_info->social_id)? $model_info->social_id: '-' }}</div>
            </div>
            <!----- End form field social_id ----->
        
            <!----- Start form field email ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Email</label>
                <div class="py-2 col">{{ ($model_info->email)? $model_info->email: '-' }}</div>
            </div>
            <!----- End form field email ----->
        
            <!----- Start form field phone ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Phone</label>
                <div class="py-2 col">{{ ($model_info->phone)? $model_info->phone: '-' }}</div>
            </div>
            <!----- End form field phone ----->
        
            <!----- Start form field password ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Password</label>
                <div class="py-2 col">{{ ($model_info->password)? $model_info->password: '-' }}</div>
            </div>
            <!----- End form field password ----->
        
            <!----- Start form field role ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Role</label>
                <div class="clearfix col">
                    @if($model_info->role == 1)
                        Super admin
                    @elseif($model_info->role == 2)
                        Admin
                    @elseif($model_info->role == 3)
                        Member
                    @endif
                </div>
            </div>
            <!----- End form field role ----->
        
            <!----- Start form field profile_url ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Profile Url</label>
                <label class="form-control col">
                    @if($model_info->profile_url && trim($model_info->profile_url) != "")
                    <a class="text-primary font-weight-bold" hre="javascript:;">Download file</a>
                    @else
                    <span class="text-danger">Not uploaded</span>
                    @endif
                </label>
            </div>
            <!----- End form field profile_url ----->
        
            <!----- Start form field status ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Status</label>
                <div class="clearfix col">
                    @if($model_info->status == 0)
                        Active
                    @elseif($model_info->status == 1)
                        Inactive
                    @elseif($model_info->status == 2)
                        Banned
                    @endif
                </div>
            </div>
            <!----- End form field status ----->
        
            <!----- Start form field created_at ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Created Time</label>
                <div class="py-2 col">{{ ($model_info->created_at)? $model_info->created_at: '-' }}</div>
            </div>
            <!----- End form field created_at ----->
        
            <!----- Start form field updated_at ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Updated Time</label>
                <div class="py-2 col">{{ ($model_info->updated_at)? $model_info->updated_at: '-' }}</div>
            </div>
            <!----- End form field updated_at ----->
        
            <!----- Start form field email_verified_at ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Email Verified Time</label>
                <div class="py-2 col">{{ ($model_info->email_verified_at)? $model_info->email_verified_at: '-' }}</div>
            </div>
            <!----- End form field email_verified_at ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-outline-dark mt-4" href="{{ url('admin/manage-users/users/show/'.$model_info->user_id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>