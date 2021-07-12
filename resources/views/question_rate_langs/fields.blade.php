<!-- Question Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question', 'Question:') !!}
    {!! Form::text('question', null, ['class' => 'form-control']) !!}
</div>

<!-- Question Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_id', 'Question Id:') !!}
    {!! Form::number('question_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Lang Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lang_id', 'Lang Id:') !!}
    {!! Form::number('lang_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('questionRateLangs.index') }}" class="btn btn-default">Cancel</a>
</div>
