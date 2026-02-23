 
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
        
            <!----- Start form field parent_location_id ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Parent Location</label>
                <div class="form-control col">
                    @if($model_info->location)
                    {{ $model_info->location->name }}
                    @endif
                </div>
            </div>
            <!----- End form field parent_location_id ----->
        
            <!----- Start form field type ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Type</label>
                <div class="form-control col">
                    @if($model_info->type == 0)
                        Type Zero
                    @elseif($model_info->type == 1)
                        Type One
                    @elseif($model_info->type == 2)
                        Type Two
                    @endif
                </div>
            </div>
            <!----- End form field type ----->
        
            <!----- Start form field latitude ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Latitude</label>
                <div class="py-2 col">{{ ($model_info->latitude)? $model_info->latitude: '-' }}</div>
            </div>
            <!----- End form field latitude ----->
        
            <!----- Start form field longitude ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Longitude</label>
                <div class="py-2 col">{{ ($model_info->longitude)? $model_info->longitude: '-' }}</div>
            </div>
            <!----- End form field longitude ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-outline-dark mt-4" href="{{ url('admin/setting/locations/show/'.$model_info->location_id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>