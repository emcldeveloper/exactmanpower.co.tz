 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
            <!----- Start form field name ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="name">Name</label>
                <input type="text" class="form-control col {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" disabled>
                <div class="invalid-feedback">{{ $errors->has('name')? $errors->first('name'): null }}</div>
            </div>
            <!----- End form field name ----->
        
            <!----- Start form field icon ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="icon">Icon</label>
                <div class="custom-file {{ $errors->has('icon')? 'is-invalid': null }}">
                    <label class="custom-file-label" for="file-icon" data-browse="Bestand kiezen">{{ ($model_info->icon)? $model_info->icon: 'Browse' }}</label>
                    <input name="icon" type="file" class="custom-file-input" id="file-icon">
                </div>
                <div class="invalid-feedback" id="_input_help_icon">{{ $errors->has('icon')? $errors->first('icon'): null }}</div>
            </div>
            <!----- End form field icon ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/settings/socials/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>