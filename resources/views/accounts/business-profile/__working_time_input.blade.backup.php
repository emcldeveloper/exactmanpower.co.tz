<div class="input-group input-group-sm timepicker" data-date="{{ $input_value }}" data-date-format="hh:ii" data-link-field="{{ $input_id }}" data-link-format="hh:ii">
    <input class="form-control" size="16" type="text" value="">
    <span class="input-group-prepend input-group-text px-2"><span class="fa fa-times glyphicon glyphicon-remove"></span></span>
    <span class="input-group-prepend input-group-text px-2"><span class="fa fa-clock glyphicon glyphicon-time"></span></span>
</div>
<input type="hidden" name="{{ $input_name }}" id="{{ $input_id }}" value="" />