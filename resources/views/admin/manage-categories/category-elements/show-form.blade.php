 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
            <!----- Start form field category_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="category_id">Category</label>
                <select class="form-control col {{ $errors->has('category_id')? 'is-invalid': null }}" name="category_id" disabled>
                    <option value="">Please select category</option>
                    <option value="<new>">Add new category</option>
                    @foreach($categories_list as $row)
                    <option value="{{ $row->category_id }}" {{ ( ($model_info->category_id == $row->category_id)? 'selected':null ) }}>{{ $row->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('category_id')? $errors->first('category_id'): null }}</div>
            </div>
            <!----- End form field category_id ----->
        
            <!----- Start form field name ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="name">Name</label>
                <input type="text" class="form-control col {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" disabled>
                <div class="invalid-feedback">{{ $errors->has('name')? $errors->first('name'): null }}</div>
            </div>
            <!----- End form field name ----->
        
            <!----- Start form field title ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="title">Title</label>
                <input type="text" class="form-control col {{ $errors->has('title')? 'is-invalid': null }}" name="title" value="{{ $model_info->title }}" placeholder="Title" disabled>
                <div class="invalid-feedback">{{ $errors->has('title')? $errors->first('title'): null }}</div>
            </div>
            <!----- End form field title ----->
        
            <!----- Start form field sub_title ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="sub_title">Sub Title</label>
                <input type="text" class="form-control col {{ $errors->has('sub_title')? 'is-invalid': null }}" name="sub_title" value="{{ $model_info->sub_title }}" placeholder="Sub Title" disabled>
                <div class="invalid-feedback">{{ $errors->has('sub_title')? $errors->first('sub_title'): null }}</div>
            </div>
            <!----- End form field sub_title ----->
        
            <!----- Start form field info_message ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="info_message">Info Message</label>
                <input type="text" class="form-control col {{ $errors->has('info_message')? 'is-invalid': null }}" name="info_message" value="{{ $model_info->info_message }}" placeholder="Info Message" disabled>
                <div class="invalid-feedback">{{ $errors->has('info_message')? $errors->first('info_message'): null }}</div>
            </div>
            <!----- End form field info_message ----->
        
            <!----- Start form field error_message ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="error_message">Error Message</label>
                <input type="text" class="form-control col {{ $errors->has('error_message')? 'is-invalid': null }}" name="error_message" value="{{ $model_info->error_message }}" placeholder="Error Message" disabled>
                <div class="invalid-feedback">{{ $errors->has('error_message')? $errors->first('error_message'): null }}</div>
            </div>
            <!----- End form field error_message ----->
        
            <!----- Start form field success_message ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="success_message">Success Message</label>
                <input type="text" class="form-control col {{ $errors->has('success_message')? 'is-invalid': null }}" name="success_message" value="{{ $model_info->success_message }}" placeholder="Success Message" disabled>
                <div class="invalid-feedback">{{ $errors->has('success_message')? $errors->first('success_message'): null }}</div>
            </div>
            <!----- End form field success_message ----->
        
            <!----- Start form field warning_message ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="warning_message">Warning Message</label>
                <input type="text" class="form-control col {{ $errors->has('warning_message')? 'is-invalid': null }}" name="warning_message" value="{{ $model_info->warning_message }}" placeholder="Warning Message" disabled>
                <div class="invalid-feedback">{{ $errors->has('warning_message')? $errors->first('warning_message'): null }}</div>
            </div>
            <!----- End form field warning_message ----->
        
            <!----- Start form field input_type ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="input_type">Input Type</label>
                <input type="text" class="form-control col {{ $errors->has('input_type')? 'is-invalid': null }}" name="input_type" value="{{ $model_info->input_type }}" placeholder="Input Type" disabled>
                <div class="invalid-feedback">{{ $errors->has('input_type')? $errors->first('input_type'): null }}</div>
            </div>
            <!----- End form field input_type ----->
        
            <!----- Start form field content_type ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="content_type">Content Type</label>
                <input type="text" class="form-control col {{ $errors->has('content_type')? 'is-invalid': null }}" name="content_type" value="{{ $model_info->content_type }}" placeholder="Content Type" disabled>
                <div class="invalid-feedback">{{ $errors->has('content_type')? $errors->first('content_type'): null }}</div>
            </div>
            <!----- End form field content_type ----->
        
            <!----- Start form field default_value ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="default_value">Default Value</label>
                <input type="text" class="form-control col {{ $errors->has('default_value')? 'is-invalid': null }}" name="default_value" value="{{ $model_info->default_value }}" placeholder="Default Value" disabled>
                <div class="invalid-feedback">{{ $errors->has('default_value')? $errors->first('default_value'): null }}</div>
            </div>
            <!----- End form field default_value ----->
        
            <!----- Start form field minimum ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="minimum">Minimum</label>
                <input type="text" class="form-control col {{ $errors->has('minimum')? 'is-invalid': null }}" name="minimum" value="{{ $model_info->minimum }}" placeholder="Minimum" disabled>
                <div class="invalid-feedback">{{ $errors->has('minimum')? $errors->first('minimum'): null }}</div>
            </div>
            <!----- End form field minimum ----->
        
            <!----- Start form field maximum ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="maximum">Maximum</label>
                <input type="text" class="form-control col {{ $errors->has('maximum')? 'is-invalid': null }}" name="maximum" value="{{ $model_info->maximum }}" placeholder="Maximum" disabled>
                <div class="invalid-feedback">{{ $errors->has('maximum')? $errors->first('maximum'): null }}</div>
            </div>
            <!----- End form field maximum ----->
        
            <!----- Start form field length ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="length">Length</label>
                <input type="text" class="form-control col {{ $errors->has('length')? 'is-invalid': null }}" name="length" value="{{ $model_info->length }}" placeholder="Length" disabled>
                <div class="invalid-feedback">{{ $errors->has('length')? $errors->first('length'): null }}</div>
            </div>
            <!----- End form field length ----->
        
            <!----- Start form field is_multiple ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="is_multiple">Is Multiple</label>
                <div class="clearfix col">
                    <div class="custom-control custom-switch {{ $errors->has('is_multiple')? 'is-invalid': null }}">
                        <input type="checkbox" class="custom-control-input" id="is_multiple" name="is_multiple" {{ ($model_info->is_multiple)? 'checked':null }} disabled>
                        <label class="custom-control-label" for="is_multiple">Please check if is multiple</label>
                    </div>
                </div>
                <div class="invalid-feedback">{{ $errors->has('is_multiple')? $errors->first('is_multiple'): null }}</div>
            </div>
            <!----- End form field is_multiple ----->
        
            <!----- Start form field is_mandatory ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="is_mandatory">Is Mandatory</label>
                <div class="clearfix col">
                    <div class="custom-control custom-switch {{ $errors->has('is_mandatory')? 'is-invalid': null }}">
                        <input type="checkbox" class="custom-control-input" id="is_mandatory" name="is_mandatory" {{ ($model_info->is_mandatory)? 'checked':null }} disabled>
                        <label class="custom-control-label" for="is_mandatory">Please check if is mandatory</label>
                    </div>
                </div>
                <div class="invalid-feedback">{{ $errors->has('is_mandatory')? $errors->first('is_mandatory'): null }}</div>
            </div>
            <!----- End form field is_mandatory ----->
        
            <!----- Start form field created_at ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="created_at">Created Time</label>
                <input type="text" class="form-control col {{ $errors->has('created_at')? 'is-invalid': null }}" name="created_at" value="{{ $model_info->created_at }}" placeholder="Created Time" disabled>
                <div class="invalid-feedback">{{ $errors->has('created_at')? $errors->first('created_at'): null }}</div>
            </div>
            <!----- End form field created_at ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/manage-categories/category-elements/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>