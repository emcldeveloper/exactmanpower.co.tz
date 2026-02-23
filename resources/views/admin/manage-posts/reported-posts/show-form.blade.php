 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
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
        
            <!----- Start form field reported_by ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="reported_by">Reported By</label>
                <input type="text" class="form-control col {{ $errors->has('reported_by')? 'is-invalid': null }}" name="reported_by" value="{{ $model_info->reported_by }}" placeholder="Reported By" disabled>
                <div class="invalid-feedback">{{ $errors->has('reported_by')? $errors->first('reported_by'): null }}</div>
            </div>
            <!----- End form field reported_by ----->
        
            <!----- Start form field reported_time ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="reported_time">Reported Time</label>
                <input type="text" class="form-control col datepicker {{ $errors->has('reported_time')? 'is-invalid': null }}" name="reported_time" value="{{ $model_info->reported_time }}" placeholder="Reported Time" disabled>
                <div class="invalid-feedback">{{ $errors->has('reported_time')? $errors->first('reported_time'): null }}</div>
            </div>
            <!----- End form field reported_time ----->
        
            <!----- Start form field notes ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="notes">Notes</label>
                <textarea name="notes" class="form-control col {{ $errors->has('notes')? 'is-invalid': null }}" placeholder="Notes" rows="4" disabled>{{ $model_info->notes }}</textarea>
                <div class="invalid-feedback">{{ $errors->has('notes')? $errors->first('notes'): null }}</div>
            </div>
            <!----- End form field notes ----->
        
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
        
            <!----- Start form field is_cleared ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="is_cleared">Is Cleared</label>
                <div class="clearfix col">
                    <div class="custom-control custom-switch {{ $errors->has('is_cleared')? 'is-invalid': null }}">
                        <input type="checkbox" class="custom-control-input" id="is_cleared" name="is_cleared" {{ ($model_info->is_cleared)? 'checked':null }} disabled>
                        <label class="custom-control-label" for="is_cleared">Please check if is cleared</label>
                    </div>
                </div>
                <div class="invalid-feedback">{{ $errors->has('is_cleared')? $errors->first('is_cleared'): null }}</div>
            </div>
            <!----- End form field is_cleared ----->
        
            <!----- Start form field cleared_by ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="cleared_by">Cleared By</label>
                <input type="text" class="form-control col {{ $errors->has('cleared_by')? 'is-invalid': null }}" name="cleared_by" value="{{ $model_info->cleared_by }}" placeholder="Cleared By" disabled>
                <div class="invalid-feedback">{{ $errors->has('cleared_by')? $errors->first('cleared_by'): null }}</div>
            </div>
            <!----- End form field cleared_by ----->
        
            <!----- Start form field cleared_at ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="cleared_at">Cleared Time</label>
                <input type="text" class="form-control col {{ $errors->has('cleared_at')? 'is-invalid': null }}" name="cleared_at" value="{{ $model_info->cleared_at }}" placeholder="Cleared Time" disabled>
                <div class="invalid-feedback">{{ $errors->has('cleared_at')? $errors->first('cleared_at'): null }}</div>
            </div>
            <!----- End form field cleared_at ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/manage-posts/reported-posts/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>