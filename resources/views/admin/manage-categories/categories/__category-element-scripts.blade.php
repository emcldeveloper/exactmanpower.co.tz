
function formChildInput() {
    if(! (this instanceof formChildInput)){
        return new formChildInput();
    }
}

formChildInput.prototype.init = function(){
    var $this = this;
    var containers_list = jQuery('[data-children]');
    console.log(containers_list)

    for (const container of containers_list) {
        jQuery(container).on('click', '.add-item', function(){
            var c = jQuery(this).parents('[data-children]');
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

        if(Array.isArray(data_list)){
            for (var i = 0; i < data_list.length; i++) {
                var elem_data = data_list[i];
                var elem_error = data_errors[i];
                var random_id = (elem_data && elem_data.category_element_id)? elem_data.category_element_id: null;
                $this.insert_item(container, i, random_id, elem_data, elem_error, insert_key, false);
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
        var setTitle = function(elem) {
            var title = jQuery(elem).val().trim();
            if(!title && title == '') {
                title = 'Field #' + (i+1);
            }

            var parent = jQuery(elem).parents('.collapse')
                .siblings('.card-header')
                .find('[data-toggle="collapse"]')
                .text(title);
        }
        container_list.appendChild(item_obj);
        // console.log(jQuery(select_elem));
        jQuery(item_obj).on('click', '.btn-delete', function(){
            if(container_list && item_obj){
                container_list.removeChild(item_obj);

                jQuery(container_list).children().each(function(index, elem, array){
                    jQuery(this).find('.question-number').html(index+1);
                })
            }
        });

        
        jQuery(item_obj).on('keyup', '[name$="[title]"]', function(){
            setTitle(this);
        });

        var select_elem = jQuery(item_obj).find('[name$="[input_type]"]');
        var select_title = jQuery(item_obj).find('[name$="[title]"]');
        setTimeout(function() {
            setTitle(select_title);
        }, 500);
        setTimeout(function() {
            jQuery(select_elem).change();
        }, 3000);
    } else {
        console.log(container_list)
    }    
}

formChildInput().init();