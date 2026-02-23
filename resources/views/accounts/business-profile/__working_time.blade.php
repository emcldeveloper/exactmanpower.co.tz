@php 
$time_steps = 96;
@endphp
<div class="card card-body bg-light ">
    <div class="w-90">
        <div class="row mb-2">
            <div class="col">Day</div>
            <div class="col">Start</div>
            <div class="col">End</div>
            <div class="col">Closed</div>
        </div>
        <div class="row mb-1 day-container">
            <div class="col">
                <div class="form-control form-control-sm">MONDAY</div>
                <input type="hidden" name="working_hours[1][day]" value="1">
            </div>
            <div class="col">
                <!----- Start form field start_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.1.start_time'))? old('working_hours.1.start_time'): (($post && $post->timetables->where('day', 1)->first())? $post->timetables->where('day', 1)->first()->start_time: null), 'day'=>1, 'key'=>'start_time'])
                    <div class="invalid-feedback" id="_input_help_start_time">{{ $errors->has('working_hours.1.start_time')? $errors->first('working_hours.1.start_time'): null }}</div>
                </div>
                <!----- End form field start_time ----->
            </div>
            <div class="col">
                <!----- Start form field end_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.1.end_time'))? old('working_hours.1.end_time'): (($post && $post->timetables->where('day', 1)->first())? $post->timetables->where('day', 1)->first()->end_time: null), 'day'=>1, 'key'=>'end_time'])
                    <div class="invalid-feedback" id="_input_help_end_time">{{ $errors->has('working_hours.1.end_time')? $errors->first('working_hours.1.end_time'): null }}</div>
                </div>
                <!----- End form field end_time ----->
            </div>
            <div class="col">
                <!----- Start form field is_closed ----->
                <div class="form-group mb-1">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="working_hours[1][is_closed]" id="_input_is_closed_1" {{ (old('working_hours.1.is_closed') == 'on')? 'checked': (($post && $post->timetables->where('day', 1) && $post->timetables->where('day', 1)->first()->is_closed)? 'checked': null) }}>
                        <label class="custom-control-label pt-0" for="_input_is_closed_1">Closed</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_is_closed">{{ $errors->has('working_hours.1.is_closed')? $errors->first('working_hours.1.is_closed'): null }}</div>
                </div>
                <!----- End form field is_closed ----->
            </div>
        </div>
        <div class="row mb-1 day-container">
            <div class="col">
                <div class="form-control form-control-sm">TUESDAY</div>
                <input type="hidden" name="working_hours[2][day]" value="2">
            </div>
            <div class="col">
                <!----- Start form field start_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.2.end_time'))? old('working_hours.2.end_time'): (($post && $post->timetables->where('day', 2)->first())? $post->timetables->where('day', 2)->first()->start_time: null), 'day'=>2, 'key'=>'start_time'])
                    <div class="invalid-feedback" id="_input_help_start_time">{{ $errors->has('working_hours.2.start_time')? $errors->first('working_hours.2.start_time'): null }}</div>
                </div>
                <!----- End form field start_time ----->
            </div>
            <div class="col">
                <!----- Start form field end_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.2.end_time'))? old('working_hours.2.end_time'): (($post && $post->timetables->where('day', 2)->first())? $post->timetables->where('day', 2)->first()->end_time: null), 'day'=>2, 'key'=>'end_time'])
                    <div class="invalid-feedback" id="_input_help_end_time">{{ $errors->has('working_hours.2.end_time')? $errors->first('working_hours.2.end_time'): null }}</div>
                </div>
                <!----- End form field end_time ----->
            </div>
            <div class="col">
                <!----- Start form field is_closed ----->
                <div class="form-group mb-1">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="working_hours[2][is_closed]" id="_input_is_closed_2" {{ (old('working_hours.2.is_closed') == 'on')? 'checked': (($post && $post->timetables->where('day', 2) && $post->timetables->where('day', 2)->first()->is_closed)? 'checked': null) }}>
                        <label class="custom-control-label pt-0" for="_input_is_closed_2">Closed</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_is_closed">{{ $errors->has('working_hours.2.is_closed')? $errors->first('working_hours.2.is_closed'): null }}</div>
                </div>
                <!----- End form field is_closed ----->
            </div>
        </div>
        <div class="row mb-1 day-container">
            <div class="col">
                <div class="form-control form-control-sm">WEDNESDAY</div>
                <input type="hidden" name="working_hours[3][day]" value="3">
            </div>
            <div class="col">
                <!----- Start form field start_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.3.start_time'))? old('working_hours.3.start_time'): (($post && $post->timetables->where('day', 3)->first())? $post->timetables->where('day', 3)->first()->start_time: null), 'day'=>3, 'key'=>'start_time'])
                    <div class="invalid-feedback" id="_input_help_start_time">{{ $errors->has('working_hours.3.start_time')? $errors->first('working_hours.3.start_time'): null }}</div>
                </div>
                <!----- End form field start_time ----->
            </div>
            <div class="col">
                <!----- Start form field end_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.3.end_time'))? old('working_hours.3.end_time'): (($post && $post->timetables->where('day', 3)->first())? $post->timetables->where('day', 3)->first()->end_time: null), 'day'=>3, 'key'=>'end_time'])
                    <div class="invalid-feedback" id="_input_help_end_time">{{ $errors->has('working_hours.3.end_time')? $errors->first('working_hours.3.end_time'): null }}</div>
                </div>
                <!----- End form field end_time ----->
            </div>
            <div class="col">
                <!----- Start form field is_closed ----->
                <div class="form-group mb-1">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="working_hours[3][is_closed]" id="_input_is_closed_3" {{ (old('working_hours.3.is_closed') == 'on')? 'checked': (($post && $post->timetables->where('day', 3) && $post->timetables->where('day', 3)->first()->is_closed)? 'checked': null) }}>
                        <label class="custom-control-label pt-0" for="_input_is_closed_3">Closed</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_is_closed">{{ $errors->has('working_hours.3.is_closed')? $errors->first('working_hours.3.is_closed'): null }}</div>
                </div>
                <!----- End form field is_closed ----->
            </div>
        </div>
        <div class="row mb-1 day-container">
            <div class="col">
                <div class="form-control form-control-sm">THURSDAY</div>
                <input type="hidden" name="working_hours[4][day]" value="4">
            </div>
            <div class="col">
                <!----- Start form field start_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.4.start_time'))? old('working_hours.4.start_time'): (($post && $post->timetables->where('day', 4)->first())? $post->timetables->where('day', 4)->first()->start_time: null), 'day'=>4, 'key'=>'start_time'])
                    <div class="invalid-feedback" id="_input_help_start_time">{{ $errors->has('working_hours.4.start_time')? $errors->first('working_hours.4.start_time'): null }}</div>
                </div>
                <!----- End form field start_time ----->
            </div>
            <div class="col">
                <!----- Start form field end_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.4.end_time'))? old('working_hours.4.end_time'): (($post && $post->timetables->where('day', 4)->first())? $post->timetables->where('day', 4)->first()->end_time: null), 'day'=>4, 'key'=>'end_time'])
                    <div class="invalid-feedback" id="_input_help_end_time">{{ $errors->has('working_hours.4.end_time')? $errors->first('working_hours.4.end_time'): null }}</div>
                </div>
                <!----- End form field end_time ----->
            </div>
            <div class="col">
                <!----- Start form field is_closed ----->
                <div class="form-group mb-1">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="working_hours[4][is_closed]" id="_input_is_closed_4"  {{ (old('working_hours.4.is_closed') == 'on')? 'checked': (($post && $post->timetables->where('day', 4) && $post->timetables->where('day', 4)->first()->is_closed)? 'checked': null) }}>
                        <label class="custom-control-label pt-0" for="_input_is_closed_4">Closed</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_is_closed">{{ $errors->has('working_hours.4.is_closed')? $errors->first('working_hours.4.is_closed'): null }}</div>
                </div>
                <!----- End form field is_closed ----->
            </div>
        </div>

        <div class="row mb-1 day-container">
            <div class="col">
                <div class="form-control form-control-sm">FRIDAY</div>
                <input type="hidden" name="working_hours[5][day]" value="5">
            </div>
            <div class="col">
                <!----- Start form field start_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.5.start_time'))? old('working_hours.5.start_time'): (($post && $post->timetables->where('day', 5)->first())? $post->timetables->where('day', 5)->first()->start_time: null), 'day'=>5, 'key'=>'start_time'])
                    <div class="invalid-feedback" id="_input_help_start_time">{{ $errors->has('working_hours.5.start_time')? $errors->first('working_hours.5.start_time'): null }}</div>
                </div>
                <!----- End form field start_time ----->
            </div>
            <div class="col">
                <!----- Start form field end_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.5.end_time'))? old('working_hours.5.end_time'): (($post && $post->timetables->where('day', 5)->first())? $post->timetables->where('day', 5)->first()->end_time: null), 'day'=>5, 'key'=>'end_time'])
                    <div class="invalid-feedback" id="_input_help_end_time">{{ $errors->has('working_hours.5.end_time')? $errors->first('working_hours.5.end_time'): null }}</div>
                </div>
                <!----- End form field end_time ----->
            </div>
            <div class="col">
                <!----- Start form field is_closed ----->
                <div class="form-group mb-1">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="working_hours[5][is_closed]" id="_input_is_closed_5" {{ (old('working_hours.5.is_closed') == 'on')? 'checked': (($post && $post->timetables->where('day', 5)->first() && $post->timetables->where('day', 5)->first()->is_closed)? 'checked': null) }}>
                        <label class="custom-control-label pt-0" for="_input_is_closed_5">Closed</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_is_closed">{{ $errors->has('working_hours.5.is_closed')? $errors->first('working_hours.5.is_closed'): null }}</div>
                </div>
                <!----- End form field is_closed ----->
            </div>
        </div>

        <div class="row mb-1 day-container">
            <div class="col">
                <div class="form-control form-control-sm">SATURDAY</div>
                <input type="hidden" name="working_hours[6][day]" value="6">
            </div>
            <div class="col">
                <!----- Start form field start_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.6.start_time'))? old('working_hours.6.start_time'): (($post && $post->timetables->where('day', 6)->first())? $post->timetables->where('day', 6)->first()->start_time: null), 'day'=>6, 'key'=>'start_time'])
                    <div class="invalid-feedback" id="_input_help_start_time">{{ $errors->has('working_hours.6.start_time')? $errors->first('working_hours.6.start_time'): null }}</div>
                </div>
                <!----- End form field start_time ----->
            </div>
            <div class="col">
                <!----- Start form field end_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.2.end_time'))? old('working_hours.2.end_time'): (($post && $post->timetables->where('day', 2)->first())? $post->timetables->where('day', 2)->first()->start_time: null), 'day'=>6, 'key'=>'end_time'])
                    <div class="invalid-feedback" id="_input_help_end_time">{{ $errors->has('working_hours.6.end_time')? $errors->first('working_hours.6.end_time'): null }}</div>
                </div>
                <!----- End form field end_time ----->
            </div>
            <div class="col">
                <!----- Start form field is_closed ----->
                <div class="form-group mb-1">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="working_hours[6][is_closed]" id="_input_is_closed_6" {{ (old('working_hours.6.is_closed') == 'on')? 'checked': (($post && $post->timetables->where('day', 6)->first() && $post->timetables->where('day', 6)->first()->is_closed)? 'checked': null) }}>
                        <label class="custom-control-label pt-0" for="_input_is_closed_6">Closed</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_is_closed">{{ $errors->has('working_hours.6.is_closed')? $errors->first('working_hours.6.is_closed'): null }}</div>
                </div>
                <!----- End form field is_closed ----->
            </div>
        </div>

        <div class="row mb-1 day-container">
            <div class="col">
                <div class="form-control form-control-sm">SUNDAY</div>
                <input type="hidden" name="working_hours[0][day]" value="0">
            </div>
            <div class="col">
                <!----- Start form field start_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.0.start_time'))? old('working_hours.0.start_time'): (($post && $post->timetables->where('day', 0)->first())? $post->timetables->where('day', 0)->first()->start_time: null), 'day'=>0, 'key'=>'start_time'])
                    <div class="invalid-feedback" id="_input_help_start_time">{{ $errors->has('working_hours.0.start_time')? $errors->first('working_hours.0.start_time'): null }}</div>
                </div>
                <!----- End form field start_time ----->
            </div>
            <div class="col">
                <!----- Start form field end_time ----->
                <div class="form-group mb-1">
                    @include('accounts.business-profile.__working_time_input', ['value'=>(old('working_hours.0.end_time'))? old('working_hours.0.end_time'): (($post && $post->timetables->where('day', 0)->first())? $post->timetables->where('day', 0)->first()->end_time: null), 'day'=>0, 'key'=>'end_time'])
                    <div class="invalid-feedback" id="_input_help_end_time">{{ $errors->has('working_hours.0.end_time')? $errors->first('working_hours.0.end_time'): null }}</div>
                </div>
                <!----- End form field end_time ----->
            </div>
            <div class="col">
                <!----- Start form field is_closed ----->
                <div class="form-group mb-1">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="working_hours[0][is_closed]" id="_input_is_closed_0" {{ (old('working_hours.0.is_closed') == 'on')? 'checked': (($post && $post->timetables->where('day', 0)->first() && $post->timetables->where('day', 0)->first()->is_closed)? 'checked': null) }}>
                        <label class="custom-control-label pt-0" for="_input_is_closed_0">Closed</label>
                    </div>
                    <div class="invalid-feedback" id="_input_help_is_closed">{{ $errors->has('working_hours.0.is_closed')? $errors->first('working_hours.0.is_closed'): null }}</div>
                </div>
                <!----- End form field is_closed ----->
            </div>
        </div>
    </div>
</div>
<script>
jQuery(function(){
    jQuery('[name$="[is_closed]"]').on('change', this, function(){
        if(this.checked) {
            jQuery(this).parents('.day-container').find('[name]').addClass('d-none');
        } else {
            jQuery(this).parents('.day-container').find('[name]').removeClass('d-none');
        }
        
    }).change();
})
</script>