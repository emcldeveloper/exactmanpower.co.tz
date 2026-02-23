 
<form action="{{ url('admin/setting/languages/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
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

        <!----- Start form field locale ----->
        <div class="form-group">
            <label class="mb-1" for="locale">locale</label>
            <input type="text" class="form-control {{ $errors->has('locale')? 'is-invalid': null }}" name="locale" value="{{ old('locale') }}" placeholder="locale" id="_input_name">
            <div class="invalid-feedback" id="_input_help_name">{{ $errors->has('locale')? $errors->first('locale'): null }}</div>
        </div>
        <!----- End form field locale ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {};
if(typeof window.form_children_input_value == 'undefined') window.form_children_input_value = {};
if(typeof window.form_children_input_error == 'undefined') window.form_children_input_error = {};
window.form_children_input_value['insert_item_settings_tags_post_tags_list'] = {!! old('settings_tags_post_tags')? json_encode(old('settings_tags_post_tags')): 'null' !!};
window.form_children_input_error['insert_item_settings_tags_post_tags_list'] = {!! ($errors->get('settings_tags_post_tags.*')? json_encode($errors->get('settings_tags_post_tags.*')): 'null') !!};
window.form_children_input_template['insert_item_settings_tags_post_tags_list'] = function(i, random_id, data, error){ 
    if(!randam_id) {
        randam_id = Math.random().toString().substr(2) + i;
    }
    
    var str = `
        <td>
            <select class="form-control ${ (error && error.post_id)? 'is-invalid': '') }" name="post_tags_list[${random_id}][post_id]" id="_input_post_id_${randam_id}">
                <option value="">Please select post</option>
                <option value="<new>">Add new post</option>
            </select>
        </td>
        <td>
            <select class="form-control ${ (error && error.id)? 'is-invalid': '') }" name="post_tags_list[${random_id}][id]" id="_input_tag_id_${randam_id}">
                <option value="">Please select language</option>
                <option value="<new>">Add new language</option>
            </select>
        </td>
        <td>
            <div class="btn btn-danger btn-delete"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;

    return str;
}


</script>

