  

<form class="clearfix p-3" action="{{ url('admin/subscriptions/subscription-types/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
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
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Update</button>
    </div>
    
</form>
