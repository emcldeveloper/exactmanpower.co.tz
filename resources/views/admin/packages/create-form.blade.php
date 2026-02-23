 
<form action="{{ url('admin/manage-ads/packages/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">
        
        <div class="row">
            <div class="col-6">
                <!----- Start form field name ----->
                <div class="form-group">
                    <label class="mb-1" for="name">Name</label>
                    <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ old('name') }}" placeholder="Name" id="_input_name">
                    <div class="invalid-feedback" id="_help_input_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
                </div>
                <!----- End form field name ----->
            </div>
            <div class="col">
                <!----- Start form field price ----->
                <div class="form-group">
                    <label class="mb-1" for="price">Price</label>
                    <input type="text" class="form-control {{ $errors->has('price')? 'is-invalid': null }}" name="price" value="{{ old('price') }}" placeholder="Price" id="_input_price">
                    <div class="invalid-feedback" id="_help_input_price">{{ $errors->has('price')? $errors->first('price'): null }}</div>
                </div>
                <!----- End form field price ----->
            </div>
            <div class="col">
                <!----- Start form field days ----->
                <div class="form-group">
                    <label class="mb-1" for="days">Days</label>
                    <input type="text" class="form-control {{ $errors->has('days')? 'is-invalid': null }}" name="days" value="{{ old('days') }}" placeholder="days" id="_input_days">
                    <div class="invalid-feedback" id="_help_input_days">{{ $errors->has('days')? $errors->first('days'): null }}</div>
                </div>
                <!----- End form field days ----->
            </div>
        </div>

        <!----- Start form field descriptions ----->
        <div class="form-group">
            <label class="mb-1" for="descriptions">Descriptions</label>
            <textarea type="text" class="form-control {{ $errors->has('descriptions')? 'is-invalid': null }}" name="descriptions" placeholder="Descriptions" id="_input_descriptions">{{ old('descriptions') }}</textarea>
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
        <div class="form-group">
            <label class="mb-1" for="status">Status</label>
            <div class="clearfix">
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_1" name="status" value="1" {{ (old('status') == 1)? 'checked':null }}>
                    <span class="custom-control-label" for="status_1">Active</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('status')? 'is-invalid': null }}" id="status_0" name="status" value="0" {{ (old('status') == 0)? 'checked':null }}>
                    <span class="custom-control-label" for="status_0">Inactive</span>
                </label>
            </div>
            <div class="invalid-feedback" id="_input_help_status">{{ $errors->has('status')? $errors->first('status'): null }}</div>
        </div>
        <!----- End form field status ----->
        
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 


</script>

