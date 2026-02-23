 
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
        
            <!----- Start form field tag_type_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="tag_type_id">Tag Type</label>
                <select class="form-control col {{ $errors->has('tag_type_id')? 'is-invalid': null }}" name="tag_type_id" disabled>
                    <option value="">Please select tag type</option>
                    <option value="<new>">Add new tag type</option>
                    @foreach($tag_types_list as $row)
                    <option value="{{ $row->tag_type_id }}" {{ ( ($model_info->tag_type_id == $row->tag_type_id)? 'selected':null ) }}>{{ $row->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('tag_type_id')? $errors->first('tag_type_id'): null }}</div>
            </div>
            <!----- End form field tag_type_id ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/settings/tags/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>