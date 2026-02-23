<!----- Start form field {{ $row->category_element_id }} ----->
<div class="form-group">
    @component('accounts.create-ads-fields.__label', ['row'=>$row])@endcomponent
    <div class="custom-file {{ $errors->has('elements.'.$row->category_element_id)? 'is-invalid': null }}">
        <input type="file" name="elements[{{ $row->category_element_id }}]" value="{{ old('elements.'.$row->category_element_id)?  }}" class="custom-file-input" id="elements[file-{{ $row->category_element_id }}]">
        <label class="custom-file-label" for="elements[file-{{ $row->category_element_id }}]">Choose {{ strtolower($row->title) }} file</label>
    </div>
    @component('accounts.create-ads-fields.__error', ['row'=>$row])@endcomponent
</div>
<!----- End form field {{ $row->category_element_id }} ----->