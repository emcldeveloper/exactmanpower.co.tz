<div class="invalid-feedback" id="help-{{ $row->category_element_id }}">{{ $errors->has('elements.'.$row->category_element_id)? $errors->first('elements.'.$row->category_element_id): null }}</div>
