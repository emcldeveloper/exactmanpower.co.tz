  

<form class="clearfix p-3" action="{{ url('admin/settings/locations/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    <div class="clearfix">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->
    
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" id="_input_name">
            <div class="invalid-feedback" id="_help_input_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
        <!----- Start form field parent_location_id ----->
        @if(!in_array("parent_location_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="parent_location_id">Parent Location</label>
            <select class="form-control {{ $errors->has('parent_location_id')? 'is-invalid': null }}" name="parent_location_id" id="_input_parent_location_id">
                <option value="">Please select parent location</option>
                <option value="<new>">Add new parent location</option>
                @foreach($locations_list as $row)
                <option value="{{ $row->parent_location_id }}" {{ ( ($model_info->parent_location_id == $row->parent_location_id)? 'selected':null ) }}>{{ $row->parent_location_id }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_parent_location_id">{{ $errors->has('parent_location_id')? $errors->first('parent_location_id'): null }}</div>
        </div>
        @endif
        <!----- End form field parent_location_id ----->
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
        <!----- Start form field latitude ----->
        <div class="form-group">
            <label class="mb-1" for="latitude">Latitude</label>
            <input type="text" class="form-control {{ $errors->has('latitude')? 'is-invalid': null }}" name="latitude" value="{{ $model_info->latitude }}" placeholder="Latitude" id="_input_latitude">
            <div class="invalid-feedback" id="_help_input_latitude">{{ $errors->has('latitude')? $errors->first('latitude'): null }}</div>
        </div>
        <!----- End form field latitude ----->
        <!----- Start form field longitude ----->
        <div class="form-group">
            <label class="mb-1" for="longitude">Longitude</label>
            <input type="text" class="form-control {{ $errors->has('longitude')? 'is-invalid': null }}" name="longitude" value="{{ $model_info->longitude }}" placeholder="Longitude" id="_input_longitude">
            <div class="invalid-feedback" id="_help_input_longitude">{{ $errors->has('longitude')? $errors->first('longitude'): null }}</div>
        </div>
        <!----- End form field longitude ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
