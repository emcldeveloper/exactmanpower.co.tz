 
<form action="{{ url('admin/settings/tag-types/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">
        <!----- Start form field post_type_id ----->
        @if(!isset($hidden) || (isset($hidden) && !in_array("post_type_id", $hidden)))
        <div class="form-group">
            <label class="mb-1" for="post_type_id">Post Type</label>
            <select class="form-control {{ $errors->has('post_type_id')? 'is-invalid': null }}" name="post_type_id" id="_input_post_type_id">
                <option value="">Please select post type</option>
                <option value="<new>">Add new post type</option>
                @foreach($post_types_list as $row)
                <option value="{{ $row->post_type_id }}" {{ ( (old('post_type_id') == $row->post_type_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_input_help_post_type_id">{{ $errors->has('post_type_id')? $errors->first('post_type_id'): null }}</div>
        </div>
        @elseif(isset($post_type_id) && !is_null($post_type_id))
        <input type="hidden" name="post_type_id" value="{{ $post_type_id }}">
        @endif
        <!----- End form field post_type_id ----->
        
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ old('name') }}" placeholder="Name" id="_input_name">
            <div class="invalid-feedback" id="_input_help_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
        

        <!----- Start form field post_tags_list ----->
        <div class="clearfix mb-3 post-tags-item-container" data-children="settings_tag_types_post_tags_list">
            <h5>Post Tags items: </h5>
            <table class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>Post</th>
                        <th>Tag</th>
                        <th>Tag Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="item-list">
                    <tr>
                        <td>
                            <select class="form-control {{ $errors->has('post_id')? 'is-invalid': null }}" name="post_tags_list[0][post_id]" id="_input_post_id">
                                <option value="">Please select post</option>
                                <option value="<new>">Add new post</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control {{ $errors->has('tag_id')? 'is-invalid': null }}" name="post_tags_list[0][tag_id]" id="_input_tag_id">
                                <option value="">Please select tag</option>
                                <option value="<new>">Add new tag</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control {{ $errors->has('tag_type_id')? 'is-invalid': null }}" name="post_tags_list[0][tag_type_id]" id="_input_tag_type_id">
                                <option value="">Please select tag type</option>
                                <option value="<new>">Add new tag type</option>
                            </select>
                        </td>
                        <td class="text-right" width="100">
                            <!-- <div class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></div> -->
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="btn btn-outline-dark btn-block add-item"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new line</div>
        </div>
        <!----- End form field post_tags_list ----->

        <!----- Start form field tags_list ----->
        <div class="clearfix mb-3 tags-item-container" data-children="settings_tag_types_tags_list">
            <h5>Tags items: </h5>
            <table class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Tag Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="item-list">
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="tags_list[0][name]" value="{{ old('tags_list.0.name') }}" >
                        </td>
                        <td>
                            <select class="form-control {{ $errors->has('tag_type_id')? 'is-invalid': null }}" name="tags_list[0][tag_type_id]" id="_input_tag_type_id">
                                <option value="">Please select tag type</option>
                                <option value="<new>">Add new tag type</option>
                            </select>
                        </td>
                        <td class="text-right" width="100">
                            <!-- <div class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></div> -->
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="btn btn-outline-dark btn-block add-item"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new line</div>
        </div>
        <!----- End form field tags_list ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 
window.form_children_input_template['insert_item_settings_tag_types_post_tags_list'] = function(i, data){ 
    return `
        <td>
            <select class="form-control {{ $errors->has('post_id')? 'is-invalid': null }}" name="post_tags_list[${i}][post_id]" id="_input_post_id_${i}">
                <option value="">Please select post</option>
                <option value="<new>">Add new post</option>
            </select>
        </td>
        <td>
            <select class="form-control {{ $errors->has('tag_id')? 'is-invalid': null }}" name="post_tags_list[${i}][tag_id]" id="_input_tag_id_${i}">
                <option value="">Please select tag</option>
                <option value="<new>">Add new tag</option>
            </select>
        </td>
        <td>
            <select class="form-control {{ $errors->has('tag_type_id')? 'is-invalid': null }}" name="post_tags_list[${i}][tag_type_id]" id="_input_tag_type_id_${i}">
                <option value="">Please select tag type</option>
                <option value="<new>">Add new tag type</option>
            </select>
        </td>
        <td>
            <div class="btn btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;
}
window.form_children_input_template['insert_item_settings_tag_types_tags_list'] = function(i, data){ 
    return `
        <td>
            <input type="text" class="form-control" name="tags_list[${i}][name]" value="${ ((data.name)? data.name:'') }" id="_input_name_${i}">
        </td>
        <td>
            <select class="form-control {{ $errors->has('tag_type_id')? 'is-invalid': null }}" name="tags_list[${i}][tag_type_id]" id="_input_tag_type_id_${i}">
                <option value="">Please select tag type</option>
                <option value="<new>">Add new tag type</option>
            </select>
        </td>
        <td>
            <div class="btn btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;
}


</script>

