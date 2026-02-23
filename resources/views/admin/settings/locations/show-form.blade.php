 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
            <!----- Start form field name ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="name">Name</label>
                <input type="text" class="form-control col {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" disabled>
                <div class="invalid-feedback">{{ $errors->has('name')? $errors->first('name'): null }}</div>
            </div>
            <!----- End form field name ----->
        
            <!----- Start form field parent_location_id ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="parent_location_id">Parent Location</label>
                <select class="form-control col {{ $errors->has('parent_location_id')? 'is-invalid': null }}" name="parent_location_id" disabled>
                    <option value="">Please select parent location</option>
                    <option value="<new>">Add new parent location</option>
                    @foreach($locations_list as $row)
                    <option value="{{ $row->parent_location_id }}" {{ ( ($model_info->parent_location_id == $row->parent_location_id)? 'selected':null ) }}>{{ $row->parent_location_id }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->has('parent_location_id')? $errors->first('parent_location_id'): null }}</div>
            </div>
            <!----- End form field parent_location_id ----->
        
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
        
            <!----- Start form field latitude ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="latitude">Latitude</label>
                <input type="text" class="form-control col {{ $errors->has('latitude')? 'is-invalid': null }}" name="latitude" value="{{ $model_info->latitude }}" placeholder="Latitude" disabled>
                <div class="invalid-feedback">{{ $errors->has('latitude')? $errors->first('latitude'): null }}</div>
            </div>
            <!----- End form field latitude ----->
        
            <!----- Start form field longitude ----->
            <div class="form-group form-row">
                <label class="col-3 col-form-label" for="longitude">Longitude</label>
                <input type="text" class="form-control col {{ $errors->has('longitude')? 'is-invalid': null }}" name="longitude" value="{{ $model_info->longitude }}" placeholder="Longitude" disabled>
                <div class="invalid-feedback">{{ $errors->has('longitude')? $errors->first('longitude'): null }}</div>
            </div>
            <!----- End form field longitude ----->
        
            <!----- Link to the edit page ----->
            <a class="btn btn-success" href="{{ url('admin/settings/locations/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>