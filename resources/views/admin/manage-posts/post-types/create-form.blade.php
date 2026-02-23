 
<form action="{{ url('admin/manage-posts/post-types/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
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
        

        <!----- Start form field tag_types_list ----->
        <div class="clearfix mb-3 tag-types-item-container" data-children="manage_posts_post_types_tag_types_list">
            <h5>Tag Types items: </h5>
            <table class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>Post Type</th>
                        <th>Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="item-list">
                    <tr>
                        <td>
                            <select class="form-control {{ $errors->has('post_type_id')? 'is-invalid': null }}" name="tag_types_list[0][post_type_id]" id="_input_post_type_id">
                                <option value="">Please select post type</option>
                                <option value="<new>">Add new post type</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="tag_types_list[0][name]" value="{{ old('tag_types_list.0.name') }}" >
                        </td>
                        <td class="text-right" width="100">
                            <!-- <div class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></div> -->
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="btn btn-outline-dark btn-block add-item"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new line</div>
        </div>
        <!----- End form field tag_types_list ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 
window.form_children_input_template['insert_item_manage_posts_post_types_tag_types_list'] = function(i, data){ 
    return `
        <td>
            <select class="form-control {{ $errors->has('post_type_id')? 'is-invalid': null }}" name="tag_types_list[${i}][post_type_id]" id="_input_post_type_id_${i}">
                <option value="">Please select post type</option>
                <option value="<new>">Add new post type</option>
            </select>
        </td>
        <td>
            <input type="text" class="form-control" name="tag_types_list[${i}][name]" value="${ ((data.name)? data.name:'') }" id="_input_name_${i}">
        </td>
        <td>
            <div class="btn btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;
}


</script>

