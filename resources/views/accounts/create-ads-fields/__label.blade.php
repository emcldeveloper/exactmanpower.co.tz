<label class="font-weight-bold mb-1" for="elements[{{ $row->category_element_id }}]" data-toggle="tooltip" data-placement="right" title="{{ $row->sub_title }}">
{{ $row->title }} 

@if($row->is_mandatory == 1)
<span class="text-primary">*</span>
@endif
</label>