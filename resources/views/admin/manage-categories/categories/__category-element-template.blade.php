window.form_children_input_template['insert_item_category_elements_list'] = function(i, randam_id, data, error, open){ 
    if(!randam_id) {
        randam_id = Math.random().toString().substr(2) + i;
    }

    var options = [];
    if(Array.isArray(data.category_element_options)) {
        options = data.category_element_options.map(function(elem, i){
            return elem.label;
        })
    }
    
    var str = `
<div class="field-section">
    <div class="card-header bg-white" id="heading_${randam_id}">
        <div class="question-number ">${(i + 1)}</div>
        <h2 class="mb-0">
            <button style="font-size: 1rem;" class="btn btn-link text-dark font-weight-bold ml-4" type="button" data-toggle="collapse" data-target="#collapse_${randam_id}" aria-expanded="true" aria-controls="collapse_${randam_id}">
                Field #${(i + 1)}
            </button>
        </h2>
    </div>

    <div id="collapse_${randam_id}" class="collapse ${(open)? 'show': ''}" aria-labelledby="heading_${randam_id}" data-parent="#accordionCategoryElements">
        <div class="card-body pb-1">
            <div class="by-none pb-0">
                <div class="form-group row">
                    <div class="form-control-label text-right col-3">Alias</div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-7">
                                <input name="category_elements[${randam_id}][title]" value="${(data.title)? data.title: ''}" class="form-control ${ ((error && error.title)? 'is-invalid': '') }" placeholder="Keyword" >
                            </div>
                            <div class="col-5">
                            
                                <div class="form-control border-0 bg-transparent">
                                    <div class="custom-control custom-switch ${ (error && error.is_mandatory)? 'is-invalid': '' }">
                                        <input name="category_elements[${randam_id}][is_mandatory]" type="checkbox" class="custom-control-input" id="category_elements_${randam_id}_is_mandatory" ${ ((data.is_mandatory == 'on')? 'checked':'') }>
                                        <label class="custom-control-label" for="category_elements_${randam_id}_is_mandatory">Mandatory</label>
                                    </div>
                                    <i class="fa fa-star fa-sm text-danger mandatory mandatory-q"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="form-control-label text-right col-3">Messages</div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-control-label mb-1">Info</div>
                                    <textarea name="category_elements[${randam_id}][info_message]" rows="2" class="form-control ${ ((error && error.info_message)? 'is-invalid': '') }" placeholder="Question help content">${(data.info_message)? data.info_message: ''}</textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-control-label mb-1">Error</div>
                                    <textarea name="category_elements[${randam_id}][error_message]" rows="2" class="form-control ${ ((error && error.error_message)? 'is-invalid': '') }" placeholder="Question help content">${(data.info_message)? data.error_message: ''}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-control-label mb-1">Warning</div>
                                    <textarea name="category_elements[${randam_id}][warning_message]" rows="2" class="form-control ${ ((error && error.warning_message)? 'is-invalid': '') }" placeholder="Question help content">${(data.info_message)? data.warning_message: ''}</textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-control-label mb-1">Success</div>
                                    <textarea name="category_elements[${randam_id}][success_message]" rows="2" class="form-control ${ ((error && error.success_message)? 'is-invalid': '') }" placeholder="Question help content">${(data.info_message)? data.success_message: ''}</textarea>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="form-group row">
                    <div class="form-control-label text-right col-3">Type</div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-8">
                                <select name="category_elements[${randam_id}][input_type]" class="form-control ${ ((error && error.input_type)? 'is-invalid': '') }">
                                    <option value="">Please select input type</option>
                                    <option value="TEXT" ${(data.input_type == 'TEXT')? 'selected': ''}>TEXT</option>
                                    <option value="NUMBER" ${(data.input_type == 'NUMBER')? 'selected': ''}>NUMBER</option>
                                    <option value="SELECT" ${(data.input_type == 'SELECT')? 'selected': ''}>SELECT</option>
                                    <option value="CHECKBOX" ${(data.input_type == 'CHECKBOX')? 'selected': ''}>CHECKBOX</option>
                                    <option value="RADIO" ${(data.input_type == 'RADIO')? 'selected': ''}>RADIO</option>
                                    <option value="TEXTAREA" ${(data.input_type == 'TEXTAREA')? 'selected': ''}>TEXTAREA</option>
                                    <option value="SWITCH" ${(data.input_type == 'SWITCH')? 'selected': ''}>SWITCH</option>
                                    <option value="SLIDER" ${(data.input_type == 'SLIDER')? 'selected': ''}>SLIDER</option>
                                    <option value="TAGS" ${(data.input_type == 'TAGS')? 'selected': ''}>TAGS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group row mb-0">
                    <div class="form-control-label text-right col-3">Settings</div>
                    <div class="col-9" >
                        <div class="type-conteiner" style="min-height:50px;">
                            <div data-type="text" class="open">
                                <div class="form-group">
                                    <select name="category_elements[${randam_id}][content_type]" class="form-control ${ ((error && error.content_type)? 'is-invalid': '') }">
                                        <!-- <option value="">Please select content type</option> -->
                                        <option value="STRING" ${(data.content_type == 'STRING')? 'selected': ''}>STRING</option>
                                        <option value="INTEGER" ${(data.content_type == 'INTEGER')? 'selected': ''}>INTEGER</option>
                                        <option value="FLOAT" ${(data.content_type == 'FLOAT')? 'selected': ''}>FLOAT</option>
                                        <option value="DOUBLE" ${(data.content_type == 'DOUBLE')? 'selected': ''}>DOUBLE</option>
                                        <option value="TEXT" ${(data.content_type == 'TEXT')? 'selected': ''}>TEXT</option>
                                        <option value="BOOLEAN" ${(data.content_type == 'BOOLEAN')? 'selected': ''}>BOOLEAN</option>
                                        <option value="DATE" ${(data.content_type == 'DATE')? 'selected': ''}>DATE</option>
                                        <option value="TIME" ${(data.content_type == 'TIME')? 'selected': ''}>TIME</option>
                                        <option value="TIMESTAMP" ${(data.content_type == 'TIMESTAMP')? 'selected': ''}>TIMESTAMP</option>
                                        <option value="DECIMAL" ${(data.content_type == 'DECIMAL')? 'selected': ''}>DECIMAL</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Length</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][length]" value="${(data.length)? data.length: ''}" class="form-control ${ ((error && error.length)? 'is-invalid': '') }" placeholder="Length">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Default value</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][default_value]" value="${(data.default_value)? data.default_value: ''}" class="form-control ${ ((error && error.default_value)? 'is-invalid': '') }" placeholder="Default value">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">min</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][minimum]" value="${(data.minimum)? data.minimum: ''}" class="form-control ${ ((error && error.minimum)? 'is-invalid': '') }" placeholder="Minimum">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">max</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][maximum]" value="${(data.maximum)? data.maximum: ''}" class="form-control ${ ((error && error.maximum)? 'is-invalid': '') }" placeholder="Muximum">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-type="number">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Length</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][length]" value="${(data.length)? data.length: ''}" class="form-control ${ ((error && error.length)? 'is-invalid': '') }" placeholder="Length">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Default value</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][default_value]" value="${(data.default_value)? data.default_value: ''}" class="form-control ${ ((error && error.default_value)? 'is-invalid': '') }" placeholder="Default value">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">min</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][minimum]" value="${(data.minimum)? data.minimum: ''}" class="form-control ${ ((error && error.minimum)? 'is-invalid': '') }" placeholder="Minimum">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">max</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][maximum]" value="${(data.maximum)? data.maximum: ''}" class="form-control ${ ((error && error.maximum)? 'is-invalid': '') }" placeholder="Muximum">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-type="select">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Options</span>
                                    </div>
                                    <input type="text"  name="category_elements[${randam_id}][options]" value="${ options.join(';') }" class="form-control ${ ((error && error.options)? 'is-invalid': '') } tags-input" placeholder="Options">
                                </div>
                                <div class="form-control border-0 bg-transparent">
                                    <div class="custom-control custom-switch ${ (error && error.is_multiple)? 'is-invalid': '' }">
                                        <input name="category_elements[${randam_id}][is_multiple]" type="checkbox" class="custom-control-input" id="category_elements_${randam_id}_is_multiple" ${ ((data.is_multiple == 'on')? 'checked':'') }>
                                        <label class="custom-control-label" for="category_elements_${randam_id}_is_multiple">Is multiple selection</label>
                                    </div>
                                </div>
                            </div>
                            <div data-type="checkbox">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Default value</span>
                                            </div>
                                            <select name="category_elements[${randam_id}][default_value]" class="form-control ${ ((error && error.default_value)? 'is-invalid': '') }">
                                                <option value="${(data.default_value == "unchecked")? 'selected': ''}">Unchecked</option>
                                                <option value="${(data.default_value == "checked")? 'selected': ''}">Checked</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-type="radio">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Default value</span>
                                            </div>
                                            <select name="category_elements[${randam_id}][default_value]" class="form-control ${ ((error && error.default_value)? 'is-invalid': '') }">
                                                <option value="${(data.default_value == "unchecked")? 'selected': ''}">Unchecked</option>
                                                <option value="${(data.default_value == "checked")? 'selected': ''}">Checked</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-type="textarea">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Length</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][length]" value="${(data.length)? data.length: ''}" class="form-control ${ ((error && error.length)? 'is-invalid': '') }" placeholder="Length">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Default value</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][default_value]" value="${(data.default_value)? data.default_value: ''}" class="form-control ${ ((error && error.default_value)? 'is-invalid': '') }" placeholder="Default value">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">min</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][minimum]" value="${(data.minimum)? data.minimum: ''}" class="form-control ${ ((error && error.minimum)? 'is-invalid': '') }" placeholder="Minimum">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">max</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][maximum]" value="${(data.maximum)? data.maximum: ''}" class="form-control ${ ((error && error.maximum)? 'is-invalid': '') }" placeholder="Muximum">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-type="switch">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Default value</span>
                                            </div>
                                            <select name="category_elements[${randam_id}][default_value]" class="form-control ${ ((error && error.default_value)? 'is-invalid': '') }">
                                                <option value="${(data.default_value == "unchecked")? 'selected': ''}">Unchecked</option>
                                                <option value="${(data.default_value == "checked")? 'selected': ''}">Checked</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-type="slider">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">min</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][minimum]" value="${(data.minimum)? data.minimum: ''}" class="form-control ${ ((error && error.minimum)? 'is-invalid': '') }" placeholder="Minimum">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">max</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][maximum]" value="${(data.maximum)? data.maximum: ''}" class="form-control ${ ((error && error.maximum)? 'is-invalid': '') }" placeholder="Muximum">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Default value</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][default_value]" value="${(data.default_value)? data.default_value: ''}" class="form-control ${ ((error && error.default_value)? 'is-invalid': '') }" placeholder="Default value">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Steps</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][length]" value="${(data.length)? data.length: ''}" class="form-control ${ ((error && error.length)? 'is-invalid': '') }" placeholder="Length">
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                            <div data-type="tags">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Length</span>
                                            </div>
                                            <input type="text" name="category_elements[${randam_id}][length]" value="${(data.length)? data.length: ''}" class="form-control ${ ((error && error.length)? 'is-invalid': '') }" placeholder="Length">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-left-0 border-right-0"> 
            <div class="btn-group btn-group-sm">
                <div class="btn alert-danger btn-delete px-4"><i class="fa fa-trash"></i></div>
                <!-- <div class="btn px-4"><i class="fa fa-arrows-v"></i></div> -->
                <!-- <div class="btn px-4"><i class="fa fa-file"></i></div> -->
                <!-- <div class="btn px-4"><i class="fa fa-link"></i> Add condition</div> -->
                <div class="btn alert-success border-right-0" data-toggle="collapse" data-target="#collapse_${randam_id}"><i class="fa fa-check"></i></div>
            </div>
        </div>
    </div>
</div>`;

    var item_obj = null;

    item_obj = document.createElement('DIV'); 
    item_obj.setAttribute('class', 'card question block-shadow question-closed mb-3');
    item_obj.innerHTML = str;

    

    return item_obj;
}


jQuery(function(){
    jQuery('#accordionCategoryElements').on('change', '[name*=input_type]', function(){
        var value = this.value.toLowerCase();
        var data_type = jQuery(this)
            .parents('.collapse')
            .find('[data-type=' + value + ']');

        if(data_type && data_type.length){
            data_type.addClass('open')
                .find('[name]')
                .removeAttr('disabled')
                .prevObject
                    .siblings('[data-type]')
                    .removeClass('open')
                    .find('[name]')
                    .attr('disabled', 'disabled');
        } else {
            jQuery(this).parents('.collapse')
                .find('[data-type]')
                .removeClass('open')
                .find('[name]')
                .attr('disabled', 'disabled');
        }
    })
})