  

<form class="clearfix p-3" action="{{ url('admin/manage-ads/disclaimers/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    <div class="clearfix">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->
    
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
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
