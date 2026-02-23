 
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
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/manage-posts/post-types/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>