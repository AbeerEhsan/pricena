
<!-- Social Field -->
{{--  <div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('social', 'وسائل التواصل') !!}
    {!! Form::textarea('social', null, ['class' => 'form-control']) !!}
</div>  --}}

<!------ Include the above in your HEAD tag ---------->

<div dir="rtl" class="container">

    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="profile"><i class="glyphicon glyphicon-user"></i>الاعدادات العامة  </a></li>
                <li><a href="" data-target-id="Arabic"><i class="glyphicon glyphicon-user"></i>   الشروط و الخصوصية </a></li>

            </ul>
        </div>

        <div class="col-md-8  admin-content" id="profile">

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">رقم الجوال </h3>
                </div>
                <div class="panel-body">
                    <input class="form-control" name="phone" value="{{$setting->phone ??''}}">
                </div>
            </div>
         
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">الايميل   </h3>
                </div>
                <div class="panel-body">
                    <input class="form-control" name="email" value="{{$setting->email ??''}}">
                </div>
            </div>

            




        
        </div>


        <div class="col-md-8  admin-content" id="Arabic">
       

                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="terms" class="control-label panel-title">الشروط     </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                               <textarea class="form-control" name="terms" cols="50" rows="5" id="description" spellcheck="false"> {{$setting->terms ??''}} </textarea>


                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="privacy" class="control-label panel-title">الخصوصية     </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                               <textarea class="form-control" name="privacy" cols="50" rows="5" id="description" spellcheck="false"> {{$setting->privacy ??''}} </textarea>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-primary border" style="margin: 1em;">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="pull-left">
                                {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('settings.index') }}" class="btn btn-default">رجوع</a>

                            </div>
                        </div>
                    </div>
                </div>

        </div>


   
    </div>
</div>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<script>
$(document).ready(function()
{
var navItems = $('.admin-menu li > a');
var navListItems = $('.admin-menu li');
var allWells = $('.admin-content');
var allWellsExceptFirst = $('.admin-content:not(:first)');
allWellsExceptFirst.hide();
navItems.click(function(e)
{
  e.preventDefault();
  navListItems.removeClass('active');
  $(this).closest('li').addClass('active');
  allWells.hide();
  var target = $(this).attr('data-target-id');
  $('#' + target).show();
});
});
</script>

