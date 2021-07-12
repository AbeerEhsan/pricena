<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'اسم البلد : ') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Lang Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lang_id', 'اللغة : ') !!}
<div class="form-group">
    <select class="form-control"name="lang_id">
        @foreach($languages as $language)
            <option value="{{$language->id}}">{{$language->name}}</option>        
        @endforeach
    </select>
</div>    

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('countries.index') }}" class="btn btn-default">رجوع</a>
</div>
