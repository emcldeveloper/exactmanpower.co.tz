 
<form action="{{ url('admin/settings/tags/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ old('name') }}" placeholder="Name" id="_input_name">
            <div class="invalid-feedback" id="_input_help_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
        
        <!----- Start form field tag_type_id ----->
        @if(!isset($hidden) || (isset($hidden) && !in_array("tag_type_id", $hidden)))
        <div class="form-group">
            <label class="mb-1" for="tag_type_id">Tag Type</label>
            <select class="form-control {{ $errors->has('tag_type_id')? 'is-invalid': null }}" name="tag_type_id" id="_input_tag_type_id">
                <option value="">Please select tag type</option>
                <option value="<new>">Add new tag type</option>
                @foreach($tag_types_list as $row)
                <option value="{{ $row->tag_type_id }}" {{ ( (old('tag_type_id') == $row->tag_type_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_input_help_tag_type_id">{{ $errors->has('tag_type_id')? $errors->first('tag_type_id'): null }}</div>
        </div>
        @elseif(isset($tag_type_id) && !is_null($tag_type_id))
        <input type="hidden" name="tag_type_id" value="{{ $tag_type_id }}">
        @endif
        <!----- End form field tag_type_id ----->
        

        <!----- Start form field post_tags_list ----->
        <div class="clearfix mb-3 post-tags-item-container" data-children="settings_tags_post_tags_list">
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
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 
window.form_children_input_template['insert_item_settings_tags_post_tags_list'] = function(i, data){ 
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


</script>

