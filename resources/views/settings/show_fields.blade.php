<!-- Terms Field -->
<div class="form-group">
    {!! Form::label('terms', 'Terms:') !!}
    <p>{{ $setting->terms }}</p>
</div>

<!-- Privacy Field -->
<div class="form-group">
    {!! Form::label('privacy', 'Privacy:') !!}
    <p>{{ $setting->privacy }}</p>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', 'Phone:') !!}
    <p>{{ $setting->phone }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $setting->email }}</p>
</div>

<!-- Social Field -->
<div class="form-group">
    {!! Form::label('social', 'Social:') !!}
    <p>{{ $setting->social }}</p>
</div>

