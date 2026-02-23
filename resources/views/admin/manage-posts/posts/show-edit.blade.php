  

<form class="clearfix p-3" action="{{ url($route . '/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    <div class="clearfix">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->
    
        <!----- Start form field post_title ----->
        <div class="form-group">
            <label class="mb-1" for="post_title">Post Title</label>
            <input type="text" class="form-control {{ $errors->has('post_title')? 'is-invalid': null }}" name="post_title" value="{{ $model_info->post_title }}" placeholder="Post Title" id="_input_post_title">
            <div class="invalid-feedback" id="_help_input_post_title">{{ $errors->has('post_title')? $errors->first('post_title'): null }}</div>
        </div>
        <!----- End form field post_title ----->
        <!----- Start form field post_slug ----->
        <div class="form-group">
            <label class="mb-1" for="post_slug">Post Slug</label>
            <input type="text" class="form-control {{ $errors->has('post_slug')? 'is-invalid': null }}" name="post_slug" value="{{ $model_info->post_slug }}" placeholder="Post Slug" id="_input_post_slug">
            <div class="invalid-feedback" id="_help_input_post_slug">{{ $errors->has('post_slug')? $errors->first('post_slug'): null }}</div>
        </div>
        <!----- End form field post_slug ----->
        <!----- Start form field post_summary ----->
        <div class="form-group">
            <label class="mb-1" for="post_summary">Post Summary</label>
            <input type="text" class="form-control {{ $errors->has('post_summary')? 'is-invalid': null }}" name="post_summary" value="{{ $model_info->post_summary }}" placeholder="Post Summary" id="_input_post_summary">
            <div class="invalid-feedback" id="_help_input_post_summary">{{ $errors->has('post_summary')? $errors->first('post_summary'): null }}</div>
        </div>
        <!----- End form field post_summary ----->
        <!----- Start form field post_content ----->
        <div class="form-group">
            <label class="mb-1" for="post_content">Post Content</label>
            <input type="text" class="form-control {{ $errors->has('post_content')? 'is-invalid': null }}" name="post_content" value="{{ $model_info->post_content }}" placeholder="Post Content" id="_input_post_content">
            <div class="invalid-feedback" id="_help_input_post_content">{{ $errors->has('post_content')? $errors->first('post_content'): null }}</div>
        </div>
        <!----- End form field post_content ----->
        <!----- Start form field post_featured_image ----->
        <div class="form-group">
            <label class="mb-1" for="post_featured_image">Post Featured Image</label>
            <div class="custom-file">
                <input name="post_featured_image" type="file" class="custom-file-input" id="_input_post_featured_image">
                <label class="custom-file-label" for="_input_post_featured_image">Choose post featured image file</label>
            </div>
            <div class="invalid-feedback" id="_help_input_post_featured_image">{{ $errors->has('post_featured_image')? $errors->first('post_featured_image'): null }}</div>
        </div>
        <!----- End form field post_featured_image ----->
        <!----- Start form field post_author ----->
        <div class="form-group">
            <label class="mb-1" for="post_author">Post Author</label>
            <input type="text" class="form-control {{ $errors->has('post_author')? 'is-invalid': null }}" name="post_author" value="{{ $model_info->post_author }}" placeholder="Post Author" id="_input_post_author">
            <div class="invalid-feedback" id="_help_input_post_author">{{ $errors->has('post_author')? $errors->first('post_author'): null }}</div>
        </div>
        <!----- End form field post_author ----->
        <!----- Start form field post_date ----->
        <div class="form-group">
            <label class="mb-1" for="post_date">Post Date</label>
            <input type="text" class="form-control datepicker {{ $errors->has('post_date')? 'is-invalid': null }}" name="post_date" value="{{ $model_info->post_date }}" placeholder="Post Date" id="_input_post_date">
            <div class="invalid-feedback" id="_help_input_post_date">{{ $errors->has('post_date')? $errors->first('post_date'): null }}</div>
        </div>
        <!----- End form field post_date ----->
        <!----- Start form field extra_status ----->
        <div class="form-group">
            <label class="mb-1" for="extra_status">Extra Status</label>
            <input type="text" class="form-control {{ $errors->has('extra_status')? 'is-invalid': null }}" name="extra_status" value="{{ $model_info->extra_status }}" placeholder="Extra Status" id="_input_extra_status">
            <div class="invalid-feedback" id="_help_input_extra_status">{{ $errors->has('extra_status')? $errors->first('extra_status'): null }}</div>
        </div>
        <!----- End form field extra_status ----->
        <!----- Start form field extra_count ----->
        <div class="form-group">
            <label class="mb-1" for="extra_count">Extra Count</label>
            <input type="text" class="form-control {{ $errors->has('extra_count')? 'is-invalid': null }}" name="extra_count" value="{{ $model_info->extra_count }}" placeholder="Extra Count" id="_input_extra_count">
            <div class="invalid-feedback" id="_help_input_extra_count">{{ $errors->has('extra_count')? $errors->first('extra_count'): null }}</div>
        </div>
        <!----- End form field extra_count ----->
        <!----- Start form field post_status ----->
        <div class="form-group">
            <label class="mb-1" for="post_status">Post Status</label>
            <input type="text" class="form-control {{ $errors->has('post_status')? 'is-invalid': null }}" name="post_status" value="{{ $model_info->post_status }}" placeholder="Post Status" id="_input_post_status">
            <div class="invalid-feedback" id="_help_input_post_status">{{ $errors->has('post_status')? $errors->first('post_status'): null }}</div>
        </div>
        <!----- End form field post_status ----->
        <!----- Start form field post_modified ----->
        <div class="form-group">
            <label class="mb-1" for="post_modified">Post Modified</label>
            <input type="text" class="form-control {{ $errors->has('post_modified')? 'is-invalid': null }}" name="post_modified" value="{{ $model_info->post_modified }}" placeholder="Post Modified" id="_input_post_modified">
            <div class="invalid-feedback" id="_help_input_post_modified">{{ $errors->has('post_modified')? $errors->first('post_modified'): null }}</div>
        </div>
        <!----- End form field post_modified ----->
        <!----- Start form field price ----->
        <div class="form-group">
            <label class="mb-1" for="price">Price</label>
            <input type="text" class="form-control {{ $errors->has('price')? 'is-invalid': null }}" name="price" value="{{ $model_info->price }}" placeholder="Price" id="_input_price">
            <div class="invalid-feedback" id="_help_input_price">{{ $errors->has('price')? $errors->first('price'): null }}</div>
        </div>
        <!----- End form field price ----->
        <!----- Start form field post_type_id ----->
        @if(!in_array("post_type_id", $hidden))
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
        <!----- Start form field parent_post_id ----->
        @if(!in_array("parent_post_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="parent_post_id">Parent Post</label>
            <select class="form-control {{ $errors->has('parent_post_id')? 'is-invalid': null }}" name="parent_post_id" id="_input_parent_post_id">
                <option value="">Please select parent post</option>
                <option value="<new>">Add new parent post</option>
                @foreach($posts_list as $row)
                <option value="{{ $row->parent_post_id }}" {{ ( ($model_info->parent_post_id == $row->parent_post_id)? 'selected':null ) }}>{{ $row->parent_post_id }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_parent_post_id">{{ $errors->has('parent_post_id')? $errors->first('parent_post_id'): null }}</div>
        </div>
        @endif
        <!----- End form field parent_post_id ----->
        <!----- Start form field category_id ----->
        @if(!in_array("category_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="category_id">Category</label>
            <select class="form-control {{ $errors->has('category_id')? 'is-invalid': null }}" name="category_id" id="_input_category_id">
                <option value="">Please select category</option>
                <option value="<new>">Add new category</option>
                @foreach($categories_list as $row)
                <option value="{{ $row->category_id }}" {{ ( ($model_info->category_id == $row->category_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_category_id">{{ $errors->has('category_id')? $errors->first('category_id'): null }}</div>
        </div>
        @endif
        <!----- End form field category_id ----->
        <!----- Start form field package_id ----->
        @if(!in_array("package_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="package_id">Package</label>
            <select class="form-control {{ $errors->has('package_id')? 'is-invalid': null }}" name="package_id" id="_input_package_id">
                <option value="">Please select package</option>
                <option value="<new>">Add new package</option>
                @foreach($packages_list as $row)
                <option value="{{ $row->package_id }}" {{ ( ($model_info->package_id == $row->package_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_package_id">{{ $errors->has('package_id')? $errors->first('package_id'): null }}</div>
        </div>
        @endif
        <!----- End form field package_id ----->
        <!----- Start form field location_id ----->
        @if(!in_array("location_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="location_id">Location</label>
            <select class="form-control {{ $errors->has('location_id')? 'is-invalid': null }}" name="location_id" id="_input_location_id">
                <option value="">Please select location</option>
                <option value="<new>">Add new location</option>
                @foreach($locations_list as $row)
                <option value="{{ $row->location_id }}" {{ ( ($model_info->location_id == $row->location_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_location_id">{{ $errors->has('location_id')? $errors->first('location_id'): null }}</div>
        </div>
        @endif
        <!----- End form field location_id ----->
        <!----- Start form field is_business ----->
        <div class="form-group">
            <label class="mb-1" for="is_business">Is Business</label>
            <div class="custom-control custom-switch {{ $errors->has('is_business')? 'is-invalid': null }}">
                <input type="checkbox" class="custom-control-input" id="is_business" name="is_business" id="_input_is_business" {{ ($model_info->is_business)? 'checked':null }}>
                <label class="custom-control-label" for="is_business">Please check if is business</label>
            </div>
            <div class="invalid-feedback" id="_help_input_is_business">{{ $errors->has('is_business')? $errors->first('is_business'): null }}</div>
        </div>
        <!----- End form field is_business ----->
        <!----- Start form field is_auto_renew ----->
        <div class="form-group">
            <label class="mb-1" for="is_auto_renew">Is Auto Renew</label>
            <div class="custom-control custom-switch {{ $errors->has('is_auto_renew')? 'is-invalid': null }}">
                <input type="checkbox" class="custom-control-input" id="is_auto_renew" name="is_auto_renew" id="_input_is_auto_renew" {{ ($model_info->is_auto_renew)? 'checked':null }}>
                <label class="custom-control-label" for="is_auto_renew">Please check if is auto renew</label>
            </div>
            <div class="invalid-feedback" id="_help_input_is_auto_renew">{{ $errors->has('is_auto_renew')? $errors->first('is_auto_renew'): null }}</div>
        </div>
        <!----- End form field is_auto_renew ----->
        <!----- Start form field is_notify_on_expire ----->
        <div class="form-group">
            <label class="mb-1" for="is_notify_on_expire">Is Notify On Expire</label>
            <div class="custom-control custom-switch {{ $errors->has('is_notify_on_expire')? 'is-invalid': null }}">
                <input type="checkbox" class="custom-control-input" id="is_notify_on_expire" name="is_notify_on_expire" id="_input_is_notify_on_expire" {{ ($model_info->is_notify_on_expire)? 'checked':null }}>
                <label class="custom-control-label" for="is_notify_on_expire">Please check if is notify on expire</label>
            </div>
            <div class="invalid-feedback" id="_help_input_is_notify_on_expire">{{ $errors->has('is_notify_on_expire')? $errors->first('is_notify_on_expire'): null }}</div>
        </div>
        <!----- End form field is_notify_on_expire ----->
        <!----- Start form field is_notify_on_order ----->
        <div class="form-group">
            <label class="mb-1" for="is_notify_on_order">Is Notify On Order</label>
            <div class="custom-control custom-switch {{ $errors->has('is_notify_on_order')? 'is-invalid': null }}">
                <input type="checkbox" class="custom-control-input" id="is_notify_on_order" name="is_notify_on_order" id="_input_is_notify_on_order" {{ ($model_info->is_notify_on_order)? 'checked':null }}>
                <label class="custom-control-label" for="is_notify_on_order">Please check if is notify on order</label>
            </div>
            <div class="invalid-feedback" id="_help_input_is_notify_on_order">{{ $errors->has('is_notify_on_order')? $errors->first('is_notify_on_order'): null }}</div>
        </div>
        <!----- End form field is_notify_on_order ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
