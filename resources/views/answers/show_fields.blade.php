<!-- Question Id Field -->
<div class="form-group">
    {!! Form::label('question_id', 'Question Id:') !!}
    <p>{{ $answer->question_id }}</p>
</div>

<!-- Answer Field -->
<div class="form-group">
    {!! Form::label('answer', 'Answer:') !!}
    <p>{{ $answer->answer }}</p>
</div>

<!-- Lang Id Field -->
<div class="form-group">
    {!! Form::label('lang_id', 'Lang Id:') !!}
    <p>{{ $answer->lang_id }}</p>
</div>

