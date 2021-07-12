<!-- Image Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::file('media_link', null, ['class' => 'form-control']) !!}

    @if (isset($adv))
        <img style="width:150px; margin-top:5px;"  class='img-thumbnail' src='{{asset('uploads/images/adv/'.$adv->image)}}' />
    @endif
</div>

<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('link', 'النوع :') !!}

    <select name="type" class="form-control">
    <option value="image">image</option>
    <option value="video">video</option>
</select>
</div>

{{--<!-- Description Field -->--}}
{{--<div class="form-group col-sm-12 col-lg-12">--}}
    {{--{!! Form::label('description', 'Description:') !!}--}}
    {{--{!! Form::textarea('description', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Link Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('advs.index') }}" class="btn btn-default">الغاء</a>
</div>
