@extends('admin')

@section('title', 'Tag Types')

@section('content')
<div class="main-container-middle">
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">
            <div class="h5 m-0">
                <a href="{{ url('admin/settings/tag-types/list') }}" class="btn btn-outline-primary mr-3" title="Back to tag types list"><i class="fas fa-arrow-left"></i></a>
                <span>Create tag type </span>
            </div>
            <div>
                <!-- <a href="{{ url('admin/settings/tag-types/list') }}" class="btn btn-primary"><i class="fas fa-list mr-1"></i> List</a> -->
            </div>
        </div>
    </div>
    <div class="container-detail bg-white">
        <div class="p-3">
            {!! \App\Handlers\Admin\Setting\TagType\CreateFormHandler::handler(request()) !!}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="model_new_input_post_type_id" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" style="background:rgba(0,0,0,.2);">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-border">
            <div class="modal-header bg-white text-primary py-2">
                <h5 class="modal-title">New Post Types</h5>
                <button type="button" class="close py-1 my-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="clearfix">
                    {!! \App\Handlers\Admin\ManagePost\PostType\CreateFormHandler::handler(request(), null) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function ajaxForm() {
    if(! (this instanceof ajaxForm)){
        return new ajaxForm();
    }
}

ajaxForm.prototype.init = function(){
    var $this = this;
    jQuery('form select').on('change', this, function(){
        // console.log(this);
        this.resetOptions = $this.options;
        var value = jQuery(this).val();
        var elem_id = jQuery(this).attr('id');
        var elem_modal_id = '#model_new' + elem_id;
        $this.submit(elem_modal_id, this);

        if(value == '<new>' && elem_id) {
            this.selectedIndex = 0;
            jQuery(elem_modal_id).modal('show');
            jQuery(elem_modal_id + ' [type=reset]').on('click', this, function(){
                $this.reset_inputs(elem_modal_id);
            });

            jQuery(elem_modal_id + ' [value="<new>"]').addClass('d-none');
        }
    })
}

ajaxForm.prototype.options = function(data, selected_id){
    var str = '';

    for (const elem of data) {
        str += '<option value="' + elem.id + '"' + ( (selected_id == elem.id)? 'selected':'' ) + '>' + elem.name + '</option>';
    }

    this.html(str);
}

ajaxForm.prototype.submit = function(elem_modal_id, elem) {
    var $this = this;

    jQuery(elem_modal_id + " form").submit(function(e) {
        var form = jQuery(this);
        var data = form.serialize();
        var url = form.attr('action');

        $this.reset_inputs(elem_modal_id);
        jQuery.ajax({
            type: "POST",
            url: url,
            data: data, // serializes the form's elements.
            success: function(data){
                // console.log(data); // show response from the php script.
                
                if(data.errors){
                    $this.errors(elem_modal_id, data.errors);
                } else if(data.options_list){
                    elem.options(data.options_list, data.selected_id);
                    jQuery(elem_modal_id).modal('hide');
                    $this.reset_inputs(elem_modal_id, true);
                }
            },
            error: function(error){
                console.log(error)
                if(error.responseJSON){
                    alert(error.responseJSON.message)
                }
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
}

ajaxForm.prototype.errors = function(elem_modal_id, errors) {
    for (const key in errors) {
        if (errors.hasOwnProperty(key)) {
            const err = errors[key];
            var elem = jQuery(elem_modal_id + " #_input_" + key);
            var help_elem = jQuery(elem_modal_id + " #_input_help_" + key);
            if(elem) {
                elem.addClass('is-invalid'); 
            }

            if(help_elem && Array.isArray(err) && err.length) {
                help_elem.html(err.join(', '));
            }
        }
    }
}

ajaxForm.prototype.reset_inputs = function(modal_id, clear = false) {
    var elems_list = jQuery( modal_id + ' input,' + modal_id + ' textarea,' + modal_id + ' select' );

    for (const elem of elems_list) {
        jQuery(elem).removeClass('is-invalid');

        if(clear){
            jQuery(elem).val(null);
        }
    }
}

ajaxForm().init();

if(typeof window.form_children_input_template == 'undefined') window.form_children_input_template = {};

function formChildInput() {
    if(! (this instanceof formChildInput)){
        return new formChildInput();
    }
    
}

formChildInput.prototype.init = function(){
    var $this = this;
    var containers_list = jQuery('[data-children]');

    for (const container of containers_list) {
        jQuery(container).on('click', '.add-item', function(){
            var c = jQuery(this).parent('[data-children]');
            var k = jQuery(c).attr('data-children');
            var i = "insert_item_" + k;

            $this.insert_item(c, 0, {}, i);
        });

        var list_key = jQuery(container).attr('data-children');
        var insert_key = "insert_item_" + list_key;
        var list = $this[list_key];

        if(Array.isArray(list)){
            for (var i = 1; i < list.length; i++) {
                var elem = list[i];
                $this.insert_item(container, i, elem, insert_key);
            }
        }
    }
}

formChildInput.prototype.insert_item = function(container, i, data, insert_key){
    // console.log(container);
    var template = '';
    var container_list = jQuery(container).find('.item-list').get(0);
    if(i == 0 && container_list){
        i = container_list.childElementCount;
    }

    if(typeof form_children_input_template[insert_key] == 'function') {
        template = form_children_input_template[insert_key](i, data)
    }

    var item_obj = null;
    item_obj = document.createElement('TR'); 
    item_obj.innerHTML = template;

    console.log(item_obj)
    if(container_list) {
        container_list.appendChild(item_obj);

        jQuery(item_obj).on('click', '.btn-delete', function(){
            if(container_list && item_obj){
                container_list.removeChild(item_obj);
            }
        });
    } else {
        console.log(container_list)
    }    
}

formChildInput().init();
</script>

@endsection