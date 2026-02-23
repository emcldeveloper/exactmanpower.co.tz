@extends($parent_layout)

@section('title', 'Create an ad')

@section('content')

<div class="{{ Request::is('admin/*')? 'p-4': null }}">

@include('accounts.create-banner.navigation')

<style>
.custom-file-label::after {
    left: 0;
    border: none;
    background-color:transparent;
}

.dm-uploader {
    cursor:default;
    -webkit-touch-callout:none;
    -webkit-user-select:none;
    -khtml-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none
}

.dm-uploader .btn {
    position:relative; 
    overflow:hidden
}

.dm-uploader .btn input[type=file] {
    position:absolute;
    top:0;
    right:0;
    margin:0;
    border:solid transparent;
    width:100%;
    opacity:0;
    cursor:pointer
}

.progress {
    height: 1rem !important;
    border-radius: .25rem !important;
    overflow: hidden !important;
}

#files {
    overflow-y: auto !important;
    min-height: 0px;
}

#debug {
	overflow-y: scroll !important;
	height: 180px;	
}

</style>
<style type="text/css">
#_input_address:focus {
    border-color: #4d90fe;
}
</style>

<form action="{{ url($route.'/details/'.request('post_id')) }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="package_id" value="{{ $package_id }}">
    <input type="hidden" name="category_id" value="{{ $category_id }}">
    @if($post)
    <input type="hidden" name="post_id" value="{{ $post->post_id }}">
    @endif
    <div class="bg-white p-4 ">
        <div class="text-center py-4">
            <h4>BANNER DETAILS</h4>
            <h5 class="text-light font-weight-light">*File size should be below 250kb per file (Max image 1) </h5>
            <h5 class="text-light font-weight-light">*File types allowed are .jpg .jpeg, .png </h5>
            <h5 class="text-light font-weight-light">*Valid image sizes 970x90  <!-- 728x90, 300x250, 250x250, 300x600 --> in px</h5>
        </div>

        <div class="clearfix mb-4">
            <img class="img-fluid" src="{{ asset('img/banner-vipimo.jpg') }}">
        </div>
        
        <!----- Include view from components/alert----->
        @component('components.alert')@endcomponent
        <!----- End include view from components/alert----->

        <div class="clearfix">
            <div class="row">
                <div class="col-md-12 col-12">
                    <!-- Our markup, the important part here! -->
                    <div id="drag-and-drop-zone-banner" data-upload-url-custom="{{ url($route.'/photos/'.request('post_id')) }}" single-file  class="dm-uploader  bg-light border p-5 text-center">
                        <div class="">
                            <!-- <i class="icon-Logout fa-4x"></i> -->
                            <i class="icon-Upload fa-4x"></i>
                        </div>    
                        <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

                        <div class="h3 my-5">Or</div>

                        <div class="custom-file" style="width:200px;">
                            <input type="file" name="image" class="custom-file-input" id="_input_image">
                            <input type="hidden" name="image_path">
                            <label class="custom-file-label bg-facebook text-white" for="_input_image" data-browse="">Choose file</label>
                        </div>
                    </div><!-- /uploader -->
                </div>
            </div>
        </div>

        <div class="clearfix py-4">
            <div class="card border p-3 mb-3">
                <div id="files" class="row list-unstyled m-0" files-list >
                    @if(isset($post) && $post && $post->get_featured_image())
                        <div class="col-12 px-2" list-item> 
                            <div class="bg-white  p-2">
                                <div class="clearfix border text-center overflow-hidden" stype="">
                                    <img style="max-height:100px;max-width:100%;" class="image-preview m-auto" src="{{ $post->get_featured_image() }}" alt="Banner">
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="text-muted text-center empty col">No files uploaded.</div>
                    @endif
                </div>
            </div>

            <!----- Start form field alt ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="alt">Title/Alt <span class="text-primary">*</span></label>
                <input type="text" class="form-control {{ $errors->has('alt')? 'is-invalid': null }}" name="alt" value="{{ old('alt')? old('alt'): (($post)? $post->alt: null) }}" placeholder="Enter title" id="_input_alt">
                <div class="invalid-feedback" id="_input_help_alt">{{ $errors->has('alt')? $errors->first('alt'): null }}</div>
            </div>
            <!----- End form field alt ----->

            <!----- Start form field url ----->
            <div class="form-group">
                <label class="font-weight-bold mb-1" for="url">Link when clicked <span class="text-primary">*</span> (must start with http:// or https://)</label>
                <input type="url" class="form-control {{ $errors->has('url')? 'is-invalid': null }}" name="url" value="{{ old('url')? old('url'): (($post)? $post->url: null) }}" placeholder="Enter url" id="_input_url">
                <div class="invalid-feedback" id="_input_help_url">{{ $errors->has('url')? $errors->first('url'): null }}</div>
            </div>
            <!----- End form field url ----->
            
        </div>
    </div>

    <div class="mt-4 text-center">
        <a class="btn btn-light border px-5" href="{{ url($route.'/category/'.request('post_id')) }}">Back</a>
        <button type="submit" class="btn btn-primary px-5">Next</button>
    </div>
</form>

</div>

<script type="text/javascript" src="{{ asset('js/dm-uploader/js/dm-uploader-ui.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('js/dm-uploader/js/jquery.dm-uploader.min.js') }}"></script> -->

<!-- File item template -->
<script type="text/x-handlebars-template" id="files-template">
    <div class="px-2" id="media-@{{id}}">
        <div class="bg-white border">
            <img  class="image-preview mx-auto col" src="" alt="@{{filename}}">
        </div>
    </div>
</script>

<!-- Debug item template -->
<script  type="text/x-handlebars-template" id="debug-template">
    <li class="list-group-item text-@{{color}}"><strong>@{{date}}</strong>: @{{message}}</li>
</script>

<script>

function is_valid_dimensions(width, height) {
    if(width == 728 && height == 90) {
        return true;
    } else if(width == 970 && height == 90) {
        return true;
    } else if(width == 300 && height == 250) {
        // return true;
    } else if(width == 250 && height == 250) {
        // return true;
    } else if(width == 300 && height == 600) {
        // return true;
    }

    return false;
}

jQuery(function(){
    /*
     * For the sake keeping the code clean and the examples simple this file
     * contains only the plugin configuration & callbacks.
     * 
     * UI functions ui_* can be located in: demo-ui.js
     */
     
    // Creates a new file and add it to our list
    function ui_multi_add_file(id, file)
    {
        var template = jQuery('#files-template').text();
        var image_path = document.querySelector("[name=image_path]");
        template = template.replace('%%filename%%', file.name);

        template = jQuery(template);
        template.prop('id', 'uploaderFile' + id);
        template.data('file-id', id);


        var reader = new FileReader();
        reader.template = template;
        reader.onload = function(e) {
            // console.log(e.target.result)
            
            var img = this.template.find('img.image-preview').get(0);
            img.src = e.target.result;
            img.onload = function(){
                var height = img.naturalHeight;
                var width = img.naturalWidth;

                console.log(height)

                if(is_valid_dimensions(width, height)) {
                    image_path.value = e.target.result;
                    jQuery('#files').find('div.empty').fadeOut(); // remove the 'no files yet'
                    jQuery('#files').html(template);
                } else {
                    image_path.value = '';
                    jQuery('#files').find('div.empty').fadeOut(); // remove the 'no files yet'
                    jQuery('#files').html(`<div class="text-danger text-center w-100">invalid banner dimentions</div>`);
                }
            }
        }
        reader.readAsDataURL(file);
    }

    jQuery('#drag-and-drop-zone-banner').dmUploader({ //
        auto: false,
        url: jQuery(this).data('upload-url-custom'),
        maxFileSize: 3000000, // 3 Megs 
        onDragEnter: function(){
            // Happens when dragging something over the DnD area
            this.addClass('active');
        },
        onDragLeave: function(){
            // Happens when dragging something OUT of the DnD area
            this.removeClass('active');
        },
        onInit: function(){
            // Plugin is ready to use
            ui_add_log('Penguin initialized :)', 'info');
        },
        onComplete: function(){
            // All files in the queue are processed (success or error)
            ui_add_log('All pending tranfers finished');
        },
        onNewFile: function(id, file){
            // When a new file is added using the file selector or the DnD area
            ui_add_log('New file added #' + id);
            ui_multi_add_file(id, file);
        },
        onBeforeUpload: function(id){
            // about tho start uploading a file
            ui_add_log('Starting the upload of #' + id);
            ui_multi_update_file_status(id, 'uploading', 'Uploading...');
            ui_multi_update_file_progress(id, 0, '', true);
        },
        onUploadCanceled: function(id) {
            // Happens when a file is directly canceled by the user.
            ui_multi_update_file_status(id, 'warning', 'Canceled by User');
            ui_multi_update_file_progress(id, 0, 'warning', false);
        },
        onUploadProgress: function(id, percent){
            // Updating file progress
            ui_multi_update_file_progress(id, percent);
        },
        onUploadSuccess: function(id, data){
            // A file was successfully uploaded
            ui_add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
            ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
            ui_multi_update_file_status(id, 'success', 'Upload Complete');
            ui_multi_update_file_progress(id, 100, 'success', false);
        },
        onUploadError: function(id, xhr, status, message){
            ui_multi_update_file_status(id, 'danger', message);
            ui_multi_update_file_progress(id, 0, 'danger', false);  
        },
        onFallbackMode: function(){
            // When the browser doesn't support this plugin :(
            ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
        },
        onFileSizeError: function(file){
            ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
        }
    });
});
</script>

@endsection