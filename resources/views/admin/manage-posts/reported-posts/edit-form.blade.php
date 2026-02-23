  

<form action="{{ url('admin/manage-posts/reported-posts/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->

    <div class="clearfix">
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
        <!----- Start form field reported_by ----->
        <div class="form-group">
            <label class="mb-1" for="reported_by">Reported By</label>
            <input type="text" class="form-control {{ $errors->has('reported_by')? 'is-invalid': null }}" name="reported_by" value="{{ $model_info->reported_by }}" placeholder="Reported By" id="_input_reported_by">
            <div class="invalid-feedback" id="_help_input_reported_by">{{ $errors->has('reported_by')? $errors->first('reported_by'): null }}</div>
        </div>
        <!----- End form field reported_by ----->
        <!----- Start form field reported_time ----->
        <div class="form-group">
            <label class="mb-1" for="reported_time">Reported Time</label>
            <input type="text" class="form-control datepicker {{ $errors->has('reported_time')? 'is-invalid': null }}" name="reported_time" value="{{ $model_info->reported_time }}" placeholder="Reported Time" id="_input_reported_time">
            <div class="invalid-feedback" id="_help_input_reported_time">{{ $errors->has('reported_time')? $errors->first('reported_time'): null }}</div>
        </div>
        <!----- End form field reported_time ----->
        <!----- Start form field notes ----->
        <div class="form-group">
            <label class="mb-1" for="notes">Notes</label>
            <textarea name="notes" class="form-control {{ $errors->has('notes')? 'is-invalid': null }}" placeholder="Notes" rows="4" id="_input_notes">{{ $model_info->notes }}</textarea>
            <div class="invalid-feedback" id="_help_input_notes">{{ $errors->has('notes')? $errors->first('notes'): null }}</div>
        </div>
        <!----- End form field notes ----->
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
        <!----- Start form field is_cleared ----->
        <div class="form-group">
            <label class="mb-1" for="is_cleared">Is Cleared</label>
            <div class="custom-control custom-switch {{ $errors->has('is_cleared')? 'is-invalid': null }}">
                <input type="checkbox" class="custom-control-input" id="is_cleared" name="is_cleared" id="_input_is_cleared" {{ ($model_info->is_cleared)? 'checked':null }}>
                <label class="custom-control-label" for="is_cleared">Please check if is cleared</label>
            </div>
            <div class="invalid-feedback" id="_help_input_is_cleared">{{ $errors->has('is_cleared')? $errors->first('is_cleared'): null }}</div>
        </div>
        <!----- End form field is_cleared ----->
        <!----- Start form field cleared_by ----->
        <div class="form-group">
            <label class="mb-1" for="cleared_by">Cleared By</label>
            <input type="text" class="form-control {{ $errors->has('cleared_by')? 'is-invalid': null }}" name="cleared_by" value="{{ $model_info->cleared_by }}" placeholder="Cleared By" id="_input_cleared_by">
            <div class="invalid-feedback" id="_help_input_cleared_by">{{ $errors->has('cleared_by')? $errors->first('cleared_by'): null }}</div>
        </div>
        <!----- End form field cleared_by ----->
        <!----- Start form field cleared_at ----->
        <div class="form-group">
            <label class="mb-1" for="cleared_at">Cleared Time</label>
            <input type="text" class="form-control {{ $errors->has('cleared_at')? 'is-invalid': null }}" name="cleared_at" value="{{ $model_info->cleared_at }}" placeholder="Cleared Time" id="_input_cleared_at">
            <div class="invalid-feedback" id="_help_input_cleared_at">{{ $errors->has('cleared_at')? $errors->first('cleared_at'): null }}</div>
        </div>
        <!----- End form field cleared_at ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
