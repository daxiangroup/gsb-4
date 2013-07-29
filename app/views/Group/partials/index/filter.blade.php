{{ Form::open(array(URL::route('group.filter'))) }}
{{ Form::token() }}

Name: {{ Form::text('group_filter_name') }}
Year: {{ Form::text('group_filter_year') }}
Size: {{ Form::text('group_filter_size') }}<br>
{{ Form::submit('Filter', array('class'=>'btn btn-primary')) }}

{{ Form::close() }}