@extends('admin')

@section('title', 'Categories')

@section('content')


<div class="main-container-middle">
    <div class="container-sidebar bg-white border-left border-right">
        <div class="main-container-middle" id="sidebar_category_list">
            <div class="container-summary-sidebar border-bottom d-flex p-3">
                <div class="d-block">
                    <div class="h5 mb-3">
                    <!-- <a href="{{ url($route.'/list') }}" class="btn btn-outline-primary mr-3" title="Back to categories list"><i class="fas fa-arrow-left"></i></a> -->
                    <span>Categories</span>
                    </div>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-search">
                            <input class="form-control input-filter" type="search" placeholder="Search..." onkeyup="filterFunction()" />
                            <span class="input-group-append">
                                <button  class="btn">
                                    <i class="fa fa-search text-light"></i>
                                </button >
                            </span>
                        </div>
                    </div>

                    <div class="btn-block dropdown">
                        <button class="btn btn-primary btn-block" (click)="showFilter()"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </div>
            </div>
            <div class="container-detail text-dark">
                <div class="main-container-middle">
                    <div class="container-detail" scroll-container>
                        <div class="clearfix custom-list-group" >
                            @foreach ($model_list as $index => $row)
                            <div class="border-bottom custom-list-item p-2">
                                <div class="d-flex align-items-center mb-1">
                                    @if($row->get_icon_url())
                                    <img style="width:20px;" class=" mr-1" src="{{ $row->get_icon_url() }}">
                                    @endif
                                    <a class="d-block" href="{{ url($route.'/show/'.$row->id.( request('sub_page')? '/'.request('sub_page'): '' )) }}">{{ $row->name }}</a>
                                </div>
                                
                                <div class="font-italic text-light small">
                                Description of 
                                {{ $row->name }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-header" style="overflow:visible;">
        <div class="d-flex align-items-center justify-content-between p-3">
            <div class="h5 m-0">
                <span>Category info ( {{ $model_info->name }} )</span>
            </div>
            
            <div>
                <!-- <a href="{{ url($route.'/edit/'.$model_info->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt mr-1"></i> Edit</a> -->
                <a href="{{ url($route.'/create') }}" class="btn btn-dark"><i class="fas fa-plus-circle mr-1"></i> Add Category</a>
                <!-- <a href="{{ url($route.'/delete/'. $model_info->id) }}?redirect={{ url($route.'/list') }}" class="btn btn-danger" data-confirmation='I you sure, you want to delete "{{ $model_info->name }}"?'><i class="fas fa-trash mr-1"></i> Delete</a> -->
                <!-- <div class="d-inline-block dropdown">
                    <div class="btn-group dropdown" data-toggle="dropdown">
                        <div class="btn btn-primary " >
                            <i class="fas fa-plus-circle mr-1"></i> Add another
                        </div>
                        <div class="btn btn-primary">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right" id="dropdown-add-another">
                        <div class="dropdown-item" data-toggle="modal" data-target="#model_new_category_elements" >Add category element</div>
                        <div class="dropdown-item" data-toggle="modal" data-target="#model_new_posts" >Add post</div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="container-summary">
        <div class="px-3 py-2">
            <div class="d-flex justify-content-between" style="height:65px;">
                <div class="d-inline-block h5">notes</div>
                <div class="d-inline-block h5 pr-3">
                    <div class="border-left border-danger mb-3 pl-3" style="border-width: 5px !important;">
                        <span>12000000</span>
                        <span class="small font-italic text-light ml-2">Summary One</span>
                    </div>
                    <div class="border-left border-warning pl-3" style="border-width: 5px !important;">
                        <span>15220000</span>
                        <span class="small font-italic text-light ml-2">Summary Two</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-navbar bg-white border-bottom" style="overflow:visible;">
        <nav class="nav">
            
            <a class="nav-link h-100 {{ Request::is($route.'/show/'.$model_info->id)? 'active': null }}" href="{{ url($route.'/show/' . $model_info->id) }}">Information</a>
            <a class="nav-link {{ Request::is($route.'/show/*/category-elements')? 'active': null }}" href="{{ url($route.'/show/' . $model_info->id . '/category-elements') }}">Category Elements</a>
            <a class="nav-link {{ Request::is($route.'/show/*/categories')? 'active': null }}" href="{{ url($route.'/show/' . $model_info->id . '/categories') }}">Sub Categories</a>
            <a class="nav-link {{ Request::is($route.'/show/*/posts')? 'active': null }}" href="{{ url($route.'/show/' . $model_info->id . '/posts') }}">Ads</a>
        </nav>
    </div>
    <div class="container-detail bg-white">
        <div class="clearfix">
            {!! \App\Handlers\Admin\ManageCategory\Category\ShowFormHandler::handler(request(), new \App\Models\Category(), $model_info->id) !!}
        </div>
    </div>
</div>

<script>
function filterFunction() {
    
    var input, filter, ul, li, a, i, txtValue;
    console.log(this)
    input = document.querySelector('#sidebar_category_list .input-filter');
    filter = input.value.toUpperCase();
    ul = document.querySelector("#sidebar_category_list .custom-list-group");
    li = ul.querySelectorAll(".custom-list-item");

    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>


<script>
var active_modal = location.hash.substr(1);


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

            $this.insert_item(c, 0, null, {}, {}, i, true);
        });

        var list_key = jQuery(container).attr('data-children');
        var insert_key = "insert_item_" + list_key;
        var data_list = form_children_input_value[insert_key];
        var error_list = form_children_input_error[insert_key];
        var data_errors = {}

        if(error_list) {
            for (const key in error_list) {
                if (error_list.hasOwnProperty(key)) {
                    const elem = error_list[key];
                    const key_array = key.split('.');
                    if(!data_errors[key_array[1]]) data_errors[key_array[1]] = {};

                    data_errors[key_array[1]][key_array[2]] = elem[0];
                }
            }
        }

        console.log(data_errors)

        if(Array.isArray(data_list)){
            for (var i = 0; i < data_list.length; i++) {
                var elem_data = data_list[i];
                var elem_error = data_errors[i];
                $this.insert_item(container, i, null, elem_data, elem_error, insert_key, false);
            }
        } else if(data_list) {
            var count = 0;
            for (const random_id in data_list) {
                if (data_list.hasOwnProperty(random_id)) {
                    const elem_data = data_list[random_id];
                    const elem_error = (data_errors)? data_errors[random_id]: null;
                    $this.insert_item(container, count, random_id, elem_data, elem_error, insert_key, false);
                    count++;
                }
            }
        }
    }
}

formChildInput.prototype.insert_item = function(container, i, random_id, data, error, insert_key, open){
    // console.log(container);
    var template = '';
    var container_list = jQuery(container).find('.item-list').get(0);
    if(i == 0 && container_list){
        i = container_list.childElementCount;
    }

    if(typeof form_children_input_template[insert_key] == 'function') {
        template = form_children_input_template[insert_key](i, random_id, data, error, open)
    }

    var item_obj = null;

    if(typeof template == 'string') {
        item_obj = document.createElement('TR'); 
        item_obj.innerHTML = template;
    } else {
        item_obj = template;
    }
    
    if(container_list) {
        container_list.appendChild(item_obj);

        jQuery(item_obj).on('click', '.btn-delete', function(){
            if(container_list && item_obj){
                container_list.removeChild(item_obj);

                jQuery(container_list).children().each(function(index, elem, array){
                    jQuery(this).find('.question-number').html(index+1);
                })
            }
        });
    } else {
        console.log(container_list)
    }    
}

formChildInput().init();
</script>



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
if(typeof window.form_children_input_value == 'undefined') window.form_children_input_value = {};
if(typeof window.form_children_input_error == 'undefined') window.form_children_input_error = {};

function categoryFormChildInput() {
    if(! (this instanceof categoryFormChildInput)){
        return new categoryFormChildInput();
    }
}

categoryFormChildInput.prototype.init = function(){
    var $this = this;
    var containers_list = jQuery('[data-children]');

    for (const container of containers_list) {
        jQuery(container).on('click', '.add-item', function(){
            var c = jQuery(this).parent('[data-children]');
            var k = jQuery(c).attr('data-children');
            var i = "insert_item_" + k;

            $this.insert_item(c, 0, null, {}, {}, i, true);
        });

        var list_key = jQuery(container).attr('data-children');
        var insert_key = "insert_item_" + list_key;
        var data_list = form_children_input_value[insert_key];
        var error_list = form_children_input_error[insert_key];
        var data_errors = {}

        if(error_list) {
            for (const key in error_list) {
                if (error_list.hasOwnProperty(key)) {
                    const elem = error_list[key];
                    const key_array = key.split('.');
                    if(!data_errors[key_array[1]]) data_errors[key_array[1]] = {};

                    data_errors[key_array[1]][key_array[2]] = elem[0];
                }
            }
        }

        console.log(data_errors)

        if(Array.isArray(data_list)){
            for (var i = 0; i < data_list.length; i++) {
                var elem_data = data_list[i];
                var elem_error = data_errors[i];
                $this.insert_item(container, i, null, elem_data, elem_error, insert_key, false);
            }
        } else if(data_list) {
            var count = 0;
            for (const random_id in data_list) {
                if (data_list.hasOwnProperty(random_id)) {
                    const elem_data = data_list[random_id];
                    const elem_error = (data_errors)? data_errors[random_id]: null;
                    $this.insert_item(container, count, random_id, elem_data, elem_error, insert_key, false);
                    count++;
                }
            }
        }
    }
}

categoryFormChildInput.prototype.insert_item = function(container, i, random_id, data, error, insert_key, open){
    // console.log(container);
    var template = '';
    var container_list = jQuery(container).find('.item-list').get(0);
    if(i == 0 && container_list){
        i = container_list.childElementCount;
    }

    if(typeof form_children_input_template[insert_key] == 'function') {
        template = form_children_input_template[insert_key](i, random_id, data, error, open)
    }

    var item_obj = null;

    if(typeof template == 'string') {
        item_obj = document.createElement('TR'); 
        item_obj.innerHTML = template;
    } else {
        item_obj = template;
    }
    
    if(container_list) {
        container_list.appendChild(item_obj);

        jQuery(item_obj).on('click', '.btn-delete', function(){
            if(container_list && item_obj){
                container_list.removeChild(item_obj);

                jQuery(container_list).children().each(function(index, elem, array){
                    jQuery(this).find('.question-number').html(index+1);
                })
            }
        });
    } else {
        console.log(container_list)
    }    
}

// categoryFormChildInput().init();
</script>

@endsection
