@php
$old_value = (is_array(old('elements')) && isset(old('elements')[$row->category_element_id]))? old('elements')[$row->category_element_id]: null;
@endphp
<!----- Start form field {{ $row->name }} ----->
<div class="form-group">
    @component('accounts.create-ads-fields.__label', ['row'=>$row])@endcomponent
    <textarea type="text" class="form-control {{ $errors->has('elements.'.$row->category_element_id)? 'is-invalid': null }}" name="elements[{{ $row->category_element_id }}]" placeholder="{{ $row->title }}" id="{{ $row->category_element_id }}">{{ $old_value }}</textarea>
    @component('accounts.create-ads-fields.__error', ['row'=>$row])@endcomponent
</div>
<!----- End form field {{ $row->name }} ----->