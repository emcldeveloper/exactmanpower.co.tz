  

<form action="{{ url('admin/settings/tags/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->

    <div class="clearfix">
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" id="_input_name">
            <div class="invalid-feedback" id="_help_input_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
        <!----- Start form field tag_type_id ----->
        @if(!in_array("tag_type_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="tag_type_id">Tag Type</label>
            <select class="form-control {{ $errors->has('tag_type_id')? 'is-invalid': null }}" name="tag_type_id" id="_input_tag_type_id">
                <option value="">Please select tag type</option>
                <option value="<new>">Add new tag type</option>
                @foreach($tag_types_list as $row)
                <option value="{{ $row->tag_type_id }}" {{ ( ($model_info->tag_type_id == $row->tag_type_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_tag_type_id">{{ $errors->has('tag_type_id')? $errors->first('tag_type_id'): null }}</div>
        </div>
        @endif
        <!----- End form field tag_type_id ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
