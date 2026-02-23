 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
            <!----- Start form field post_type_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="post_type_id">Post Type</label>
                <select class="form-control col {{ $errors->has('post_type_id')? 'is-invalid': null }}" name="post_type_id" disabled>
                    <option value="">Please select post type</option>
                    <option value="<new>">Add new post type</option>
                    @foreach($post_types_list as $row)
                    <option value="{{ $row->post_type_id }}" {{ ( ($model_info->post_type_id == $row->post_type_id)? 'selected':null ) }}>{{ $row->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('post_type_id')? $errors->first('post_type_id'): null }}</div>
            </div>
            <!----- End form field post_type_id ----->
        
            <!----- Start form field name ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="name">Name</label>
                <input type="text" class="form-control col {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" disabled>
                <div class="invalid-feedback">{{ $errors->has('name')? $errors->first('name'): null }}</div>
            </div>
            <!----- End form field name ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/settings/tag-types/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>