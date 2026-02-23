  

<form action="{{ url('admin/settings/tag-types/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->

    <div class="clearfix">
        <!----- Start form field post_type_id ----->
        @if(!in_array("post_type_id", $hidden))
        <div class="form-group">
            <label class="mb-1" for="post_type_id">Post Type</label>
            <select class="form-control {{ $errors->has('post_type_id')? 'is-invalid': null }}" name="post_type_id" id="_input_post_type_id">
                <option value="">Please select post type</option>
                <option value="<new>">Add new post type</option>
                @foreach($post_types_list as $row)
                <option value="{{ $row->post_type_id }}" {{ ( ($model_info->post_type_id == $row->post_type_id)? 'selected':null ) }}>{{ $row->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="_help_input_post_type_id">{{ $errors->has('post_type_id')? $errors->first('post_type_id'): null }}</div>
        </div>
        @endif
        <!----- End form field post_type_id ----->
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" id="_input_name">
            <div class="invalid-feedback" id="_help_input_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
