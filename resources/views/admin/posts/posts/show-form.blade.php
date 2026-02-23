 
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
        
            <!----- Start form field post_title ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Post Title</label>
                <div class="py-2 col">{{ ($model_info->post_title)? $model_info->post_title: '-' }}</div>
            </div>
            <!----- End form field post_title ----->
        
            <!----- Start form field post_slug ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Post Slug</label>
                <div class="py-2 col">{{ ($model_info->post_slug)? $model_info->post_slug: '-' }}</div>
            </div>
            <!----- End form field post_slug ----->
        
            <!----- Start form field post_summary ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Post Summary</label>
                <div class="py-2 col">{{ ($model_info->post_summary)? $model_info->post_summary: '-' }}</div>
            </div>
            <!----- End form field post_summary ----->
        
            <!----- Start form field post_content ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Post Content</label>
                <div class="py-2 col">{!! ($model_info->post_content)? $model_info->post_content: '-' !!}</div>
            </div>
            <!----- End form field post_content ----->
        
            <!----- Start form field post_featured_image ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Post Featured Image</label>
                <label class="form-control col">
                    @if($model_info->post_featured_image && trim($model_info->post_featured_image) != "")
                    <a class="text-primary font-weight-bold" hre="javascript:;">Download file</a>
                    @else
                    <span class="text-danger">Not uploaded</span>
                    @endif
                </label>
            </div>
            <!----- End form field post_featured_image ----->
        
            <!----- Start form field post_author ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Post Author</label>
                <div class="form-control col">
                    @if($model_info->user)
                    {{ $model_info->user->first_name }}
                    @endif
                </div>
            </div>
            <!----- End form field post_author ----->
        
            <!----- Start form field post_date ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Post Date</label>
                <div class="py-2 col">{{ ($model_info->post_date)? $model_info->post_date: '-' }}</div>
            </div>
            <!----- End form field post_date ----->
        
            <!----- Start form field post_status ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Post Status</label>
                <div class="py-2 col">
                    @if($model_info->post_status>0)
                        <a class="btn btn-success" style="border-radius: 20px;">
                            {{Illuminate\Support\Str::limit('Published',10)}}
                        </a> 
                    @else
                        <a class="btn btn-primary" style="border-radius: 20px;">
                            {{Illuminate\Support\Str::limit('Unpublished',12)}}
                        </a>
                    @endif
                    {{-- ($model_info->post_status)? $model_info->post_status: '-' --}}</div>
            </div>
            <!----- End form field post_status ----->

            <!----- Start form field post_status ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Post Views</label>
                <div class="py-2 col">
                    <?php $counted = $model_info->post_view_analysis()->count(); ?>
                    {{$counted}}{{-- $counted<2 ? 'view' : 'views' --}}
                    {{-- ($model_info->post_status)? $model_info->post_status: '-' --}}</div>
            </div>
            <!----- End form field post_status ----->
        
            <!----- Start form field post_modified ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Post Modified</label>
                <div class="py-2 col">{{ ($model_info->post_modified)? $model_info->post_modified: '-' }}</div>
            </div>
            <!----- End form field post_modified ----->
        
            <!----- Start form field post_type_id ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Post Type</label>
                <div class="form-control col">
                    @if($model_info->post_type)
                    {{ $model_info->post_type->name }}
                    @endif
                </div>
            </div>
            <!----- End form field post_type_id ----->
        
            <!----- Start form field parent_post_id ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Parent Post</label>
                <div class="form-control col">
                    @if($model_info->post)
                    {{ $model_info->post->post_title }}
                    @endif
                </div>
            </div>
            <!----- End form field parent_post_id ----->
        
            <!----- Start form field location_id ----->
            <div class="form-group form-row form-view mx-0">
                <label class="col-3 col-form-label">Location</label>
                <div class="form-control col">
                    @if($model_info->location)
                    {{ $model_info->location->name }}
                    @endif
                </div>
            </div>
            <!----- End form field location_id ----->
        
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
            <a class="btn btn-outline-dark mt-4" href="{{ url('admin/posts/posts/show/'.$model_info->post_id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>