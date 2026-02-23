 
<div class="clearfix p-3">

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->
    
    <div class="clearfix">
        
        <!----- Start form field name ----->
        <div class="form-group form-row">
            <label class="col-3 col-form-label" for="name">Name</label>
            <input type="text" class="form-control col {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" disabled>
            <div class="invalid-feedback">{{ $errors->has('name')? $errors->first('name'): null }}</div>
        </div>
        <!----- End form field name ----->
        
        <!----- Start form field locale ----->
        <div class="form-group form-row">
            <label class="col-3 col-form-label" for="locale">Locale</label>
            <input type="text" class="form-control col {{ $errors->has('locale')? 'is-invalid': null }}" name="locale" value="{{ $model_info->locale }}" placeholder="locale" id="_input_locale" disabled>
            <div class="invalid-feedback" id="_help_input_name">{{ $errors->has('locale')? $errors->first('locale'): null }}</div>
        </div>
        <!----- End form field locale ----->
    
        <!----- Link to the edit page ----->
        <!-- <a class="btn btn-success" href="{{ url('admin/setting/languages/show/'.$model_info->id.'/edit') }}"><i class="fas fa-pencil-alt mr-1"></i> Edit</a> -->
    </div>

    <h4> <label class="">Translations</label></h4>
    <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-primary">
            <tr>
                <th width="50">#</th>
                <th width="50">Group</th>
                <th>Item</th>
                <th>Sample</th>
                <th>Text</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($model_info->translations as $index => $row)
            <tr>
                <td scope="row">{{ ($index + 1) }}</td>
                <td>
                    {{ $row->group }}
                </td>
                <td>
                    {{ $row->item }}
                </td>
                <td>
                    {{ $row->descriptions }}
                </td>
                <td>
                    <div data-locale="{{ $row->locale }}-{{ $row->group }}-{{ $row->item }}">{{ $row->text }}</div>
                    <!-- <textarea >{{ $row->text }}</textarea> -->
                </td>
                <td class="text-right">
                    <div class="btn-group btn-group-sm">
                        <!-- <a href="{{ url('admin/setting/languages/show/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-file"></i> </a> -->
                        <!-- <a href="{{ url('admin/setting/languages/edit/'. $row->id) }}" class="btn px-1 py-0"> <i class="fas fa-pencil-alt"></i> </a> -->
                        <a href="{{ url('admin/setting/languages/delete/'. $row->id) }}?redirect={{ url()->full() }}" class="btn px-1 py-0 text-danger" data-confirmation='I you sure, you want to delete "{{ $row->name }}"?'> <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
var store_url = '{{url('admin/setting/languages/update-translation')}}';
jQuery(function(){
    
    jQuery('[data-locale]').attr('contenteditable', true);
    jQuery('[data-locale]').focusout(function(){
        var value = this.textContent;
        var data = this.dataset.locale;

        fetch(store_url, {
            method:'POST', 
            body:JSON.stringify({text:value,data:data}), 
            headers: {'Content-Type':'application/json', 'Accept':'application/json'}
        })
    })
})
</script>