@php
$old_value = (is_array(old('elements')) && isset(old('elements')[$row->category_element_id]))? old('elements')[$row->category_element_id]: null;
@endphp
<!----- Start form field {{ $row->name }} ----->
<div class="form-group">
    @component('accounts.create-ads-fields.__label', ['row'=>$row])@endcomponent
    <div class="input-group">
        @if($row->sub_title)
        <div class="input-group-prepend">
            <span class="input-group-text bg-light text-light px-4" id="basic-addon-{{ $row->category_element_id }}">{{ $row->sub_title }}</span>
        </div>
        @endif
        <input type="text" class="form-control {{ $errors->has('elements.'.$row->category_element_id)? 'is-invalid': null }}" name="elements[{{ $row->category_element_id }}]" value="{{ $old_value  }}" placeholder="{{ $row->title }}" id="elements[{{ $row->category_element_id }}]">
    </div>
    
    @component('accounts.create-ads-fields.__error', ['row'=>$row])@endcomponent
</div>
<!----- End form field {{ $row->name }} ----->