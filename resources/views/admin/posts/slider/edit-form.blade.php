  

<form action="{{ url('admin/posts/'.request('post_type_id').'/update/'.$model_info->post_id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->

    <div class="clearfix">
        <div class="row">
            <div class="col">
                <!----- Start form field post_featured_image ----->
                <div class="form-group">
                    <label class="mb-1" for="post_featured_image">{{ Str::title(request('post_type_id')) }} Image</label>
                    <div class="custom-file">
                        <input name="post_featured_image" type="file" class="custom-file-input" id="_input_post_featured_image">
                        <label class="custom-file-label" for="_input_post_featured_image">{{ ($model_info->post_featured_image)? $model_info->post_featured_image:'Choose featured image file' }}</label>
                    </div>
                    <div class="invalid-feedback" id="_help_input_post_featured_image">{{ $errors->has('post_featured_image')? $errors->first('post_featured_image'): null }}</div>
                </div>
                <!----- End form field post_featured_image ----->

                <!----- Start form field post_title ----->
                <div class="form-group">
                    <label class="mb-1" for="post_title">{{ Str::title(request('post_type_id')) }} title</label>
                    <input type="text" class="form-control {{ $errors->has('post_title')? 'is-invalid': null }}" name="post_title" value="{{ $model_info->post_title }}" placeholder="Caption" id="_input_post_title">
                    <div class="invalid-feedback" id="_help_input_post_title">{{ $errors->has('post_title')? $errors->first('post_title'): null }}</div>
                </div>
                <!----- End form field post_title ----->

                <!----- Start form field post_content ----->
                <div class="form-group">
                    <label class="mb-1" for="post_content">{{ Str::title(request('post_type_id')) }} caption</label>
                    <input type="text" class="form-control {{ $errors->has('post_content')? 'is-invalid': null }}" name="post_content" value="{{ $model_info->post_content }}" placeholder="Caption" id="_input_post_content">
                    <div class="invalid-feedback" id="_input_help_post_content">{{ $errors->has('post_content')? $errors->first('post_content'): null }}</div>
                </div>
                <!----- End form field post_content ----->
                
            </div>
            <div class="col-2">
                <div class="card">
                    <img src="{{ $model_info->image_thumbnail }}" class="card-img-top" alt="...">
                </div>
            </div>
        </div>
        
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
