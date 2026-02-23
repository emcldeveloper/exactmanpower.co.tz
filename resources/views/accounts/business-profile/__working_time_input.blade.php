

<select class="form-control form-control-sm {{ $errors->has('working_hours.'.$day.'.'.$key)? 'is-invalid': null }}" name="working_hours[{{$day}}][{{$key}}]" id="_input_{{$day}}_{{$key}}">
@for($i = 0; $i < $time_steps; $i++)
@php 
$value_key = str_pad((($i - $i%4)/4), 2,'0',STR_PAD_LEFT).':'.str_pad(($i%4)*15,2,'0',STR_PAD_LEFT);
@endphp
<option value="{{ $value_key }}" {{($value_key == date('H:i', strtotime($value)))? 'selected': null}}>{{ $value_key }} hr</option>
@endfor
</select>