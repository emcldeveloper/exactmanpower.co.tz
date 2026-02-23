@extends('permissions::layout')


@section('permissions-content')

<div class="card border-0 p-4 mb-4 ">
    <div class="w-100 mx-auto">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="mb-3">Permissions</h2>
            
        </div>
        <div class="clearfix text-left mb-3">
            {!! $model_info->get_profile_card() !!}
        </div>
        
        <form action="{{ url('permissions/user-assign/assign/'.$model_info->user_id) }}" method="POST">
            {{ csrf_field() }}

            <!----- Include view from components/alert----->
            @component('components.alert')@endcomponent
            <!----- End include view from components/alert----->

            <div class="clearfix">
                <!----- Start form field group_id ----->
                <div class="form-group">
                    <label class="font-weight-bold mb-1" for="group_id">
                        Role 
                        <!-- <a href="javascript:;" class="check-all text-light">Select all</a> / -->
                        <!-- <a href="javascript:;" class="uncheck-all text-light">Unselect all</a> -->
                    </label>
                    @if(false)
                    <div class="clearfix">
                        @if(isset($groups_list))
                        @foreach($groups_list as $row)
                        <div class="custom-control custom-radio custom-control-inline pl-0">
                            <input type="radio" class="custom-control-input" name="group_id" value="{{ $row->group_id }}" id="input-group-{{ $row->group_id }}" {{ ($model_info->group && $model_info->group->group_id == $row->group_id)? 'checked':null }}>
                            <label class="custom-control-label pt-0" for="input-group-{{ $row->group_id }}">{{ $row->name }}</label>
                        </div>
                        @endforeach 
                        @endif
                    </div>
                    @endif
                    @if(true)
                    <select class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="group_id" placeholder="Role" id="_input_group_id">
                        <option value="">Select role</option>
                        @if(isset($groups_list))
                        @foreach($groups_list as $row)
                            <option value="{{ $row->group_id }}" {{ ($model_info->group && $model_info->group->group_id == $row->group_id)? 'selected':null }}>{{ $row->name }}</option>
                        @endforeach 
                        @endif
                    </select>
                    @endif
                    <div class="invalid-feedback" id="_input_help_group_id">{{ $errors->has('group_id')? $errors->first('group_id'): null }}</div>
                </div>
                <!----- End form field group_id ----->
                
                <div class="form-group">
                    <label class="font-weight-bold mb-1" for="permissions_ids">
                        Other Permissions 
                        <a href="javascript:;" class="check-all text-light">Select all</a> /
                        <a href="javascript:;" class="uncheck-all text-light">Unselect all</a>
                    </label>
                    <div class="row" id="permissions-container" style="max-height:300px;overflow-y:auto;overflow-x:hidden;">
                    @if(false)
                    @php   
                        $selected_permissions = is_array(old('permissions'))? old('permissions'): ($model_info->permissions->pluck('permission_id')->toArray());
                    @endphp
                    @foreach($permissions_list as $row)
                        <div class="col-4">
                            <div class="custom-control custom-checkbox custom-control-inline pl-0">
                                <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $row->permission_id }}" id="permission-{{ $row->permission_id }}" {{ (in_array($row->permission_id, $selected_permissions))? 'checked':null }}>
                                <label class="custom-control-label pt-0" for="permission-{{ $row->permission_id }}">{{ $row->description }}</label>
                            </div>
                        </div>
                    @endforeach
                    @endif
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
var selected_permissions = {!! is_array(old('permissions'))? json_encode(old('permissions')): json_encode($model_info->user_permissions->pluck('permission_id')->toArray()) !!};
var permissions_list = {!! json_encode($permissions_list->toArray()) !!};
var group_permissions_list = {!! json_encode($group_permissions_list->toArray()) !!};
function groupPermissions(group_id) {
    var list = [];
    list = group_permissions_list.filter(function(elem, index, array){
        console.log(elem)
        if(elem.group_id == group_id) {
            return true;
        }

        return false;
    })

    list = list.map(function(elem, index, array){
        return elem.permission_id;
    });

    return list;
}
function permissionTemplate(group_id) {
    var html = '';
    var group_permissions_ids = groupPermissions(group_id);
    var selected_permissions_ids = selected_permissions;
    var permissions_ids = permissions_list.map(function(elem, index, array){
        return elem.permission_id;
    });

    for (const row of permissions_list) {
        html += `
        <div class="col-6">
            <div class="custom-control custom-checkbox custom-control-inline pl-0">
                <input type="checkbox" class="custom-control-input" name="permissions[]" value="${row.permission_id}" id="permission-${row.permission_id}" ${ (group_permissions_ids.includes(row.permission_id))? 'disabled checked': '' } ${ (selected_permissions_ids.includes(row.permission_id)? 'checked':'' ) }>
                <label class="custom-control-label pt-0" for="permission-${row.permission_id}">${row.description}</label>
            </div>
        </div>`;
    }

    return html;
}

jQuery(function(){

    jQuery('[name=group_id]').on('change', function(){
        console.log(this.value)
        var html = permissionTemplate(this.value);
        jQuery('#permissions-container').html(html);
    }).change();

    jQuery('.check-all').on('click', function(){
        jQuery('[name="permissions[]"').attr('checked', true);
    });

    jQuery('.uncheck-all').on('click', function(){
        jQuery('[name="permissions[]"').attr('checked', false);
    })
    
});

</script>
@endsection
