{!! Form::open(['route' => ['products.destroy', $id], 'method' => 'delete']) !!}
<div style="display: flex;" class='btn-group'>
    <a href="{{ route('products.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('products.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    <a  href="{{ route('productStore.index', $id) }}" class='btn btn-default btn-xs'>
        <i class="fas fa-store-alt"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}


    