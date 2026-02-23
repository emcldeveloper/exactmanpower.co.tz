 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
            <!----- Start form field account_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="account_id">Account</label>
                <select class="form-control col {{ $errors->has('account_id')? 'is-invalid': null }}" name="account_id" disabled>
                    <option value="">Please select account</option>
                    <option value="<new>">Add new account</option>
                    @foreach($accounts_list as $row)
                    <option value="{{ $row->account_id }}" {{ ( ($model_info->account_id == $row->account_id)? 'selected':null ) }}>{{ $row->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('account_id')? $errors->first('account_id'): null }}</div>
            </div>
            <!----- End form field account_id ----->
        
            <!----- Start form field title ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="title">Title</label>
                <input type="text" class="form-control col {{ $errors->has('title')? 'is-invalid': null }}" name="title" value="{{ $model_info->title }}" placeholder="Title" disabled>
                <div class="invalid-feedback">{{ $errors->has('title')? $errors->first('title'): null }}</div>
            </div>
            <!----- End form field title ----->
        
            <!----- Start form field content ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="content">Content</label>
                <textarea name="content" class="form-control col {{ $errors->has('content')? 'is-invalid': null }}" placeholder="Content" rows="4" disabled>{{ $model_info->content }}</textarea>
                <div class="invalid-feedback">{{ $errors->has('content')? $errors->first('content'): null }}</div>
            </div>
            <!----- End form field content ----->
        
            <!----- Start form field link ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="link">Link</label>
                <input type="text" class="form-control col {{ $errors->has('link')? 'is-invalid': null }}" name="link" value="{{ $model_info->link }}" placeholder="Link" disabled>
                <div class="invalid-feedback">{{ $errors->has('link')? $errors->first('link'): null }}</div>
            </div>
            <!----- End form field link ----->
        
            <!----- Start form field post_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="post_id">Post</label>
                <select class="form-control col {{ $errors->has('post_id')? 'is-invalid': null }}" name="post_id" disabled>
                    <option value="">Please select post</option>
                    <option value="<new>">Add new post</option>
                    @foreach($posts_list as $row)
                    <option value="{{ $row->post_id }}" {{ ( ($model_info->post_id == $row->post_id)? 'selected':null ) }}>{{ $row->post_title }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('post_id')? $errors->first('post_id'): null }}</div>
            </div>
            <!----- End form field post_id ----->
        
            <!----- Start form field type ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="type">Type</label>
                <div class="clearfix col">
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_0" name="type" value="0" {{ ($model_info->type == 0)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="type_0">Type Zero</span>
                    </label>
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_1" name="type" value="1" {{ ($model_info->type == 1)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="type_1">Type One</span>
                    </label>
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_2" name="type" value="2" {{ ($model_info->type == 2)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="type_2">Type Two</span>
                    </label>
                </div>
                <div class="invalid-feedback">{{ $errors->has('type')? $errors->first('type'): null }}</div>
            </div>
            <!----- End form field type ----->
        
            <!----- Start form field status ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="status">Status</label>
                <div class="clearfix col">
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_1" name="status" value="1" {{ ($model_info->status == 1)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="status_1">Active</span>
                    </label>
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_0" name="status" value="0" {{ ($model_info->status == 0)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="status_0">Inactive</span>
                    </label>
                    <label class="custom-control-inline custom-radio">
                        <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_2" name="status" value="2" {{ ($model_info->status == 2)? 'checked':null }} disabled>
                        <span class="custom-control-label" for="status_2">Banned</span>
                    </label>
                </div>
                <div class="invalid-feedback">{{ $errors->has('status')? $errors->first('status'): null }}</div>
            </div>
            <!----- End form field status ----->
        
            <!----- Start form field timestamp ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="timestamp">Timestamp</label>
                <input type="text" class="form-control col datepicker {{ $errors->has('timestamp')? 'is-invalid': null }}" name="timestamp" value="{{ $model_info->timestamp }}" placeholder="Timestamp" disabled>
                <div class="invalid-feedback">{{ $errors->has('timestamp')? $errors->first('timestamp'): null }}</div>
            </div>
            <!----- End form field timestamp ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/notifications/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>