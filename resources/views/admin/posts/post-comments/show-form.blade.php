 
<style>
.form-view {
    margin-bottom: 0;
    border-bottom: 1px dashed #ced4da;
}

.form-view .form-control {
    border: none;
    background: transparent;
}
</style>

<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="card card-body col-12 col-md-10 m-auto">
        
            <!----- Start form field post_id ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Post</label>
                <div class="form-control col">
                    @if($model_info->post)
                    {{ $model_info->post->post_title }}
                    @endif
                </div>
            </div>
            <!----- End form field post_id ----->
        
            <!----- Start form field comment_author ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Comment Author</label>
                <div class="py-2 col">{{ ($model_info->user->username)? $model_info->user->username: '-' }}</div>
            </div>
            <!----- End form field comment_author ----->
        
            <!----- Start form field comment_date ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Comment Date</label>
                <div class="py-2 col">{{ ($model_info->created_at)? $model_info->created_at: '-' }}</div>
            </div>
            <!----- End form field comment_date ----->
        
            <!----- Start form field comment_content ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Comment Content</label>
                <div class="py-2 col">{!! ($model_info->comment_content)? $model_info->comment_content: '-' !!}</div>
            </div>
            <!----- End form field comment_content ----->
        
            <!----- Start form field comment_type ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Comment Type</label>
                <div class="py-2 col">{{ ($model_info->post_type_id)? $model_info->post_type_id: '-' }}</div>
            </div>
            <!----- End form field comment_type ----->
        
            <!----- Start form field parent_post_comment_id ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Parent Post Comment</label>
                <div class="form-control col">
                    @if($model_info->post_comment)
                    {{ $model_info->post_comment->post_id }}
                    @endif
                </div>
            </div>
            <!----- End form field parent_post_comment_id ----->
        
            <!----- Start form field created_at ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Created Time</label>
                <div class="py-2 col">{{ ($model_info->created_at)? $model_info->created_at: '-' }}</div>
            </div>
            <!----- End form field created_at ----->
        
            <!----- Start form field updated_at ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Updated Time</label>
                <div class="py-2 col">{{ ($model_info->updated_at)? $model_info->updated_at: '-' }}</div>
            </div>
            <!----- End form field updated_at ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-outline-dark mt-4" href="{{ url('admin/posts/post-comments/show/'.$model_info->post_comment_id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>