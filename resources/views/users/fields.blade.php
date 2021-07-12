<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'اسم المستخدم : ') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'ايميل : ') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'كلمة المرور') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'نوع المستخدم : ') !!}
    <div class="form-group">
        <select class="form-control" id="sel1"name="type">
          <option {{ isset($user) && $user->type == 'user' ?"selected":""}} value="user" > زبائن</option>
          <option {{ isset($user) && $user->type == 'admin' ?"selected":""}} value="admin" >أدمن</option>
          <option {{ isset($user) && $user->type == 'store' ?"selected":""}}  value="store" >صاحب شركة </option>
        </select>
      </div>
</div>

<!-- Img Field -->
<div class="form-group col-sm-6">
    {!! Form::label('img', 'الصورة الشخصية : ') !!}
    <input type='file' name='img' onchange="readURL(this);" />
    <img id="blah" src="@if(isset($user)){{asset('uploads/images/users/'. $user->img)}}@else {{asset('uploads/images/users/no-img-user.png')}} @endif" alt="your image"style="width:160px;height:160px" />
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('users.index') }}" class="btn btn-default">رجوع</a>
</div>

@section('scripts')

{{-- for image --}}
<script type="text/javascript">
    $(document).ready(function(){
        readURL(input);
    });
</script>
<script>
    alert('read');
    function readURL(input) {
        alert('po');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>     --}}
{{-- end for image
@endsection