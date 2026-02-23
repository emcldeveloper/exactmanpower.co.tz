 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
        <div class="row">
            <div class="col-6">
                <!----- Start form field name ----->
                <div class="form-group">
                    <label class="mb-1" for="name">Name</label>
                    <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" id="_input_name">
                    <div class="invalid-feedback" id="_help_input_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
                </div>
                <!----- End form field name ----->
            </div>
            <div class="col">
                <!----- Start form field price ----->
                <div class="form-group">
                    <label class="mb-1" for="price">Price</label>
                    <input type="text" class="form-control {{ $errors->has('price')? 'is-invalid': null }}" name="price" value="{{ $model_info->price }}" placeholder="Price" id="_input_price">
                    <div class="invalid-feedback" id="_help_input_price">{{ $errors->has('price')? $errors->first('price'): null }}</div>
                </div>
                <!----- End form field price ----->
            </div>
            <div class="col">
                <!----- Start form field days ----->
                <div class="form-group">
                    <label class="mb-1" for="days">Days</label>
                    <input type="text" class="form-control {{ $errors->has('days')? 'is-invalid': null }}" name="days" value="{{ $model_info->days }}" placeholder="days" id="_input_days">
                    <div class="invalid-feedback" id="_help_input_days">{{ $errors->has('days')? $errors->first('days'): null }}</div>
                </div>
                <!----- End form field days ----->
            </div>
        </div>

        <!----- Start form field descriptions ----->
        <div class="form-group">
            <label class="mb-1" for="descriptions">Descriptions</label>
            <textarea type="text" class="form-control {{ $errors->has('descriptions')? 'is-invalid': null }}" name="descriptions" placeholder="Descriptions" id="_input_descriptions">{{ $model_info->descriptions }}</textarea>
            <div class="invalid-feedback" id="_help_input_descriptions">{{ $errors->has('descriptions')? $errors->first('descriptions'): null }}</div>
        </div>
        <!----- End form field descriptions ----->
        
        <!----- Start form field featured_url ----->
        <div class="form-group">
            <label class="font-weight-bold mb-1" for="featured_url">Featured Image</label>
            <div class="custom-file">
                <input name="featured_url" type="file" class="custom-file-input" id="_input_featured_url">
                <label class="custom-file-label" for="_input_featured_url">Choose featured image file</label>
            </div>
            <div class="invalid-feedback" id="_help_input_featured_url">{{ $errors->has('featured_url')? $errors->first('featured_url'): null }}</div>
        </div>
        <!----- End form field featured_url ----->
    
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
    
        <!----- Link to the edit page ----->
        <a class="btn btn-success" href="{{ url('admin/manage-ads/packages/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>