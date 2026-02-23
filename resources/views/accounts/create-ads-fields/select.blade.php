@php
$old_value = (is_array(old('elements')) && isset(old('elements')[$row->category_element_id]))? old('elements')[$row->category_element_id]: null;
@endphp
<!----- Start form field {{ $row->category_element_id }} ----->
<div class="form-group">
    @component('accounts.create-ads-fields.__label', ['row'=>$row])@endcomponent
    <div class="input-group">
        @if($row->sub_title)
        <div class="input-group-prepend">
            <span class="input-group-text bg-light text-light px-4" id="basic_addon_{{ $row->category_element_id }}">{{ $row->sub_title }}</span>
        </div>
        @endif

        <select class="custom-select {{ $errors->has('elements.'.$row->category_element_id)? 'is-invalid': null }}" name="elements[{{ $row->category_element_id }}]" id="elements[{{ $row->category_element_id }}]">
            <option value="">Please select {{ strtolower($row->title) }}</option>
            @foreach($row->category_element_options as $value)
            <option value="{{ $value->category_element_option_id }}" {{ ($old_value == $value->category_element_option_id)? 'selected': null }}>{{ $value->label }}</option>
            @endforeach
        </select>
    </div>
    
    @component('accounts.create-ads-fields.__error', ['row'=>$row])@endcomponent
</div>
<!----- End form field {{ $row->category_element_id }} ----->
