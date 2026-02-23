  

<form enctype="multipart/form-data" class="clearfix p-3" action="{{ url('admin/settings/socials/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    <div class="clearfix">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->
    
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" id="_input_name">
            <div class="invalid-feedback" id="_help_input_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
        <!----- Start form field icon ----->
        <div class="form-group">
            <label class="font-weight-bold mb-1" for="icon">Icon</label>
            <div class="custom-file {{ $errors->has('icon')? 'is-invalid': null }}">
                <label class="custom-file-label" for="file-icon" data-browse="Bestand kiezen">{{ ($model_info->icon)? $model_info->icon: 'Browse' }}</label>
                <input name="icon" type="file" class="custom-file-input" id="file-icon">
            </div>
            <div class="invalid-feedback" id="_input_help_icon">{{ $errors->has('icon')? $errors->first('icon'): null }}</div>
        </div>
        <!----- End form field icon ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
