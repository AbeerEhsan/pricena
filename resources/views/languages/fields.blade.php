<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'اسم اللغة : ') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Symbol Field -->
<div class="form-group col-sm-6">
    {!! Form::label('symbol', 'رمز اللغة : ') !!}
    {!! Form::text('symbol', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('languages.index') }}" class="btn btn-default">رجوع</a>
</div>
