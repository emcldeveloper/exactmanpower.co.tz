<style>
.edit-form .question {
    position: relative;
}

.edit-form .question-number {
    position: absolute;
    height: 35px;
    width: 45px;
    line-height: 32px;
    font-size: 20px;
    background: #ff8000;
    text-align: center;
    vertical-align: middle;
    top: 14px;
    left: -20px;
    color: #fff;
    cursor: pointer;
    z-index: 9;
    border-radius: 4px;
}

.edit-form [data-type] {
    display: none;
}

.edit-form .open[data-type] {
    display: block;
}

.edit-form .accordion > .card {
    overflow: visible;
}

.edit-form .ng-invalid .question-number {
    background-color: #FA4034;
}

.edit-form .ng-valid .question-number {
    /*background-color: #B3C602;*/
    background-color: #7b7979;
}

.edit-form .question-open .question-number {
    background-color: #1b8bf9;
}


.edit-form .card-block {
    padding: 1rem 1.25rem;
}

.edit-form .form-control.name{
    font-weight: bold;
    color: inherit;
    font-size: 16px;
}


.edit-form .question-closed .form-control.name{
    border-color: transparent;
}

.edit-form .btn-group {
    height: 50px;
}

.edit-form .btn-group .btn {
    line-height: 36px;
    border-right: 1px solid rgba(0, 0, 0, 0.125);
}

.edit-form .btn-group .btn:last-child {
    /*border-right: none;*/
}

.edit-form .input-group-addon {
    display: inline;
    line-height: 1;
}

.edit-form .bx-none {
    border-left: none;
    border-right: none;
}

.edit-form .by-none {
    border-top: none;
    border-bottom: none;
}

.edit-form .mandatory {
    position: absolute;
    top: 10px;
    right: 26px;
    font-size: 10px;
}

.edit-form .mandatory-q {
    top: 8px;
}
</style>



<form class="edit-form" action="{{ url($route.'/update/'.$model_info->id.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <!----- Include view from components/alert ----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert ----->

    <div class="clearfix">
        <div class="row">
            <div class="col-12 col-lg-4">
                <!----- Start form field name ----->
                <div class="form-group">
                    <label class="mb-1" for="name">Name</label>
                    <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ $model_info->name }}" placeholder="Name" id="_input_name">
                    <div class="invalid-feedback" id="_input_help_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
                </div>
                <!----- End form field name ----->
            </div>

            <div class="col-12 col-lg-4">
                <!----- Start form field icon_url ----->
                <div class="form-group">
                    <label class="mb-1" for="icon_url"><img style="height:20px;" class="mr-2" src="{{ $model_info->get_icon_url() }}">Icon Url</label>
                    <div class="custom-file">
                        <input name="icon_url" type="file" class="custom-file-input {{ $errors->has('icon_url')? 'is-invalid': null }}"  id="_input_icon_url">
                        <label class="custom-file-label" for="_input_icon_url">Choose icon file</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_icon_url">{{ $errors->has('icon_url')? $errors->first('icon_url'): null }}</div>
                </div>
                <!----- End form field icon_url ----->
            </div>
            <div class="col-12 col-lg-4">
                <!----- Start form field image_url ----->
                <div class="form-group">
                    <label class="mb-1" for="image_url"><img style="width:30px;" class="border mr-2" src="{{ $model_info->get_image_url() }}"> Image Url</label>
                    <div class="custom-file">
                        <input name="image_url" type="file" class="custom-file-input {{ $errors->has('image_url')? 'is-invalid': null }}"  id="_input_image_url">
                        <label class="custom-file-label" for="_input_image_url">Choose image file</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_image_url">{{ $errors->has('image_url')? $errors->first('image_url'): null }}</div>
                </div>
                <!----- End form field image_url ----->
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="form-group">
                    <label class="mb-1" for="parent_category_id">Conditions</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Conditions</span>
                        </div>
                        <input type="text" class="form-control {{ $errors->has('conditions')? 'is-invalid': null }} tags-input " name="conditions" value="{{ implode(';', $model_info->conditions->pluck('label')->toArray()) }}" placeholder="Conditions" id="_input_conditions">
                    </div>
                    <div class="invalid-feedback" id="_input_help_conditions">{{ $errors->has('conditions')? $errors->first('conditions'): null }}</div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                @if(!isset($hidden) || (isset($hidden) && !in_array("parent_category_id", $hidden)))
                <div class="form-group">
                    <label class="mb-1" for="parent_category_id">Parent Category</label>
                    <select data-input-control="" class="form-control {{ $errors->has('parent_category_id')? 'is-invalid': null }}" name="parent_category_id" id="_input_parent_category_id">
                        <option value="">Please select parent category</option>
                        @foreach($categories_list as $row)
                        <option value="{{ $row->category_id }}" {{ ($model_info->parent_category_id == $row->category_id)? 'selected':null }}>{{ $row->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" id="_input_help_parent_category_id">{{ $errors->has('parent_category_id')? $errors->first('parent_category_id'): null }}</div>
                </div>
                @elseif(isset($parent_category_id) && !is_null($parent_category_id))
                <input type="hidden" name="parent_category_id" value="{{ $parent_category_id }}">
                @endif
            
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-12 col-lg-4">
                <!----- Start form field is_group ----->
                <div class="form-group">
                    <label class="mb-1" for="is_group">Is Group</label>
                    <div class="custom-control custom-switch {{ $errors->has('is_group')? 'is-invalid': null }}">
                        <input type="checkbox" class="custom-control-input" id="is_group" name="is_group" id="_input_is_group" {{ ($model_info->is_group)? 'checked':null }}>
                        <label class="custom-control-label" for="is_group">Please check if is group</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_is_group">{{ $errors->has('is_group')? $errors->first('is_group'): null }}</div>
                </div>
                <!----- End form field is_group ----->
            </div>
            <div class="col-12 col-lg-4">
                <!----- Start form field is_stared ----->
                <div class="form-group">
                    <label class="mb-1" for="is_stared">Is Stared</label>
                    <div class="custom-control custom-switch {{ $errors->has('is_stared')? 'is-invalid': null }}">
                        <input type="checkbox" class="custom-control-input" id="is_stared" name="is_stared" id="_input_is_stared" {{ ($model_info->is_stared)? 'checked':null }}>
                        <label class="custom-control-label" for="is_stared">Please check if is stared</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_is_stared">{{ $errors->has('is_stared')? $errors->first('is_stared'): null }}</div>
                </div>
                <!----- End form field is_stared ----->
            </div>
            
            
        </div>
        <!----- Start form field parent_category_id ----->
         
        <!----- End form field parent_category_id ----->
        
        <div class="clearfix mb-3 category-elements-item-container" data-children="category_elements_list">
            <h5>Category Fields: </h5>
            <div class="card p-5">
                <div class="ml-4">
                    <div class="accordion item-list mb-3" id="accordionCategoryElements">
                    </div>
                </div>
            
                <div class="btn btn-primary btn-block add-item mt-4"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new field</div>
            </div>
        </div>
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
    
</form>


<script>
function resetTagInput() {
    if(jQuery.fn.tagsInput) {
        console.log('tagsInput')
        jQuery('.tags-input').tagsInput({delimiter: ',', placeholder: 'Enter options ...',});
    }
}
jQuery(function(){
    resetTagInput();

    jQuery('#accordionCategoryElements').on('focus', '.tags-input', function(){
        jQuery(this).tagsInput({delimiter: ',', placeholder: 'Enter options ...',});
    })
})
</script>
<script>
if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {}; 
if(typeof window.form_children_input_value == 'undefined') window.form_children_input_value = {};
if(typeof window.form_children_input_error == 'undefined') window.form_children_input_error = {};

function formChildInput() {
    if(! (this instanceof formChildInput)){
        return new formChildInput();
    }
}

formChildInput.prototype.init = function(){
    var $this = this;
    var containers_list = jQuery('[data-children]');

    for (const container of containers_list) {
        var container_id = jQuery(container).attr('id');
        var list_key = jQuery(container).attr('data-children');
        var insert_key = "insert_item_" + list_key;
        var list = this[list_key];

        jQuery("#" + container_id + ' .add-item').click(function(){
            $this[insert_key](container, 0, {});
        });

        if(Array.isArray(list)){
            for (var i = 1; i < list.length; i++) {
                var elem = list[i];
                $this[insert_key](container, i, elem);
                jQuery(container).find('[name=input_type]').change();
            }
        }
    }
}

formChildInput().init();

function childInputControl(){
    if(! (this instanceof childInputControl)) {
        return new childInputControl();
    }
}

childInputControl.prototype.init = function() {
    jQuery('[data-input-control]').on('change', this, function(){
        var type = this.type;
        var elem = this.nodeName;
        // console.log(this)
        console.log(type)
        console.log(elem)
        // console.log(jQuery(this))


    });
}

childInputControl().init();

window.form_children_input_value['insert_item_category_elements_list'] = {!! (old('category_elements')? json_encode(old('category_elements')): (($model_info->category_elements)? json_encode($model_info->category_elements->toArray()): 'null')) !!};
window.form_children_input_error['insert_item_category_elements_list'] = {!! ($errors->get('category_elements.*')? json_encode($errors->get('category_elements.*')): 'null') !!};
@include('admin.manage-categories.categories.__category-element-template')


</script>
