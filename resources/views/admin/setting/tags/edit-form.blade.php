  
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
<form action="{{ url('admin/setting/tags/update/'.$model_info->tag_id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->

    <div class="clearfix">
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" id="_input_name">
            <div class="invalid-feedback" id="_help_input_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
        <!----- Start form field tag_type_id ----->
        @if(!in_array("tag_type_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="tag_type_id">Tag Type</label>
            <select class="form-control {{ $errors->has('tag_type_id')? 'is-invalid': null }}" name="tag_type_id" id="_input_tag_type_id">
                <option value="">Please select tag type</option>
                <option value="<new>">Add new tag type</option>
                @foreach($tag_types_list as $row)
                <option value="{{ $row->tag_type_id }}" {{ ( ($model_info->tag_type_id == $row->tag_type_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_tag_type_id">{{ $errors->has('tag_type_id')? $errors->first('tag_type_id'): null }}</div>
        </div>
        @endif
        <!----- End form field tag_type_id ----->

        <!----- Start form field post_tags_list ----->
        <div class="clearfix mb-3 post-tags-item-container" data-children="setting_tags_post_tags_list">
            <label class="mb-1" for="name">Post Tags items: </label>
            <table class="table table-borderless table-sm">
                @if(false)
                <thead>
                    <tr>
                        <th>Post</th>
                        <th>Tag Type</th>
                        <th></th>
                    </tr>
                </thead>
                @endif
                <tbody class="item-list">
                </tbody>
            </table>
            <div class="btn btn-outline-dark btn-block add-item"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new line</div>
        </div>
        <!----- End form field post_tags_list ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>


<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {};
if(typeof window.form_children_input_value == 'undefined') window.form_children_input_value = {};
if(typeof window.form_children_input_error == 'undefined') window.form_children_input_error = {};
window.form_children_input_value['insert_item_setting_tags_post_tags_list'] = {!! old('setting_tags_post_tags')? json_encode(old('setting_tags_post_tags')): json_encode($model_info->post_tags) !!};
window.form_children_input_error['insert_item_setting_tags_post_tags_list'] = {!! ($errors->get('setting_tags_post_tags.*')? json_encode($errors->get('setting_tags_post_tags.*')): 'null') !!};
window.form_children_input_template['insert_item_setting_tags_post_tags_list'] = function(i, random_id, data, error){ 
    if(!random_id) {
        random_id = Math.random().toString().substr(2) + i;
    }
    
    var str = `
        <td>
            <select class="form-control ${ ((error && error.post_id)? 'is-invalid': '') }" name="post_tags_list[${random_id}][post_id]" id="_input_post_id_${random_id}">
                <option value="">Please select post</option>
                @if(isset($posts_list))
                @foreach($posts_list as $key => $item)
                <option value="{{ $item->post_id }}" ${ ((data.post_id == '{{ $item->post_id }}')? 'selected':'') }>{{ $item->name }}</option>
                @endforeach
                @endif
            </select>
        </td>
        <td>
            <select class="form-control ${ ((error && error.tag_type_id)? 'is-invalid': '') }" name="post_tags_list[${random_id}][tag_type_id]" id="_input_tag_type_id_${random_id}">
                <option value="">Please select tag type</option>
                @if(isset($tag_types_list))
                @foreach($tag_types_list as $key => $item)
                <option value="{{ $item->tag_type_id }}" ${ ((data.tag_type_id == '{{ $item->tag_type_id }}')? 'selected':'') }>{{ $item->name }}</option>
                @endforeach
                @endif
            </select>
        </td>
        <td class="text-right" width="100">
            <input type="hidden" name="post_tags_list[${random_id}][post_tag_id]" value="${ ((data.post_tag_id != null)? data.post_tag_id:'') }">
            <div class="btn btn-danger btn-delete btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;

    return str;
}
</script>