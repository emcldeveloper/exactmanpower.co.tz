 
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
        
            <!----- Start form field icon_url ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="icon_url">Icon Url</label>
                <div class="col">
                    <img style="width:30px;" class=" mr-2" src="{{ $model_info->get_icon_url() }}">
                </div>
                <div class="invalid-feedback">{{ $errors->has('icon_url')? $errors->first('icon_url'): null }}</div>
            </div>
            <!----- End form field icon_url ----->
        
            <!----- Start form field image_url ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="image_url">Image Url</label>
                <div class="col">
                    <img style="height:50px;" class=" mr-2" src="{{ $model_info->get_image_url() }}">
                </div>
                <div class="invalid-feedback">{{ $errors->has('image_url')? $errors->first('image_url'): null }}</div>
            </div>
            <!----- End form field image_url ----->
        
            <!----- Start form field is_group ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="is_group">Is Group</label>
                <div class="clearfix col">
                    <div class="custom-control custom-switch {{ $errors->has('is_group')? 'is-invalid': null }}">
                        <input type="checkbox" class="custom-control-input" id="is_group" name="is_group" {{ ($model_info->is_group)? 'checked':null }} disabled>
                        <label class="custom-control-label" for="is_group">Please check if is group</label>
                    </div>
                </div>
                <div class="invalid-feedback">{{ $errors->has('is_group')? $errors->first('is_group'): null }}</div>
            </div>
            <!----- End form field is_group ----->
        
            <!----- Start form field is_stared ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="is_stared">Is Stared</label>
                <div class="clearfix col">
                    <div class="custom-control custom-switch {{ $errors->has('is_stared')? 'is-invalid': null }}">
                        <input type="checkbox" class="custom-control-input" id="is_stared" name="is_stared" {{ ($model_info->is_stared)? 'checked':null }} disabled>
                        <label class="custom-control-label" for="is_stared">Please check if is stared</label>
                    </div>
                </div>
                <div class="invalid-feedback">{{ $errors->has('is_stared')? $errors->first('is_stared'): null }}</div>
            </div>
            <!----- End form field is_stared ----->
        
            <!----- Start form field parent_category_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="parent_category_id">Parent Category</label>
                <select class="form-control col {{ $errors->has('parent_category_id')? 'is-invalid': null }}" name="parent_category_id" disabled>
                    <option value="">Please select parent category</option>
                    <option value="<new>">Add new parent category</option>
                    @foreach($categories_list as $row)
                    <option value="{{ $row->category_id }}" {{ ( ($model_info->parent_category_id == $row->category_id)? 'selected':null ) }}>{{ $row->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('parent_category_id')? $errors->first('parent_category_id'): null }}</div>
            </div>
            <!----- End form field parent_category_id ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url($route.'/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>