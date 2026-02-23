 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
        

        <!----- Start form field details ----->
        <div class="form-group">
            <label class="mb-1" for="details">Details</label>
            <textarea type="text" class="form-control ckeditor {{ $errors->has('details')? 'is-invalid': null }}" name="details" placeholder="Details" id="_input_details">{{ $model_info->details }}</textarea>
            <div class="invalid-feedback" id="_help_input_details">{{ $errors->has('details')? $errors->first('details'): null }}</div>
        </div>
        <!----- End form field details ----->

        <div class="form-group">
            <label class="font-weight-bold mb-1" for="categories_ids">
                Categories assign 
                <a href="javascript:;" class="check-all text-light">Select all</a> /
                <a href="javascript:;" class="uncheck-all text-light">Unselect all</a>
            </label>
            <div class="row" style="max-height:300px;overflow:auto;">
            @php   
                $selected_categories = is_array(old('categories'))? old('categories'): ( ($model_info->categories->pluck('category_id')->toArray()) );
            @endphp
            @foreach($categories_list as $row)
                <div class="col-3 custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" name="categories[]" value="{{ $row->category_id }}" id="category-{{ $row->category_id }}" {{ (in_array($row->category_id, $selected_categories))? 'checked':null }}>
                    <label class="custom-control-label pt-0" for="category-{{ $row->category_id }}">{{ $row->name }}</label>
                </div>
            @endforeach
            </div>
            <div class="invalid-feedback" id="_input_help_categories_ids">{{ $errors->has('categories')? $errors->first('categories'): null }}</div>
        </div>
        
        <!----- Link to the edit page ----->
        <a class="btn btn-success" href="{{ url('admin/manage-ads/disclaimers/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
    </div>
</div>