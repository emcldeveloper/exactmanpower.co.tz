 
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
        
            <!----- Start form field url ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="url">Url</label>
                <input type="text" class="form-control col {{ $errors->has('url')? 'is-invalid': null }}" name="url" value="{{ $model_info->url }}" placeholder="Url" disabled>
                <div class="invalid-feedback">{{ $errors->has('url')? $errors->first('url'): null }}</div>
            </div>
            <!----- End form field url ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/logs/logs/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>