  
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
<form action="{{ url('admin/posts/post-comments/update/'.$model_info->post_comment_id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->

    <div class="clearfix">
        <!----- Start form field post_id ----->
        @if(!in_array("post_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="post_id">Post</label>
            <select class="form-control {{ $errors->has('post_id')? 'is-invalid': null }}" name="post_id" id="_input_post_id">
                <option value="">Please select post</option>
                <option value="<new>">Add new post</option>
                @foreach($posts_list as $row)
                <option value="{{ $row->post_id }}" {{ ( ($model_info->post_id == $row->post_id)? 'selected':null ) }}>{{ $row->post_title }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_post_id">{{ $errors->has('post_id')? $errors->first('post_id'): null }}</div>
        </div>
        @endif
        <!----- End form field post_id ----->
        <!----- Start form field comment_author ----->
        <div class="form-group">
            <label class="mb-1" for="comment_author">Comment Author</label>
            <input type="text" class="form-control {{ $errors->has('comment_author')? 'is-invalid': null }}" name="comment_author" value="{{ $model_info->comment_author }}" placeholder="Comment Author" id="_input_comment_author">
            <div class="invalid-feedback" id="_help_input_comment_author">{{ $errors->has('comment_author')? $errors->first('comment_author'): null }}</div>
        </div>
        <!----- End form field comment_author ----->
        <!----- Start form field comment_date ----->
        <div class="form-group">
            <label class="mb-1" for="comment_date">Comment Date</label>
            <input type="text" class="form-control datepicker {{ $errors->has('comment_date')? 'is-invalid': null }}" name="comment_date" value="{{ $model_info->comment_date }}" placeholder="Comment Date" id="_input_comment_date">
            <div class="invalid-feedback" id="_help_input_comment_date">{{ $errors->has('comment_date')? $errors->first('comment_date'): null }}</div>
        </div>
        <!----- End form field comment_date ----->
        <!----- Start form field comment_content ----->
        <div class="form-group">
            <label class="mb-1" for="comment_content">Comment Content</label>
            <textarea name="comment_content" class="form-control {{ $errors->has('comment_content')? 'is-invalid': null }}" placeholder="Comment Content" rows="4" id="_input_comment_content">{{ $model_info->comment_content }}</textarea>
            <div class="invalid-feedback" id="_help_input_comment_content">{{ $errors->has('comment_content')? $errors->first('comment_content'): null }}</div>
        </div>
        <!----- End form field comment_content ----->
        <!----- Start form field comment_type ----->
        <div class="form-group">
            <label class="mb-1" for="comment_type">Comment Type</label>
            <input type="text" class="form-control {{ $errors->has('comment_type')? 'is-invalid': null }}" name="comment_type" value="{{ $model_info->comment_type }}" placeholder="Comment Type" id="_input_comment_type">
            <div class="invalid-feedback" id="_help_input_comment_type">{{ $errors->has('comment_type')? $errors->first('comment_type'): null }}</div>
        </div>
        <!----- End form field comment_type ----->
        <!----- Start form field parent_post_comment_id ----->
        @if(!in_array("parent_post_comment_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="parent_post_comment_id">Parent Post Comment</label>
            <select class="form-control {{ $errors->has('parent_post_comment_id')? 'is-invalid': null }}" name="parent_post_comment_id" id="_input_parent_post_comment_id">
                <option value="">Please select parent post comment</option>
                <option value="<new>">Add new parent post comment</option>
                @foreach($post_comments_list as $row)
                <option value="{{ $row->parent_post_comment_id }}" {{ ( ($model_info->parent_post_comment_id == $row->parent_post_comment_id)? 'selected':null ) }}>{{ $row->post_id }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_parent_post_comment_id">{{ $errors->has('parent_post_comment_id')? $errors->first('parent_post_comment_id'): null }}</div>
        </div>
        @endif
        <!----- End form field parent_post_comment_id ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>


<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {};
if(typeof window.form_children_input_value == 'undefined') window.form_children_input_value = {};
if(typeof window.form_children_input_error == 'undefined') window.form_children_input_error = {};
</script>