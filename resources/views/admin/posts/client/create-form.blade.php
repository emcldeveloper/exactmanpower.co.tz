 
<form action="{{ url('admin/posts/'.request('post_type_id').'/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
        
    <!----- Start form field post_featured_image ----->
    <div class="form-group">
        <label class="mb-1" for="post_featured_image">{{ Str::title(request('post_type_id')) }} Image</label>
        <div class="custom-file">
            <input name="post_featured_image" type="file" class="custom-file-input"  id="_input_post_featured_image">
            <label class="custom-file-label" for="_input_post_featured_image">Choose image file</label>
        </div>
        <div class="invalid-feedback" id="_input_help_post_featured_image">{{ $errors->has('post_featured_image')? $errors->first('post_featured_image'): null }}</div>
    </div>
    <!----- End form field post_featured_image ----->

    <div class="clearfix">
        <!----- Start form field post_title ----->
        <div class="form-group">
            <label class="mb-1" for="post_title">{{ Str::title(request('post_type_id')) }} title</label>
            <input type="text" class="form-control {{ $errors->has('post_title')? 'is-invalid': null }}" name="post_title" value="{{ old('post_title') }}" placeholder="Caption" id="_input_post_title">
            <div class="invalid-feedback" id="_input_help_post_title">{{ $errors->has('post_title')? $errors->first('post_title'): null }}</div>
        </div>
        <!----- End form field post_title ----->

        <!----- Start form field post_content ----->
        <div class="form-group">
            <label class="mb-1" for="post_content">{{ Str::title(request('post_type_id')) }} caption</label>
            <input type="text" class="form-control {{ $errors->has('post_content')? 'is-invalid': null }}" name="post_content" value="{{ old('post_content') }}" placeholder="Caption" id="_input_post_content">
            <div class="invalid-feedback" id="_input_help_post_content">{{ $errors->has('post_content')? $errors->first('post_content'): null }}</div>
        </div>
        <!----- End form field post_content ----->
        
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {};
if(typeof window.form_children_input_value == 'undefined') window.form_children_input_value = {};
if(typeof window.form_children_input_error == 'undefined') window.form_children_input_error = {};



</script>

