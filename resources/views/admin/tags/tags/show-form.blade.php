 
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
        
            <!----- Start form field name ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Name</label>
                <div class="py-2 col">{{ ($model_info->name)? $model_info->name: '-' }}</div>
            </div>
            <!----- End form field name ----->
        
            <!----- Start form field tag_type_id ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Tag Type</label>
                <div class="form-control col">
                    @if($model_info->tag_type)
                    {{ $model_info->tag_type->name }}
                    @endif
                </div>
            </div>
            <!----- End form field tag_type_id ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-outline-dark mt-4" href="{{ url('admin/tags/tags/show/'.$model_info->tag_id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>