 
<style>
.item-list td,
.item-list th {
    padding-top:3px;
    padding-bottom:3px;
    padding-left:0px;
}

.item-list .form-control {
    background: none;
    border-color: transparent;
    border-bottom-color: gainsboro;
}
</style>
<form action="{{ url('admin/posts/post-types/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
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
        

        <!----- Start form field metas_list ----->
        <div class="clearfix mb-3 metas-item-container" data-children="posts_post_types_metas_list">
            <label class="mb-1" for="name">Metas items: </label>
            <table class="table table-borderless table-sm">
                @if(false)
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Input Type</th>
                        <th>Multiple</th>
                        <th>Options</th>
                        <th>Linked Type</th>
                        <th></th>
                    </tr>
                </thead>
                @endif
                <tbody class="item-list">
                </tbody>
            </table>
            <div class="btn btn-outline-dark btn-block add-item"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new line</div>
        </div>
        <!----- End form field metas_list ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {};
if(typeof window.form_children_input_value == 'undefined') window.form_children_input_value = {};
if(typeof window.form_children_input_error == 'undefined') window.form_children_input_error = {};
    
window.form_children_input_value['insert_item_posts_post_types_metas_list'] = {!! old('posts_post_types_metas')? json_encode(old('posts_post_types_metas')): '[{}]' !!};
window.form_children_input_error['insert_item_posts_post_types_metas_list'] = {!! ($errors->get('posts_post_types_metas.*')? json_encode($errors->get('posts_post_types_metas.*')): 'null') !!};
window.form_children_input_template['insert_item_posts_post_types_metas_list'] = function(i, random_id, data, error){ 
    if(!random_id) {
        random_id = Math.random().toString().substr(2) + i;
    }
    
    var str = `
        <td>
            <input type="text" class="form-control ${ ((error && error.name)? 'is-invalid': '') }" name="metas_list[${random_id}][name]" value="${ ((data.name != null)? data.name:'') }" id="_input_name_${random_id}" placeholder="Name">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.input_type)? 'is-invalid': '') }" name="metas_list[${random_id}][input_type]" value="${ ((data.input_type != null)? data.input_type:'') }" id="_input_input_type_${random_id}" placeholder="Input Type">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.multiple)? 'is-invalid': '') }" name="metas_list[${random_id}][multiple]" value="${ ((data.multiple != null)? data.multiple:'') }" id="_input_multiple_${random_id}" placeholder="Multiple">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.options)? 'is-invalid': '') }" name="metas_list[${random_id}][options]" value="${ ((data.options != null)? data.options:'') }" id="_input_options_${random_id}" placeholder="Options">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.linked_type_id)? 'is-invalid': '') }" name="metas_list[${random_id}][linked_type_id]" value="${ ((data.linked_type_id != null)? data.linked_type_id:'') }" id="_input_linked_type_id_${random_id}" placeholder="Linked Type">
        </td>
        <td class="text-right" width="100">
            <input type="hidden" name="metas_list[${random_id}][meta_id]" value="${ ((data.meta_id != null)? data.meta_id:'') }">
            <div class="btn btn-danger btn-delete btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;

    return str;
}


</script>

