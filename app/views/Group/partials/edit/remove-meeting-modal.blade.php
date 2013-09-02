{{ Form::button(Lang::get('Group/strings.buttons.group-join'), array('class'=>'btn btn-primary', 'data-toggle'=>'modal', 'data-target'=>'#mdl-join')) }}

<!-- Modal -->
<div id="mdl-remove" class="modal hide fade" tabindex="-1" ole="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-off"></i></button>
        <h3 id="myModalLabel">{{ Lang::get('Group/strings.headers.remove-meeting') }}</h3>
    </div>
    <div class="modal-body">
        <p>You are about to remove a Group Meeting:</p>
        <p><strong>{{ $group->getName() }}</strong></p>
    </div>
    <div class="modal-footer">
        {{ Form::open(array('url'=>URL::route('group.join', $group->getId()))) }}
        {{ Form::token() }}
        {{ Form::hidden('meeting_id', $group->getId()) }}
        <button class="btn" data-dismiss="modal" aria-hidden="true">{{ Lang::get('general.close') }}</button>
        <button class="btn btn-primary">Remove This Meeting</button>
        {{ Form::close() }}
    </div>
</div>