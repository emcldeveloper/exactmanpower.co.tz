 
<form action="{{ url('admin/manage-categories/category-elements/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">
        <!----- Start form field category_id ----->
        @if(!isset($hidden) || (isset($hidden) && !in_array("category_id", $hidden)))
        <div class="form-group">
            <label class="mb-1" for="category_id">Category</label>
            <select class="form-control {{ $errors->has('category_id')? 'is-invalid': null }}" name="category_id" id="_input_category_id">
                <option value="">Please select category</option>
                <option value="<new>">Add new category</option>
                @foreach($categories_list as $row)
                <option value="{{ $row->category_id }}" {{ ( (old('category_id') == $row->category_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_input_help_category_id">{{ $errors->has('category_id')? $errors->first('category_id'): null }}</div>
        </div>
        @elseif(isset($category_id) && !is_null($category_id))
        <input type="hidden" name="category_id" value="{{ $category_id }}">
        @endif
        <!----- End form field category_id ----->
        
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ old('name') }}" placeholder="Name" id="_input_name">
            <div class="invalid-feedback" id="_input_help_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
        
        <!----- Start form field title ----->
        <div class="form-group">
            <label class="mb-1" for="title">Title</label>
            <input type="text" class="form-control {{ $errors->has('title')? 'is-invalid': null }}" name="title" value="{{ old('title') }}" placeholder="Title" id="_input_title">
            <div class="invalid-feedback" id="_input_help_title">{{ $errors->has('title')? $errors->first('title'): null }}</div>
        </div>
        <!----- End form field title ----->
        
        <!----- Start form field sub_title ----->
        <div class="form-group">
            <label class="mb-1" for="sub_title">Sub Title</label>
            <input type="text" class="form-control {{ $errors->has('sub_title')? 'is-invalid': null }}" name="sub_title" value="{{ old('sub_title') }}" placeholder="Sub Title" id="_input_sub_title">
            <div class="invalid-feedback" id="_input_help_sub_title">{{ $errors->has('sub_title')? $errors->first('sub_title'): null }}</div>
        </div>
        <!----- End form field sub_title ----->
        
        <!----- Start form field info_message ----->
        <div class="form-group">
            <label class="mb-1" for="info_message">Info Message</label>
            <input type="text" class="form-control {{ $errors->has('info_message')? 'is-invalid': null }}" name="info_message" value="{{ old('info_message') }}" placeholder="Info Message" id="_input_info_message">
            <div class="invalid-feedback" id="_input_help_info_message">{{ $errors->has('info_message')? $errors->first('info_message'): null }}</div>
        </div>
        <!----- End form field info_message ----->
        
        <!----- Start form field error_message ----->
        <div class="form-group">
            <label class="mb-1" for="error_message">Error Message</label>
            <input type="text" class="form-control {{ $errors->has('error_message')? 'is-invalid': null }}" name="error_message" value="{{ old('error_message') }}" placeholder="Error Message" id="_input_error_message">
            <div class="invalid-feedback" id="_input_help_error_message">{{ $errors->has('error_message')? $errors->first('error_message'): null }}</div>
        </div>
        <!----- End form field error_message ----->
        
        <!----- Start form field success_message ----->
        <div class="form-group">
            <label class="mb-1" for="success_message">Success Message</label>
            <input type="text" class="form-control {{ $errors->has('success_message')? 'is-invalid': null }}" name="success_message" value="{{ old('success_message') }}" placeholder="Success Message" id="_input_success_message">
            <div class="invalid-feedback" id="_input_help_success_message">{{ $errors->has('success_message')? $errors->first('success_message'): null }}</div>
        </div>
        <!----- End form field success_message ----->
        
        <!----- Start form field warning_message ----->
        <div class="form-group">
            <label class="mb-1" for="warning_message">Warning Message</label>
            <input type="text" class="form-control {{ $errors->has('warning_message')? 'is-invalid': null }}" name="warning_message" value="{{ old('warning_message') }}" placeholder="Warning Message" id="_input_warning_message">
            <div class="invalid-feedback" id="_input_help_warning_message">{{ $errors->has('warning_message')? $errors->first('warning_message'): null }}</div>
        </div>
        <!----- End form field warning_message ----->
        
        <!----- Start form field input_type ----->
        <div class="form-group">
            <label class="mb-1" for="input_type">Input Type</label>
            <input type="text" class="form-control {{ $errors->has('input_type')? 'is-invalid': null }}" name="input_type" value="{{ old('input_type') }}" placeholder="Input Type" id="_input_input_type">
            <div class="invalid-feedback" id="_input_help_input_type">{{ $errors->has('input_type')? $errors->first('input_type'): null }}</div>
        </div>
        <!----- End form field input_type ----->
        
        <!----- Start form field content_type ----->
        <div class="form-group">
            <label class="mb-1" for="content_type">Content Type</label>
            <input type="text" class="form-control {{ $errors->has('content_type')? 'is-invalid': null }}" name="content_type" value="{{ old('content_type') }}" placeholder="Content Type" id="_input_content_type">
            <div class="invalid-feedback" id="_input_help_content_type">{{ $errors->has('content_type')? $errors->first('content_type'): null }}</div>
        </div>
        <!----- End form field content_type ----->
        
        <!----- Start form field default_value ----->
        <div class="form-group">
            <label class="mb-1" for="default_value">Default Value</label>
            <input type="text" class="form-control {{ $errors->has('default_value')? 'is-invalid': null }}" name="default_value" value="{{ old('default_value') }}" placeholder="Default Value" id="_input_default_value">
            <div class="invalid-feedback" id="_input_help_default_value">{{ $errors->has('default_value')? $errors->first('default_value'): null }}</div>
        </div>
        <!----- End form field default_value ----->
        
        <!----- Start form field minimum ----->
        <div class="form-group">
            <label class="mb-1" for="minimum">Minimum</label>
            <input type="text" class="form-control {{ $errors->has('minimum')? 'is-invalid': null }}" name="minimum" value="{{ old('minimum') }}" placeholder="Minimum" id="_input_minimum">
            <div class="invalid-feedback" id="_input_help_minimum">{{ $errors->has('minimum')? $errors->first('minimum'): null }}</div>
        </div>
        <!----- End form field minimum ----->
        
        <!----- Start form field maximum ----->
        <div class="form-group">
            <label class="mb-1" for="maximum">Maximum</label>
            <input type="text" class="form-control {{ $errors->has('maximum')? 'is-invalid': null }}" name="maximum" value="{{ old('maximum') }}" placeholder="Maximum" id="_input_maximum">
            <div class="invalid-feedback" id="_input_help_maximum">{{ $errors->has('maximum')? $errors->first('maximum'): null }}</div>
        </div>
        <!----- End form field maximum ----->
        
        <!----- Start form field length ----->
        <div class="form-group">
            <label class="mb-1" for="length">Length</label>
            <input type="text" class="form-control {{ $errors->has('length')? 'is-invalid': null }}" name="length" value="{{ old('length') }}" placeholder="Length" id="_input_length">
            <div class="invalid-feedback" id="_input_help_length">{{ $errors->has('length')? $errors->first('length'): null }}</div>
        </div>
        <!----- End form field length ----->
        
        <!----- Start form field is_multiple ----->
        <div class="form-group">
            <label class="mb-1" for="is_multiple">Is Multiple</label>
            <div class="custom-control custom-switch {{ $errors->has('is_multiple')? 'is-invalid': null }}">
                <input type="checkbox" class="custom-control-input" id="is_multiple" name="is_multiple" id="_input_is_multiple" {{ old('is_multiple')? 'checked':null }}>
                <label class="custom-control-label" for="is_multiple">Please check if is multiple</label>
            </div>
            <div class="invalid-feedback" id="_input_help_is_multiple">{{ $errors->has('is_multiple')? $errors->first('is_multiple'): null }}</div>
        </div>
        <!----- End form field is_multiple ----->
        
        <!----- Start form field is_mandatory ----->
        <div class="form-group">
            <label class="mb-1" for="is_mandatory">Is Mandatory</label>
            <div class="custom-control custom-switch {{ $errors->has('is_mandatory')? 'is-invalid': null }}">
                <input type="checkbox" class="custom-control-input" id="is_mandatory" name="is_mandatory" id="_input_is_mandatory" {{ old('is_mandatory')? 'checked':null }}>
                <label class="custom-control-label" for="is_mandatory">Please check if is mandatory</label>
            </div>
            <div class="invalid-feedback" id="_input_help_is_mandatory">{{ $errors->has('is_mandatory')? $errors->first('is_mandatory'): null }}</div>
        </div>
        <!----- End form field is_mandatory ----->
        

        <!----- Start form field category_element_options_list ----->
        <div class="clearfix mb-3 category-element-options-item-container" data-children="manage_categories_category_elements_category_element_options_list">
            <h5>Category Element Options items: </h5>
            <table class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>Category Element</th>
                        <th>Label</th>
                        <th>Source Category Form</th>
                        <th>Source Category Element</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="item-list">
                    <tr>
                        <td>
                            <select class="form-control {{ $errors->has('category_element_id')? 'is-invalid': null }}" name="category_element_options_list[0][category_element_id]" id="_input_category_element_id">
                                <option value="">Please select category element</option>
                                <option value="<new>">Add new category element</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="category_element_options_list[0][label]" value="{{ old('category_element_options_list.0.label') }}" >
                        </td>
                        <td>
                            <input type="text" class="form-control" name="category_element_options_list[0][source_category_form_id]" value="{{ old('category_element_options_list.0.source_category_form_id') }}" >
                        </td>
                        <td>
                            <input type="text" class="form-control" name="category_element_options_list[0][source_category_element_id]" value="{{ old('category_element_options_list.0.source_category_element_id') }}" >
                        </td>
                        <td class="text-right" width="100">
                            <!-- <div class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></div> -->
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="btn btn-outline-dark btn-block add-item"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new line</div>
        </div>
        <!----- End form field category_element_options_list ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 
window.form_children_input_template['insert_item_manage_categories_category_elements_category_element_options_list'] = function(i, data){ 
    return `
        <td>
            <select class="form-control {{ $errors->has('category_element_id')? 'is-invalid': null }}" name="category_element_options_list[${i}][category_element_id]" id="_input_category_element_id_${i}">
                <option value="">Please select category element</option>
                <option value="<new>">Add new category element</option>
            </select>
        </td>
        <td>
            <input type="text" class="form-control" name="category_element_options_list[${i}][label]" value="${ ((data.label)? data.label:'') }" id="_input_label_${i}">
        </td>
        <td>
            <input type="text" class="form-control" name="category_element_options_list[${i}][source_category_form_id]" value="${ ((data.source_category_form_id)? data.source_category_form_id:'') }" id="_input_source_category_form_id_${i}">
        </td>
        <td>
            <input type="text" class="form-control" name="category_element_options_list[${i}][source_category_element_id]" value="${ ((data.source_category_element_id)? data.source_category_element_id:'') }" id="_input_source_category_element_id_${i}">
        </td>
        <td>
            <div class="btn btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;
}


</script>

