  

<form action="{{ url('admin/logs/logs/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
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
        <!----- Start form field url ----->
        <div class="form-group">
            <label class="mb-1" for="url">Url</label>
            <input type="text" class="form-control {{ $errors->has('url')? 'is-invalid': null }}" name="url" value="{{ $model_info->url }}" placeholder="Url" id="_input_url">
            <div class="invalid-feedback" id="_help_input_url">{{ $errors->has('url')? $errors->first('url'): null }}</div>
        </div>
        <!----- End form field url ----->
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
