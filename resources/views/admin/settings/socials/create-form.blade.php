 
<form action="{{ url('admin/settings/socials/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
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
        
        <!----- Start form field icon ----->
        <div class="form-group">
            <label class="font-weight-bold mb-1" for="icon">Icon</label>
            <div class="custom-file {{ $errors->has('icon')? 'is-invalid': null }}">
                <label class="custom-file-label" for="file-icon" data-browse="Bestand kiezen">Browse</label>
                <input name="icon" type="file" class="custom-file-input" id="file-icon">
            </div>
            <div class="invalid-feedback" id="_input_help_icon">{{ $errors->has('icon')? $errors->first('icon'): null }}</div>
        </div>
        <!----- End form field icon ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 
window.form_children_input_template['insert_item_settings_socials_post_socials_list'] = function(i, data){ 
    return `
        <td>
            <select class="form-control {{ $errors->has('post_id')? 'is-invalid': null }}" name="post_socials_list[${i}][post_id]" id="_input_post_id_${i}">
                <option value="">Please select post</option>
                <option value="<new>">Add new post</option>
            </select>
        </td>
        <td>
            <select class="form-control {{ $errors->has('social_id')? 'is-invalid': null }}" name="post_socials_list[${i}][social_id]" id="_input_social_id_${i}">
                <option value="">Please select social</option>
                <option value="<new>">Add new social</option>
            </select>
        </td>
        <td>
            <select class="form-control {{ $errors->has('social_type_id')? 'is-invalid': null }}" name="post_socials_list[${i}][social_type_id]" id="_input_social_type_id_${i}">
                <option value="">Please select social type</option>
                <option value="<new>">Add new social type</option>
            </select>
        </td>
        <td>
            <div class="btn btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;
}


</script>

