 
<form action="{{ url($route.'/store'.(isset($redirect)? '?redirect='.$redirect: null)) }}" method="POST">
    {{ csrf_field() }}

    <!----- Include view from components/alert----->
    @component('components.alert')@endcomponent
    <!----- End include view from components/alert----->

    <div class="clearfix">

        <div class="row">
            <div class="col-12 col-lg-4">
                <!----- Start form field name ----->
                <div class="form-group">
                    <label class="mb-1" for="name">Name</label>
                    <input type="text" class="form-control {{ $errors->has('name')? 'is-invalid': null }}" name="name" value="{{ old('name') }}" placeholder="Name" id="_input_name">
                    <div class="invalid-feedback" id="_input_help_name">{{ $errors->has('name')? $errors->first('name'): null }}</div>
                </div>
                <!----- End form field name ----->
            </div>

            <div class="col-12 col-lg-4">
                <!----- Start form field icon_url ----->
                <div class="form-group">
                    <label class="mb-1" for="icon_url">Icon Url</label>
                    <input type="text" class="form-control {{ $errors->has('icon_url')? 'is-invalid': null }}" name="icon_url" value="{{ old('icon_url') }}" placeholder="Icon Url" id="_input_icon_url">
                    <div class="invalid-feedback" id="_input_help_icon_url">{{ $errors->has('icon_url')? $errors->first('icon_url'): null }}</div>
                </div>
                <!----- End form field icon_url ----->
            </div>
            <div class="col-12 col-lg-4">
                <!----- Start form field image_url ----->
                <div class="form-group">
                    <label class="mb-1" for="image_url">Image Url</label>
                    <div class="custom-file">
                        <input name="image_url" type="file" class="custom-file-input"  id="_input_image_url">
                        <label class="custom-file-label" for="_input_image_url">Choose image url file</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_image_url">{{ $errors->has('image_url')? $errors->first('image_url'): null }}</div>
                </div>
                <!----- End form field image_url ----->
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-12 col-lg-4">
                <!----- Start form field is_group ----->
                <div class="form-group">
                    <label class="mb-1" for="is_group">Is Group</label>
                    <div class="custom-control custom-switch {{ $errors->has('is_group')? 'is-invalid': null }}">
                        <input type="checkbox" class="custom-control-input" id="is_group" name="is_group" id="_input_is_group" {{ old('is_group')? 'checked':null }}>
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
                        <input type="checkbox" class="custom-control-input" id="is_stared" name="is_stared" id="_input_is_stared" {{ old('is_stared')? 'checked':null }}>
                        <label class="custom-control-label" for="is_stared">Please check if is stared</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_is_stared">{{ $errors->has('is_stared')? $errors->first('is_stared'): null }}</div>
                </div>
                <!----- End form field is_stared ----->
            </div>
            <div class="col-12 col-lg-4">
                @if(!isset($hidden) || (isset($hidden) && !in_array("parent_category_id", $hidden)))
                <div class="form-group">
                    <label class="mb-1" for="parent_category_id">Parent Category</label>
                    <select data-input-control="" class="form-control {{ $errors->has('parent_category_id')? 'is-invalid': null }}" name="parent_category_id" id="_input_parent_category_id">
                        <option value="">Please select parent category</option>
                        <option value="<new>">Add new parent category</option>
                        @foreach($categories_list as $row)
                        <option value="{{ $row->parent_category_id }}" {{ ( (old('parent_category_id') == $row->parent_category_id)? 'selected':null ) }}>{{ $row->undefined }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" id="_input_help_parent_category_id">{{ $errors->has('parent_category_id')? $errors->first('parent_category_id'): null }}</div>
                </div>
                @elseif(isset($parent_category_id) && !is_null($parent_category_id))
                <input type="hidden" name="parent_category_id" value="{{ $parent_category_id }}">
                @endif
            
            </div>
        </div>
        <!----- Start form field parent_category_id ----->
        
        <!----- End form field parent_category_id ----->
        <style>
        .question {
            position: relative;
        }

        .question-number {
            position: absolute;
            height: 35px;
            width: 45px;
            line-height: 32px;
            font-size: 20px;
            background: #7b7979;
            text-align: center;
            vertical-align: middle;
            top: 15px;
            left: -20px;
            color: #fff;
            cursor: pointer;
            z-index: 9;
            border-radius: 4px;
        }

        .accordion > .card {
            overflow: visible;
        }

        .ng-invalid .question-number {
            background-color: #FA4034;
        }

        .ng-valid .question-number {
            /*background-color: #B3C602;*/
            background-color: #7b7979;
        }

        .question-open .question-number {
            background-color: #1b8bf9;
        }


        .card-block {
            padding: 1rem 1.25rem;
        }

        .form-control.name{
            font-weight: bold;
            color: inherit;
            font-size: 16px;
        }


        .question-closed .form-control.name{
            border-color: transparent;
        }

        .btn-group {
            height: 50px;
        }

        .btn-group .btn {
            line-height: 36px;
            border-right: 1px solid rgba(0, 0, 0, 0.125);
        }

        .btn-group .btn:last-child {
            /*border-right: none;*/
        }

        .input-group-addon {
            display: inline;
            line-height: 1;
        }

        .bx-none {
            border-left: none;
            border-right: none;
        }

        .by-none {
            border-top: none;
            border-bottom: none;
        }

        .mandatory {
            position: absolute;
            top: 10px;
            right: 26px;
            font-size: 10px;
        }

        .mandatory-q {
            top: 8px;
        }
        </style>
        <div class="ml-4">
            <div class="accordion mb-3" id="accordionExample">
                <div class="card question block-shadow question-closed mb-3">
                    <div class="card-header" id="headingOne">
                        <div class="question-number " (click)="openQuestionList(i)">{{ 1 }}</div>
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Collapsible Group Item #1
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div>
                                <div class="by-none pb-0">
                                    <div class="form-group row">
                                        <div class="form-control-label text-right col-4">Alias</div>
                                        <div class="col-8">
                                            <div class="row">
                                                <div class="col-7">
                                                    <input class="form-control" placeholder="Keyword" >
                                                </div>
                                                <div class="col-5">
                                                
                                                    <div class="form-control border-0">
                                                        <div class="custom-control custom-switch {{ $errors->has('is_mandatory')? 'is-invalid': null }}">
                                                            <input data-input-control="" type="checkbox" class="custom-control-input" id="is_mandatory" name="is_mandatory" id="_input_is_mandatory" {{ old('is_mandatory')? 'checked':null }}>
                                                            <label class="custom-control-label" for="is_mandatory">Mandatory</label>
                                                        </div>
                                                        <i class="fa fa-star fa-sm text-danger mandatory mandatory-q"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-control-label text-right col-4">Info message</div>
                                        <div class="col-8">
                                            <textarea name="info_message" rows="1" class="form-control" placeholder="Question help content"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-control-label text-right col-4">Error message</div>
                                        <div class="col-8">
                                            <textarea name="error_message" rows="1" class="form-control" placeholder="Question help content"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-control-label text-right col-4">Warning message</div>
                                        <div class="col-8">
                                            <textarea name="warning_message" rows="1" class="form-control" placeholder="Question help content"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="form-control-label text-right col-4">Success message</div>
                                        <div class="col-8">
                                            <textarea name="success_message" rows="1" class="form-control" placeholder="Question help content"></textarea>
                                        </div>
                                    </div>
                                    <div [formGroup]="question.controls.options" *ngIf="question.value.type == 'text'">
                                        <div class="form-group row">
                                            <div class="form-control-label text-right col-4">Settings</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <div class="form-control-label">Maxmum character limit</div>
                                                            <input name="max_length" class="form-control" placeholder="Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-8"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div [formGroup]="question.controls.options" *ngIf="question.value.type == 'number'">
                                        <div class="form-group row">
                                            <div class="form-control-label text-right col-4">Settings</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">min</span>
                                                            </div>
                                                            <input type="text" name="minimum" class="form-control" placeholder="Minimum">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <label class="input-group-prepend">
                                                                <span class="input-group-text">max</span>
                                                            </label>
                                                            <input type="text" name="maximum" class="form-control" placeholder="Muximum">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div *ngIf="question.value.type == 'image'">
                                        <div class="form-group row">
                                            <div class="form-control-label text-right col-4">Image quality</div>
                                            <div class="col-8">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="quality" [value]="'lower'" class="form-check-input">
                                                        Lower
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="quality" [value]="'mediam'" class="form-check-input">
                                                        Mediam
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="quality" [value]="'high'" class="form-check-input">
                                                        Hight
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div [formGroup]="question.controls.options" *ngIf="question.value.type == 'rating'">
                                        <div class="form-group row">
                                            <div class="form-control-label text-right col-4">Settings</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-6 pr-0">
                                                                <div class="form-group m-0">
                                                                    <label class="form-control-label">Steps</label>
                                                                    <input name="rating_steps" class="form-control" placeholder="Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-6 pl-0">
                                                                <div class="form-group m-0">
                                                                    <label class="form-control-label">Interval</label>
                                                                    <input name="rating_interval" class="form-control" placeholder="Number">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group m-0">
                                                            <label class="form-control-label">Rating type</label>
                                                            <div class="row">
                                                                <label class="col-5 m-0 ">
                                                                    <input type="radio" name="rating_type" [value]="0"> Slidebar
                                                                </label>
                                                                <label class="col-7 m-0">
                                                                    <input type="radio" name="rating_type" [value]="1"> Star
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div [formGroup]="question.controls.options" *ngIf="question.value.type == ('choice' || 'select')">
                                        <div class="form-group row">
                                            <div class="form-control-label text-right col-4">Field options </div>
                                            <div class="col-8">
                                                <tag-input
                                                    class="form-control"
                                                    placeholder="Add tags ..."
                                                    [model]="question.value.options.allowed_selection"
                                                    (tagsChanged)="onTagsChange($event, question)"
                                                    >
                                                </tag-input>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="form-control-label text-right col-4">Allowed question</div>
                                            <div class="col-8">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="row">
                                                            <label class="col-5 m-0 ">
                                                                <input type="radio" name="multiple_selection" [value]="false"> Only one
                                                            </label>
                                                            <label class="col-7 m-0">
                                                                <input type="radio" name="multiple_selection" [value]="true"> More then one
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-7" *ngIf="question.value.options.multiple_selection">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">min</span>
                                                                    </div>
                                                                    <input type="text" name="minimum" class="form-control" placeholder="Minimum">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="input-group">
                                                                    <label class="input-group-prepend">
                                                                        <span class="input-group-text">max</span>
                                                                    </label>
                                                                    <input type="text" name="maximum" class="form-control" placeholder="Muximum">
                                                                </div>
                                                            </div>
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
                                <div class="btn px-4" (click)="removeQuestion(i)"><i class="fa fa-trash"></i></div>
                                <!-- <div class="btn px-4"><i class="fa fa-arrows-v"></i></div> -->
                                <!-- <div class="btn px-4" (click)="dublicateQuestion(i)"><i class="fa fa-file"></i></div> -->
                                <!-- <div class="btn px-4"><i class="fa fa-link"></i> Add condition</div> -->
                                <div class="btn border-right-0" (click)="saveQuestion(i)">Done</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card question block-shadow question-closed mb-3">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Collapsible Group Item #2
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="card question block-shadow question-closed mb-3">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Collapsible Group Item #3
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <button class="btn btn-success" type="submit"><i class="fas fa-save mr-1"></i> Save</button>
        <button class="btn btn-dark" type="reset"><i class="fas fa-ban mr-1"></i> Reset</button>
    </div>
</form>

<script>
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

</script>

