 
<form action="{{ url('admin/logs/logs/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">
        <!----- Start form field name ----->
        <div class="form-group">
            <label class="mb-1" for="name">Name</label>
            <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ old('name') }}" placeholder="Name" id="_input_name">
            <div class="invalid-feedback" id="_input_help_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
        
        <!----- Start form field url ----->
        <div class="form-group">
            <label class="mb-1" for="url">Url</label>
            <input type="text" class="form-control {{ $errors->has('url')? 'is-invalid': null }}" name="url" value="{{ old('url') }}" placeholder="Url" id="_input_url">
            <div class="invalid-feedback" id="_input_help_url">{{ $errors->has('url')? $errors->first('url'): null }}</div>
        </div>
        <!----- End form field url ----->
        
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 


</script>

