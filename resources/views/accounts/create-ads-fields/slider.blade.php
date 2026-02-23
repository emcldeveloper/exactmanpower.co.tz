@php
$old_value = (is_array(old('elements')) && isset(old('elements')[$row->category_element_id]))? old('elements')[$row->category_element_id]: null;
@endphp
<!----- Start form field {{ $row->name }} ----->
<div class="form-group">
    @component('accounts.create-ads-fields.__label', ['row'=>$row])@endcomponent
    <input type="range" class="custom-range {{ $errors->has('elements.'.$row->category_element_id)? 'is-invalid': null }}" name="elements[{{ $row->category_element_id }}]" min="0" max="5" step="0.5" value="{{ $old_value }}" placeholder="{{ $row->title }}" id="elements[{{ $row->category_element_id }}]">
    @component('accounts.create-ads-fields.__error', ['row'=>$row])@endcomponent
</div>
<!----- End form field {{ $row->name }} ----->