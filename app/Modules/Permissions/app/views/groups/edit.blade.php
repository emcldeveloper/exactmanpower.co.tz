@extends('permissions::layout')


@section('permissions-content')

<div class="card border-0 p-4 mb-4 ">
    <div class="w-100 mx-auto">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="mb-3">Edit group</h2>
        </div>
        
        <form action="{{ url('permissions/groups/update/'.$model_info->group_id) }}" method="POST">
            {{ csrf_field() }}

            <!----- Include view from components/alert----->
            @component('components.alert')@endcomponent
            <!----- End include view from components/alert----->

            <div class="clearfix">
                <div class="row">
                    <div class="col-3">
                        <!----- Start form field name ----->
                        <div class="form-group">
                            <label class="mb-1" for="name">Name</label>
                            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" id="_input_name">
                            <div class="invalid-feedback" id="_input_help_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
                        </div>
                        <!----- End form field name ----->
                    </div>
                    <div class="col">
                        <!----- Start form field description ----->
                        <div class="form-group">
                            <label class="mb-1" for="description">Description</label>
                            <input type="text" class="form-control {{ $errors->has('description')? 'is-invalid': null }}" name="description" value="{{ $model_info->description }}" placeholder="Description" id="_input_description">
                            <div class="invalid-feedback" id="_input_help_description">{{ $errors->has('description')? $errors->first('description'): null }}</div>
                        </div>
                        <!----- End form field description ----->
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="font-weight-bold mb-1" for="permissions_ids">
                        Permissions 
                        <a href="javascript:;" class="check-all text-light">Select all</a> /
                        <a href="javascript:;" class="uncheck-all text-light">Unselect all</a>
                    </label>
                    <div class="row" style="max-height:300px;overflow:auto;">
                    @php   
                        $selected_permissions = is_array(old('permissions'))? old('permissions'): ($model_info->permissions->pluck('permission_id')->toArray());
                    @endphp
                    @foreach($permissions_list as $row)
                        <div class="col-6">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $row->permission_id }}" id="permission-{{ $row->permission_id }}" {{ (in_array($row->permission_id, $selected_permissions))? 'checked':null }}>
                                <label class="custom-control-label pt-0" for="permission-{{ $row->permission_id }}">{{ $row->description }}</label>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    <div class="invalid-feedback" id="_input_help_permissions_ids">{{ $errors->has('permissions')? $errors->first('permissions'): null }}</div>
                </div>
                
                
                <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
                <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
            </div>
        </form>
    </div>  
</div>


<script>

jQuery(function(){
    jQuery('.check-all').on('click', function(){
        jQuery('[name="permissions[]"').attr('checked', true);
    });

    jQuery('.uncheck-all').on('click', function(){
        jQuery('[name="permissions[]"').attr('checked', false);
    })
    
});

</script>
@endsection
