 
<style>
.item-list td,
.item-list th {
    padding-top:3px;
    padding-bottom:3px;
    padding-left:0px;
}

.item-list .form-control {
    background: none;
    border-color: transparent;
    border-bottom-color: gainsboro;
}
</style>
<form action="{{ url('admin/setting/locations/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ old('name') }}" placeholder="Name" id="_input_name">
            <div class="invalid-feedback" id="_input_help_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
        
        <!----- Start form field parent_location_id ----->
        @if(!isset($hidden) || (is_array($hidden) && !in_array("parent_location_id", $hidden)))
        <div class="form-group">
            <label class="mb-1" for="parent_location_id">Parent Location</label>
            <select class="form-control {{ $errors->has('parent_location_id')? 'is-invalid': null }}" name="parent_location_id" id="_input_parent_location_id">
                <option value="">Please select parent location</option>
                <option value="<new>">Add new parent location</option>
                @foreach($locations_list as $row)
                <option value="{{ $row->location_id }}" {{ ( (old('parent_location_id') == $row->location_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_input_help_parent_location_id">{{ $errors->has('parent_location_id')? $errors->first('parent_location_id'): null }}</div>
        </div>
        @elseif(isset($parent_location_id) && !is_null($parent_location_id))
        <input type="hidden" name="parent_location_id" value="{{ $parent_location_id }}">
        @endif
        <!----- End form field parent_location_id ----->
        
        <!----- Start form field type ----->
        <div class="form-group">
            <label class="mb-1" for="type">Type</label>
            <div class="clearfix">
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_0" name="type" value="0" {{ (old('type') == 0)? 'checked':null }}>
                    <span class="custom-control-label" for="type_0">Type Zero</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_1" name="type" value="1" {{ (old('type') == 1)? 'checked':null }}>
                    <span class="custom-control-label" for="type_1">Type One</span>
                </label>
                <label class="custom-control-inline custom-radio">
                    <input type="radio" class="custom-control-input {{ $errors->has('type')? 'is-invalid': null }}" id="type_2" name="type" value="2" {{ (old('type') == 2)? 'checked':null }}>
                    <span class="custom-control-label" for="type_2">Type Two</span>
                </label>
            </div>
            <div class="invalid-feedback" id="_input_help_type">{{ $errors->has('type')? $errors->first('type'): null }}</div>
        </div>
        <!----- End form field type ----->
        
        <!----- Start form field latitude ----->
        <div class="form-group">
            <label class="mb-1" for="latitude">Latitude</label>
            <input type="text" class="form-control {{ $errors->has('latitude')? 'is-invalid': null }}" name="latitude" value="{{ old('latitude') }}" placeholder="Latitude" id="_input_latitude">
            <div class="invalid-feedback" id="_input_help_latitude">{{ $errors->has('latitude')? $errors->first('latitude'): null }}</div>
        </div>
        <!----- End form field latitude ----->
        
        <!----- Start form field longitude ----->
        <div class="form-group">
            <label class="mb-1" for="longitude">Longitude</label>
            <input type="text" class="form-control {{ $errors->has('longitude')? 'is-invalid': null }}" name="longitude" value="{{ old('longitude') }}" placeholder="Longitude" id="_input_longitude">
            <div class="invalid-feedback" id="_input_help_longitude">{{ $errors->has('longitude')? $errors->first('longitude'): null }}</div>
        </div>
        <!----- End form field longitude ----->
        
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {};
if(typeof window.form_children_input_value == 'undefined') window.form_children_input_value = {};
if(typeof window.form_children_input_error == 'undefined') window.form_children_input_error = {};


</script>

