  
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
<form action="{{ url('admin/posts/posts/update/'.$model_info->post_id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->

    <div class="clearfix">
        <div class="row">
            <div class="col-8">
                <!----- Start form field post_title ----->
                <div class="form-group">
                    <label class="mb-1" for="post_title">Post Title</label>
                    <input type="text" class="form-control {{ $errors->has('post_title')? 'is-invalid': null }}" name="post_title" value="{{ $model_info->post_title }}" placeholder="Post Title" id="_input_post_title">
                    <div class="invalid-feedback" id="_help_input_post_title">{{ $errors->has('post_title')? $errors->first('post_title'): null }}</div>
                </div>
                <!----- End form field post_title ----->
            </div>
            <div class="col-4">
                <!----- Start form field post_type_id ----->
                @if(!request('post_type_id'))
                <div class="form-group">
                    <label class="mb-1" for="post_type_id">Post Type</label>
                    <select class="form-control {{ $errors->has('post_type_id')? 'is-invalid': null }}" name="post_type_id" id="_input_post_type_id">
                        <option value="">Please select post type</option>
                        <option value="<new>">Add new post type</option>
                        @foreach($post_types_list as $row)
                        <option value="{{ $row->post_type_id }}" {{ ( ($model_info->post_type_id == $row->post_type_id)? 'selected':null ) }}>{{ $row->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" id="_help_input_post_type_id">{{ $errors->has('post_type_id')? $errors->first('post_type_id'): null }}</div>
                </div>
                @endif
                <!----- End form field post_type_id ----->
            </div>
        </div>
        
        <!----- Start form field post_content ----->
        <div class="form-group">
            <label class="mb-1" for="post_content">Post Content</label>
            <textarea name="post_content" class="form-control ckeditor {{ $errors->has('post_content')? 'is-invalid': null }}" placeholder="Post Content" rows="4" id="_input_post_content">{{ $model_info->post_content }}</textarea>
            <div class="invalid-feedback" id="_help_input_post_content">{{ $errors->has('post_content')? $errors->first('post_content'): null }}</div>
        </div>
        <!----- End form field post_content ----->

        <div class="row">
            <div class="col-8">
                <!----- Start form field post_featured_image ----->
                <div class="form-group">
                    <label class="mb-1" for="post_featured_image">Post Featured Image</label>
                    <div class="custom-file">
                        <input name="post_featured_image" type="file" class="custom-file-input" id="_input_post_featured_image">
                        <label class="custom-file-label" for="_input_post_featured_image">{{ ($model_info->post_featured_image)? $model_info->post_featured_image:'Choose post featured image file' }}</label>
                    </div>
                    <div class="invalid-feedback" id="_help_input_post_featured_image">{{ $errors->has('post_featured_image')? $errors->first('post_featured_image'): null }}</div>
                </div>

                <div class="form-group">
                    <label class="mb-1" for="post_featured_icon">
                        Post Featured Icon
                        <img width="20" src="{{ $model_info->icon }}" class="ml-2" alt="...">
                    </label>
                    <div class="custom-file">
                        <input name="post_featured_icon" type="file" class="custom-file-input" id="_input_post_featured_icon">
                        <label class="custom-file-label" for="_input_post_featured_icon">{{ ($model_info->post_featured_icon)? $model_info->post_featured_icon:'Choose post featured icon file' }}</label>
                    </div>
                    <div class="invalid-feedback" id="_help_input_post_featured_icon">{{ $errors->has('post_featured_icon')? $errors->first('post_featured_icon'): null }}</div>
                </div>

                <div class="form-group">
                    <label class="mb-1" for="post_featured_image">Categories / Tags</label>
                    <div>
                        @if(isset($tags_list)) 
                        @foreach($tags_list as $row)
                        <div class="custom-control custom-checkbox custom-control-inline">
                            
                            <input type="hidden" name="tags_list[{{ $row->tag_id }}][tag_type_id]" value="{{ $row->tag_type_id }}">
                            <input name="tags_list[{{ $row->tag_id }}][tag_id]" type="checkbox" class="custom-control-input" value="{{ $row->tag_id }}" id="tag-{{ $row->tag_id }}" {{ (in_array($row->tag_id, $model_info->post_tags->pluck('tag_id')->toArray()))? 'checked':null }}>
                            <label class="custom-control-label" for="tag-{{ $row->tag_id }}">{{ $row->name }}</label>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="invalid-feedback" id="_input_help_tags_list">{{ $errors->has('tags_list')? $errors->first('tags_list'): null }}</div>
                </div>
                <!----- End form field post_featured_image ----->
            </div>
            <div class="col">
                <div class="card">
                    <img src="{{ $model_info->image_thumbnail }}" class="card-img-top" alt="...">
                </div>
            </div>
        </div>

        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>


<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {};
if(typeof window.form_children_input_value == 'undefined') window.form_children_input_value = {};
if(typeof window.form_children_input_error == 'undefined') window.form_children_input_error = {};
window.form_children_input_value['insert_item_posts_posts_post_medias_list'] = {!! old('posts_posts_post_medias')? json_encode(old('posts_posts_post_medias')): json_encode($model_info->post_medias) !!};
window.form_children_input_error['insert_item_posts_posts_post_medias_list'] = {!! ($errors->get('posts_posts_post_medias.*')? json_encode($errors->get('posts_posts_post_medias.*')): 'null') !!};
window.form_children_input_template['insert_item_posts_posts_post_medias_list'] = function(i, random_id, data, error){ 
    if(!random_id) {
        random_id = Math.random().toString().substr(2) + i;
    }
    
    var str = `
        <td>
            <input type="text" class="form-control ${ ((error && error.name)? 'is-invalid': '') }" name="post_medias_list[${random_id}][name]" value="${ ((data.name)? data.name:'') }" id="_input_name_${random_id}" placeholder="Name">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.original_name)? 'is-invalid': '') }" name="post_medias_list[${random_id}][original_name]" value="${ ((data.original_name)? data.original_name:'') }" id="_input_original_name_${random_id}" placeholder="Original Name">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.type)? 'is-invalid': '') }" name="post_medias_list[${random_id}][type]" value="${ ((data.type)? data.type:'') }" id="_input_type_${random_id}" placeholder="Type">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.size)? 'is-invalid': '') }" name="post_medias_list[${random_id}][size]" value="${ ((data.size)? data.size:'') }" id="_input_size_${random_id}" placeholder="Size">
        </td>
        <td class="text-right" width="100">
            <input type="hidden" name="post_medias_list[${random_id}][post_media_id]" value="${ ((data.post_media_id != null)? data.post_media_id:'') }">
            <div class="btn btn-danger btn-delete btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;

    return str;
}
window.form_children_input_value['insert_item_posts_posts_post_metas_list'] = {!! old('posts_posts_post_metas')? json_encode(old('posts_posts_post_metas')): json_encode($model_info->post_metas) !!};
window.form_children_input_error['insert_item_posts_posts_post_metas_list'] = {!! ($errors->get('posts_posts_post_metas.*')? json_encode($errors->get('posts_posts_post_metas.*')): 'null') !!};
window.form_children_input_template['insert_item_posts_posts_post_metas_list'] = function(i, random_id, data, error){ 
    if(!random_id) {
        random_id = Math.random().toString().substr(2) + i;
    }
    
    var str = `
        <td>
            <select class="form-control ${ ((error && error.meta_id)? 'is-invalid': '') }" name="post_metas_list[${random_id}][meta_id]" id="_input_meta_id_${random_id}">
                <option value="">Please select meta</option>
                @if(isset($metas_list))
                @foreach($metas_list as $key => $item)
                <option value="{{ $item->meta_id }}" ${ ((data.meta_id == '{{ $item->meta_id }}')? 'selected':'') }>{{ $item->name }}</option>
                @endforeach
                @endif
            </select>
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.value)? 'is-invalid': '') }" name="post_metas_list[${random_id}][value]" value="${ ((data.value)? data.value:'') }" id="_input_value_${random_id}" placeholder="Value">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.update_at)? 'is-invalid': '') }" name="post_metas_list[${random_id}][update_at]" value="${ ((data.update_at)? data.update_at:'') }" id="_input_update_at_${random_id}" placeholder="Update Time">
        </td>
        <td class="text-right" width="100">
            <input type="hidden" name="post_metas_list[${random_id}][post_meta_id]" value="${ ((data.post_meta_id != null)? data.post_meta_id:'') }">
            <div class="btn btn-danger btn-delete btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;

    return str;
}
window.form_children_input_value['insert_item_posts_posts_post_tags_list'] = {!! old('posts_posts_post_tags')? json_encode(old('posts_posts_post_tags')): json_encode($model_info->post_tags) !!};
window.form_children_input_error['insert_item_posts_posts_post_tags_list'] = {!! ($errors->get('posts_posts_post_tags.*')? json_encode($errors->get('posts_posts_post_tags.*')): 'null') !!};
window.form_children_input_template['insert_item_posts_posts_post_tags_list'] = function(i, random_id, data, error){ 
    if(!random_id) {
        random_id = Math.random().toString().substr(2) + i;
    }
    
    var str = `
        <td>
            <select class="form-control ${ ((error && error.tag_id)? 'is-invalid': '') }" name="post_tags_list[${random_id}][tag_id]" id="_input_tag_id_${random_id}">
                <option value="">Please select tag</option>
                @if(isset($tags_list))
                @foreach($tags_list as $key => $item)
                <option value="{{ $item->tag_id }}" ${ ((data.tag_id == '{{ $item->tag_id }}')? 'selected':'') }>{{ $item->name }}</option>
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