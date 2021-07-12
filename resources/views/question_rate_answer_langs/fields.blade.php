<!-- Answer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('answer_id', 'Answer Id:') !!}
    {!! Form::number('answer_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Lang Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lang_id', 'Lang Id:') !!}
    {!! Form::number('lang_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('questionRateAnswerLangs.index') }}" class="btn btn-default">Cancel</a>
</div>
