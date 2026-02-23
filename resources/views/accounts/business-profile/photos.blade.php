@extends($parent_layout)

@section('title', 'Create an ad')

@section('content')

<div class="{{ Request::is('admin/*')? 'p-4': null }}">

@include('accounts.business-profile.navigation')

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

#files, #logo-file {
    overflow-y: auto !important;
    min-height: 0px;
    margin-left: -0.5rem;
    margin-right: -0.5rem;
}

#debug {
	overflow-y: scroll !important;
	height: 180px;	
}

</style>


<div class="bg-white p-4 ">
    <div class="text-center py-4">
        <h4>UPLOAD YOUR BUSINESS LOGO</h4>
        <h5 class="text-light font-weight-light">*File size should be below 10MB per file (Max image 10) </h5>
        <h5 class="text-light font-weight-light">*File types allowed are .jpg .jpeg, .png </h5>
    </div>

    <!-- --- Include view from components/alert --- -->
    @component('components.alert')@endcomponent
    <!-- --- End include view from components/alert --- -->

    <div class="clearfix">
        <div class="row">
            <div class="col-md-12 col-12">
                <div data-upload-url="{{ url($route.'/photos/'.request('post_id').'/logo') }}"  single-file>
                    <!-- Our markup, the important part here! -->
                    <div  class="dm-uploader  bg-light border p-5 text-center">
                        <div class="">
                            <!-- <i class="icon-Logout fa-4x"></i> -->
                            <i class="icon-Upload fa-4x"></i>
                        </div>    
                        <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop file here</h3>

                        <div class="row list-unstyled justify-content-center" files-list >
                            @if($post->post_featured_image)
                            <div class="col-3 px-2 mb-3" list-item>
                                <div class="bg-white border">
                                    <div class="clearfix text-center overflow-hidden">
                                        <img style="height:100px;" class="image-preview m-auto mb-1" src="{{ $post->get_featured_image() }}" alt="%%filename%%">
                                    </div>
                                    <div class="bg-light p-2">
                                        <div class="btn-group btn-group-sm">
                                            <!-- <a class="btn py-0 px-2" href="javascript:;" ><i class="fa fa-sync"></i></a> -->
                                            <a action-delete  data-confirmation="Are you sure, you want to delete?" class="btn py-0 px-2" href="{{ url('account/action/delete-media') }}?filename={{ $post->post_featured_image }}" ><i class="fa fa-trash"></i></a>
                                        </div>
                                        <div class="progress mt-0">
                                            <div class="progress-bar progress-bar-animated bg-success" 
                                                role="progressbar"
                                                style="width: 100%" 
                                                aria-valuenow="100" aria-valuemin="100" aria-valuemax="100">
                                                100%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="h3 my-5">Or</div>

                        <div class="custom-file" style="width:200px;">
                            <input type="file" name="post_featured_image" class="custom-file-input" id="_input_logo" >
                            <label class="custom-file-label bg-facebook text-white" for="_input_logo" data-browse="">Choose logo</label>
                        </div>
                    </div><!-- /uploader -->
                    
                    <div class="clearfix mt-4">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white p-4 mt-5">
    <div class="text-center py-4">
        <h4>UPLOAD YOUR BUSINESS PHOTOS</h4>
        <h5 class="text-light font-weight-light">*File size should be below 10MB per file (Max image 10) </h5>
        <h5 class="text-light font-weight-light">*File types allowed are .jpg .jpeg, .png </h5>
    </div>

    <!-- --- Include view from components/alert --- -->
    @component('components.alert')@endcomponent
    <!-- --- End include view from components/alert --- -->

    <div class="clearfix">
        <div class="row">
            <div class="col-md-12 col-12">
                <div data-upload-url="{{ url($route.'/photos/'.request('post_id')) }}">
                    <!-- Our markup, the important part here! -->
                    <div  class="dm-uploader  bg-light border p-5 text-center">
                        <div class="">
                            <!-- <i class="icon-Logout fa-4x"></i> -->
                            <i class="icon-Upload fa-4x"></i>
                        </div>    
                        <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

                        <div class="h3 my-5">Or</div>

                        <div class="custom-file" style="width:200px;">
                            <input type="file" name="photos" class="custom-file-input" id="_input_photos" multiple>
                            <label class="custom-file-label bg-facebook text-white" for="_input_photos" data-browse="">Choose file</label>
                        </div>
                    </div><!-- /uploader -->
                    
                    <div class="clearfix mt-4">
                        <div class="row list-unstyled" files-list>
                            @if(isset($post) && $post && $post->post_medias && $post->post_medias->count())
                                @foreach($post->post_medias as $media)
                                <div class="col-3 px-2 mb-3" list-item>
                                    <div class="bg-white border">
                                        <div class="clearfix text-center overflow-hidden p-2">
                                            <img style="height:100px;" class="image-preview m-auto mb-1" src="{{ $media->url() }}" alt="%%filename%%">
                                        </div>
                                        <div class="bg-light p-2">
                                            <div class="btn-group btn-group-sm">
                                                <!-- <a class="btn py-0 px-2" href="javascript:;" ><i class="fa fa-sync"></i></a> -->
                                                <a action-delete  data-confirmation="Are you sure, you want to delete?" class="btn py-0 px-2" href="{{ url('account/action/delete-media') }}?filename={{ $media->name }}" ><i class="fa fa-trash"></i></a>
                                            </div>
                                            <div class="progress mt-0">
                                                <div class="progress-bar progress-bar-animated bg-success" 
                                                    role="progressbar"
                                                    style="width: 100%" 
                                                    aria-valuenow="100" aria-valuemin="100" aria-valuemax="100">
                                                    100%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                            <div class="text-muted text-center empty col">No files uploaded.</div>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4 text-center">
    <a class="btn btn-light border px-5" href="{{ url($route.'/details/'.request('post_id')) }}">Back</a>
    <a class="btn btn-primary px-5" href="{{ url($route.'/package/'.request('post_id')) }}" >Next</a>
</div>

</div>



<script type="text/javascript" src="{{ asset('js/dm-uploader/js/jquery.dm-uploader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dm-uploader/js/dm-uploader-ui.js') }}"></script>
@if(false)
<script type="text/javascript" src="{{ asset('js/dm-uploader/js/ui-main.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dm-uploader/js/ui-multiple.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dm-uploader/js/images.js') }}"></script>
@endif
 

<!-- File item template -->
<script type="text/x-handlebars-template" id="files-template">
    <div class="col-3 px-2 mb-3" id="media-@{{id}}">
        <div class="bg-white border">
            <div class="clearfix text-center overflow-hidden p-2">
                <img style="height:100px;" class="image-preview m-auto mb-1" src="" alt="@{{filename}}">
            </div>
            <div class="bg-light p-2">
                <div class="btn-group btn-group-sm">
                    <!-- <a class="btn py-0 px-2" href="{{ url('account/action/delete-media') }}?filename=@{{filename}}" ><i class="fa fa-sync"></i></a> -->
                    <a data-confirmation="Are you sure, you want to delete?" class="btn py-0 px-2" href="{{ url('account/action/delete-media') }}?filename=@{{filename}}" ><i class="fa fa-trash"></i></a>
                </div>
                <div class="progress mt-0">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
                        role="progressbar"
                        style="width: 0%" 
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<!-- Debug item template -->
<script  type="text/x-handlebars-template" id="debug-template">
    <li class="list-group-item text-@{{color}}"><strong>@{{date}}</strong>: @{{message}}</li>
</script>

<!-- 
<script>
jQuery(function(){
    console.log('sample')
    jQuery('#drag-and-drop-zone').on({
        dragover: function(e) {
            e.preventDefault();
            e.stopPropagation();
        },
        dragenter: function(e) {
            e.preventDefault();
            e.stopPropagation();
        },
        dragleave: function(e) {
            e.preventDefault();
            e.stopPropagation();
        },
        drop: function(e) {
            e.stopPropagation();
            e.preventDefault();
            var files = e.originalEvent.dataTransfer.files;
            var input_files = document.querySelector("[name=photos]");
            var old_files = input_files.files;



            files.length = (files.length + old_files.length)
            for (var i = 0; i < old_files.length; i++) {
                var file = old_files[i];
                files[(files.length + i)] = file;
            }
            input_files.files = files;
        }
    });

    jQuery('#drag-and-drop-zone-logo').on({
        dragover: function(e) {
            e.preventDefault();
            e.stopPropagation();
        },
        dragenter: function(e) {
            e.preventDefault();
            e.stopPropagation();
        },
        dragleave: function(e) {
            e.preventDefault();
            e.stopPropagation();
        },
        drop: function(e) {
            e.stopPropagation();
            e.preventDefault();
            var files = e.originalEvent.dataTransfer.files;
            var input_files = document.querySelector("[name=post_featured_image]");
            var old_files = input_files.files;

            console.log(input_files)

            files.length = (files.length + old_files.length)
            for (var i = 0; i < old_files.length; i++) {
                var file = old_files[i];
                files[(files.length + i)] = file;
            }
            input_files.files = files;
        }
    });
})

</script> -->

@endsection