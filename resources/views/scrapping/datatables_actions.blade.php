{!! Form::open(['route' => ['advs.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    {{--<a href="{{ route('advs.show', $id) }}" class='btn btn-default btn-xs'>--}}
        {{--<i class="glyphicon glyphicon-eye-open"></i>--}}
    {{--</a>--}}
    <a style="padding-left: 2em" href="{{ route('advs.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'style' => 'padding-left: 2em;',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
