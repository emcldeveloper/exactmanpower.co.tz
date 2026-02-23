 
<form action="{{ url($route_save . ''.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    
    <div class="row">
        <div class="col">
            <!----- Start form field post_title ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="post_title">Title <span class="text-primary">*</span></label>
                <input type="text" class="form-control {{ $errors->has('post_title')? 'is-invalid': null }}" name="post_title" value="{{ old('post_title') }}" placeholder="Writte the name here..." id="_input_post_title">
                <div class="invalid-feedback" id="_input_help_post_title">{{ $errors->has('post_title')? $errors->first('post_title'): null }}</div>
            </div>
            <!----- End form field post_title ----->
        </div>
        <div class="col-12 col-md-5">
            <!----- Start form field post_slug ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="post_slug">Slug</label>
                <input type="text" class="form-control {{ $errors->has('post_slug')? 'is-invalid': null }}" name="post_slug" value="{{ old('post_slug') }}" placeholder="Post Slug" id="_input_post_slug">
                <div class="invalid-feedback" id="_input_help_post_slug">{{ $errors->has('post_slug')? $errors->first('post_slug'): null }}</div>
            </div>
            <!----- End form field post_slug ----->
        </div>
    </div>

    <!----- Start form field post_featured_image ----->
    <div class="form-group">
        <label class="font-weight-bold mb-1" for="post_featured_image">Featured Image</label>
        <div class="custom-file">
            <input name="post_featured_image" type="file" class="custom-file-input" id="_input_post_featured_image">
            <label class="custom-file-label" for="_input_post_featured_image">Choose featured image file</label>
        </div>
        <div class="invalid-feedback" id="_help_input_post_featured_image">{{ $errors->has('post_featured_image')? $errors->first('post_featured_image'): null }}</div>
    </div>
    <!----- End form field post_featured_image ----->

    <!----- Start form field post_content ----->
    <div class="form-group">
        <label class="font-weight-bold mb-1" for="post_content">Content <span class="text-primary">*</span></label>
        <textarea type="text" rows="3" class="form-control ckeditor {{ $errors->has('post_content')? 'is-invalid': null }}" name="post_content" placeholder="Enter your description" id="_input_post_content">{{ old('post_content') }}</textarea>
        <div class="invalid-feedback" id="_input_help_post_content">{{ $errors->has('post_content')? $errors->first('post_content'): null }}</div>
    </div>
    <!----- End form field post_content ----->
        
    <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
    <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 



</script>

