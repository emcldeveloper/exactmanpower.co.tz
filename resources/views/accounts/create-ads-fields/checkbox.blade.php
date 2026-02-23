@php
$old_value = (is_array(old('elements')) && isset(old('elements')[$row->name]))? old('elements')[$row->name]: null;
@endphp
<!----- Start form field {{ $row->name }} ----->
<div class="form-group">
    @component('accounts.create-ads-fields.__label', ['row'=>$row])@endcomponent
    <div class="custom-control custom-checkbox {{ $errors->has('elements.'.$row->category_element_id)? 'text-danger': null }}">
        <input type="checkbox" name="elements[{{ $row->category_element_id }}]" {{ ($old_value == 1 || $old_value == 'on')? 'checked':null }} class="custom-control-input" id="elements[input-{{ $row->category_element_id }}]">
        <label class="custom-control-label pt-1" for="elements[input-{{ $row->category_element_id }}]">{{ $row->sub_title }}</label>
    </div>
    @component('accounts.create-ads-fields.__error', ['row'=>$row])@endcomponent
</div>
<!----- End form field {{ $row->name }} ----->