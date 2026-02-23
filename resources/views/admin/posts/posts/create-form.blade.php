 
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
<form action="{{ url('admin/posts/'.request('post_type_id').'/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">

        <div class="row">
            <div class="col-8">
                <!----- Start form field post_title ----->
                <div class="form-group">
                    <label class="mb-1" for="post_title">
                        @if(Str::title(request('post_type_id'))=="Testimony")
                            Name & Position 
                         
                        @elseif(request('post_type_id')=="team")
                             Staff Names
                        @else
                            Title 
                        @if(Str::title(request('post_type_id'))=="Welcome-Note")
                            (Max: 6 words.) 
                        @endif 
                        @endif
                    </label>
                    <input type="text" class="form-control {{ $errors->has('post_title')? 'is-invalid': null }}" name="post_title" value="{{ old('post_title') }}"
                    @if(Str::title(request('post_type_id'))=="Testimony") placeholder="Kaaya,   MD" @else  placeholder="Post Title" @endif id="_input_post_title">
                    <div class="invalid-feedback" id="_input_help_post_title">{{ $errors->has('post_title')? $errors->first('post_title'): null }}</div>
                </div>
                <!----- End form field post_title ----->
            </div>
            <div class="col-4">
                <!----- Start form field post_type_id ----->
                @if(request('post_type_id'))
                <div class="form-group">
                    <label class="mb-1" for="post_type_id">Post Type</label>
                    <select class="form-control {{ $errors->has('post_type_id')? 'is-invalid': null }}" name="post_type_id" id="_input_post_type_id">
                        <option value="">Please select type</option>
                        <option value="<new>">Add new type</option>
                        @foreach($post_types_list as $row)
                        <option value="{{ $row->post_type_id }}" {{ ( (old('post_type_id') == $row->post_type_id)? 'selected':null ) }}>{{ $row->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" id="_input_help_post_type_id">{{ $errors->has('post_type_id')? $errors->first('post_type_id'): null }}</div>
                </div>
                @elseif(isset($post_type_id) && !is_null($post_type_id))
                <input type="hidden" name="post_type_id" value="{{ request('post_type_id') }}">
                @endif
                <!----- End form field post_type_id ----->
            </div>

            @if(request('post_type_id') =="team")
            <div class="col-md-12">
                <!----- Start form field post_team_position ----->
                <div class="form-group">
                        <label class="mb-1" for="post_title">
                        Staff Position
                        </label>
                        <input type="text" class="form-control {{ $errors->has('post_team_position')? 'is-invalid': null }}" name="post_team_position" placeholder="Staff Position" id="_input_post_team_position">
                        
                        <div class="invalid-feedback" id="_help_input_post_team_position">
                            {{ $errors->has('post_team_position')? $errors->first('post_team_position'): null }}
                        </div>
                </div>
                <!----- End form field post_title ----->
            </div>
            @endif
        </div>
        
        
        <!----- Start form field post_content ----->
        <div class="form-group">
            <label class="mb-1" for="post_content">
                @if(Str::title(request('post_type_id'))=="Welcome-Note")
                    Welcome-Note link
                @elseif(Str::title(request('post_type_id'))=="Gallery")
                    Event Location
                @else
                    Post Content
                @endif
                </label>

                @if(Str::title(request('post_type_id'))=="Gallery")
                    <input name="post_content" value="{{ old('post_content') }}" name="post_content" class="form-control  {{ $errors->has('post_content')? 'is-invalid': null }}" placeholder="Event Location" rows="4" id="_input_post_content"/>
               
                    <div class="invalid-feedback" id="_input_help_post_content">{{ $errors->has('post_content')? $errors->first('post_content'): null }}</div>
                @else
                    <textarea name="post_content" class="form-control ckeditor {{ $errors->has('post_content')? 'is-invalid': null }}" placeholder="Post Content" rows="4" id="_input_post_content">
                        {{ old('post_content') }}
                    </textarea>
                    <div class="invalid-feedback" id="_input_help_post_content">{{ $errors->has('post_content')? $errors->first('post_content'): null }}</div>
                @endif

        </div>
        <!----- End form field post_content ----->

        <!----- Start form field add_event_date ----->
        <div class="form-group">
            @if(Str::title(request('post_type_id'))=="Welcome-Note")
            
            <label class="mb-1" for="btn_name">Button name</label>
            <div class="custom-date">
                <input name="btn_name" type="text" class="form-control"  id="btn_name" required>
                <!-- <label class="custom-file-label" for="btn_name">Choose event date</label> -->
            </div>
            @elseif(Str::title(request('post_type_id'))=="Gallery")

            <label class="mb-1" for="event_date">Event Date</label>
            <div class="custom-date">
                <input name="event_date" type="date" class="form-control"  id="event_date" required>
                <!-- <label class="custom-file-label" for="event_date">Choose event date</label> -->
            </div>
            @endif
            <div class="invalid-feedback" id="_input_help_post_featured_image">{{ $errors->has('post_featured_image')? $errors->first('post_featured_image'): null }}</div>
        </div>
        <!----- End form field add_event_date ----->
        
        <!----- Start form field post_featured_image ----->
        <div class="form-group">
            <label class="mb-1" for="post_featured_image">Post Featured Image</label>
            <div class="custom-file">
                <input name="post_featured_image" type="file" class="custom-file-input"  id="_input_post_featured_image" required>
                <label class="custom-file-label" for="_input_post_featured_image">Choose file</label>
            </div>
            <div class="invalid-feedback" id="_input_help_post_featured_image">{{ $errors->has('post_featured_image')? $errors->first('post_featured_image'): null }}</div>
        </div>
        <!----- End form field post_featured_image ----->

        <div class="form-group">
            <label class="mb-1" for="post_featured_image">Categories / Tags</label>
            <div class="clearfix">
                @if(isset($tags_list)) 
                @foreach($tags_list as $row)
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="hidden" name="tags_list[{{ $row->tag_id }}][tag_type_id]" value="{{ $row->tag_type_id }}">
                    <input name="tags_list[{{ $row->tag_id }}][tag_id]" type="checkbox" class="custom-control-input" value="{{ $row->tag_id }}" id="tag-{{ $row->tag_id }}">
                    <label class="custom-control-label" for="tag-{{ $row->tag_id }}">{{ $row->name }}</label>
                </div>
                @endforeach
                @endif
            </div>
            <div class="invalid-feedback" id="_input_help_post_featured_image">{{ $errors->has('post_featured_image')? $errors->first('post_featured_image'): null }}</div>
        </div>
        
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {};
if(typeof window.form_children_input_value == 'undefined') window.form_children_input_value = {};
if(typeof window.form_children_input_error == 'undefined') window.form_children_input_error = {};
    
window.form_children_input_value['insert_item_posts_posts_post_medias_list'] = {!! old('posts_posts_post_medias')? json_encode(old('posts_posts_post_medias')): '[{}]' !!};
window.form_children_input_error['insert_item_posts_posts_post_medias_list'] = {!! ($errors->get('posts_posts_post_medias.*')? json_encode($errors->get('posts_posts_post_medias.*')): 'null') !!};
window.form_children_input_template['insert_item_posts_posts_post_medias_list'] = function(i, random_id, data, error){ 
    if(!random_id) {
        random_id = Math.random().toString().substr(2) + i;
    }
    
    var str = `
        <td>
            <input type="text" class="form-control ${ ((error && error.name)? 'is-invalid': '') }" name="post_medias_list[${random_id}][name]" value="${ ((data.name != null)? data.name:'') }" id="_input_name_${random_id}" placeholder="Name">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.original_name)? 'is-invalid': '') }" name="post_medias_list[${random_id}][original_name]" value="${ ((data.original_name != null)? data.original_name:'') }" id="_input_original_name_${random_id}" placeholder="Original Name">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.type)? 'is-invalid': '') }" name="post_medias_list[${random_id}][type]" value="${ ((data.type != null)? data.type:'') }" id="_input_type_${random_id}" placeholder="Type">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.size)? 'is-invalid': '') }" name="post_medias_list[${random_id}][size]" value="${ ((data.size != null)? data.size:'') }" id="_input_size_${random_id}" placeholder="Size">
        </td>
        <td class="text-right" width="100">
            <input type="hidden" name="post_medias_list[${random_id}][post_media_id]" value="${ ((data.post_media_id != null)? data.post_media_id:'') }">
            <div class="btn btn-danger btn-delete btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;

    return str;
}
    
window.form_children_input_value['insert_item_posts_posts_post_metas_list'] = {!! old('posts_posts_post_metas')? json_encode(old('posts_posts_post_metas')): '[{}]' !!};
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
            <input type="text" class="form-control ${ ((error && error.value)? 'is-invalid': '') }" name="post_metas_list[${random_id}][value]" value="${ ((data.value != null)? data.value:'') }" id="_input_value_${random_id}" placeholder="Value">
        </td>
        <td>
            <input type="text" class="form-control ${ ((error && error.update_at)? 'is-invalid': '') }" name="post_metas_list[${random_id}][update_at]" value="${ ((data.update_at != null)? data.update_at:'') }" id="_input_update_at_${random_id}" placeholder="Update Time">
        </td>
        <td class="text-right" width="100">
            <input type="hidden" name="post_metas_list[${random_id}][post_meta_id]" value="${ ((data.post_meta_id != null)? data.post_meta_id:'') }">
            <div class="btn btn-danger btn-delete btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></div>
        </td>`;

    return str;
}
    
window.form_children_input_value['insert_item_posts_posts_post_tags_list'] = {!! old('posts_posts_post_tags')? json_encode(old('posts_posts_post_tags')): '[{}]' !!};
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

