<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Product Id:') !!}
    {!! Form::number('product_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Cobon Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cobon_id', 'Cobon Id:') !!}
    {!! Form::number('cobon_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('cobonProducts.index') }}" class="btn btn-default">Cancel</a>
</div>
