<div class="row-fluid row-header">
    <div class="span1"></div>
    <div class="span2">{{ Lang::get('datetime.day') }}</div>
    <div class="span2">{{ Lang::get('datetime.time-start') }}</div>
    <div class="span2">{{ Lang::get('datetime.time-end') }}</div>
    <div class="span5">{{ Lang::get('datetime.notes') }}</div>
</div>

@foreach ($form_values['group_meetings'] as $mt => $meeting)
<div class="row-fluid">
    <div class="span1">
        {{ Form::button(Lang::get('general.remove'), array('class'=>'btn btn-mini btn-danger btn-remove-meeting', 'data-meeting-id'=>$meeting->getId())) }}
    </div>
    <div class="span2">{{ Lang::get('datetime.day'.$meeting->getDay()) }}</div>
    <div class="span2">{{ $meeting->getTimeStart() }}</div>
    <div class="span2">{{ $meeting->getTimeEnd() }}</div>
    <div class="span5">{{ $meeting->getNotes() }}</div>
</div>
@endforeach