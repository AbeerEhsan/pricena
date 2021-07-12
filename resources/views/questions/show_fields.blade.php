<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $question->title }}</p>
</div>

<!-- Lang Id Field -->
<div class="form-group">
    {!! Form::label('lang_id', 'Lang Id:') !!}
    <p>{{ $question->lang_id }}</p>
</div>

