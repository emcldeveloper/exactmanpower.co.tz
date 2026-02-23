  

<form class="clearfix p-3" action="{{ url('admin/notifications/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    <div class="clearfix">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->
    
        <!----- Start form field account_id ----->
        @if(!in_array("account_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="account_id">Account</label>
            <select class="form-control {{ $errors->has('account_id')? 'is-invalid': null }}" name="account_id" id="_input_account_id">
                <option value="">Please select account</option>
                <option value="<new>">Add new account</option>
                @foreach($accounts_list as $row)
                <option value="{{ $row->account_id }}" {{ ( ($model_info->account_id == $row->account_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_account_id">{{ $errors->has('account_id')? $errors->first('account_id'): null }}</div>
        </div>
        @endif
        <!----- End form field account_id ----->
        <!----- Start form field title ----->
        <div class="form-group">
            <label class="mb-1" for="title">Title</label>
            <input type="text" class="form-control {{ $errors->has('title')? 'is-invalid': null }}" name="title" value="{{ $model_info->title }}" placeholder="Title" id="_input_title">
            <div class="invalid-feedback" id="_help_input_title">{{ $errors->has('title')? $errors->first('title'): null }}</div>
        </div>
        <!----- End form field title ----->
        <!----- Start form field content ----->
        <div class="form-group">
            <label class="mb-1" for="content">Content</label>
            <textarea name="content" class="form-control {{ $errors->has('content')? 'is-invalid': null }}" placeholder="Content" rows="4" id="_input_content">{{ $model_info->content }}</textarea>
            <div class="invalid-feedback" id="_help_input_content">{{ $errors->has('content')? $errors->first('content'): null }}</div>
        </div>
        <!----- End form field content ----->
        <!----- Start form field link ----->
        <div class="form-group">
            <label class="mb-1" for="link">Link</label>
            <input type="text" class="form-control {{ $errors->has('link')? 'is-invalid': null }}" name="link" value="{{ $model_info->link }}" placeholder="Link" id="_input_link">
            <div class="invalid-feedback" id="_help_input_link">{{ $errors->has('link')? $errors->first('link'): null }}</div>
        </div>
        <!----- End form field link ----->
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
        <!----- Start form field type ----->
        <div class="form-group">
            <label class="mb-1" for="type">Type</label>
            <div class="clearfix">
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_0" name="type" value="0" {{ ($model_info->type == 0)? 'checked':null }}>
                    <span class="custom-control-label" for="type_0">Type Zero</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_1" name="type" value="1" {{ ($model_info->type == 1)? 'checked':null }}>
                    <span class="custom-control-label" for="type_1">Type One</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_2" name="type" value="2" {{ ($model_info->type == 2)? 'checked':null }}>
                    <span class="custom-control-label" for="type_2">Type Two</span>
                </label>
            </div>
            <div class="invalid-feedback" id="_help_input_type">{{ $errors->has('type')? $errors->first('type'): null }}</div>
        </div>
        <!----- End form field type ----->
        <!----- Start form field status ----->
        <div class="form-group">
            <label class="mb-1" for="status">Status</label>
            <div class="clearfix">
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_1" name="status" value="1" {{ ($model_info->status == 1)? 'checked':null }}>
                    <span class="custom-control-label" for="status_1">Active</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_0" name="status" value="0" {{ ($model_info->status == 0)? 'checked':null }}>
                    <span class="custom-control-label" for="status_0">Inactive</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_2" name="status" value="2" {{ ($model_info->status == 2)? 'checked':null }}>
                    <span class="custom-control-label" for="status_2">Banned</span>
                </label>
            </div>
            <div class="invalid-feedback" id="_help_input_status">{{ $errors->has('status')? $errors->first('status'): null }}</div>
        </div>
        <!----- End form field status ----->
        <!----- Start form field timestamp ----->
        <div class="form-group">
            <label class="mb-1" for="timestamp">Timestamp</label>
            <input type="text" class="form-control datepicker {{ $errors->has('timestamp')? 'is-invalid': null }}" name="timestamp" value="{{ $model_info->timestamp }}" placeholder="Timestamp" id="_input_timestamp">
            <div class="invalid-feedback" id="_help_input_timestamp">{{ $errors->has('timestamp')? $errors->first('timestamp'): null }}</div>
        </div>
        <!----- End form field timestamp ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
