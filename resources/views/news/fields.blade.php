
<div dir="rtl" class="container">

    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="Arabic"> <i class="glyphicon glyphicon-edit"></i> الاسم و الوصف (AR) </a></li>
                <li><a href="" data-target-id="English"> <i class="glyphicon glyphicon-edit"></i> الاسم والوصف (EN) </a></li>
             
                            

            </ul>
        </div>

       
          

        <div class="col-md-8  admin-content" id="Arabic">

                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title">الصورة</h3>

                    </div>
                    <div class="panel-body">
                        {!! Form::file('img', null, ['class' => 'form-control']) !!}

                        @if (!(\Request::is('news/create')))
                        <img style="width:150px; margin-top:5px;"  class='img-thumbnail' src='{{asset('uploads/images/news/'.$news->image)}}' />
                        @endif
                    </div>
                </div>

                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title">   العنوان  </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input class="form-control" name="title_ar" type="text" id="name"
                            value= "{{$newTitleAr??''}}">
                            </div>
                        </div>

                    </div>
                </div>


                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="confirm_password" class="control-label panel-title">الوصف   </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                               <textarea class="form-control" name="description_ar" cols="50" rows="5" id="description" spellcheck="false"> {{$newDescAr??''}} </textarea>


                            </div>
                        </div>
                    </div>
                </div>

                @if (!(\Request::is('news/create')))
                <div class="panel panel-primary border" style="margin: 1em;">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="pull-left">
                                {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('news.index') }}" class="btn btn-default">رجوع</a>

                            </div>
                        </div>
                    </div>
                </div>
                @endif

        </div>

        <div class="col-md-8  admin-content" id="English">


                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title"> العنوان  </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input class="form-control" name="title_en" type="text" id="name"
                            value= "{{$newTitleEn??''}}">

                            </div>
                        </div>

                    </div>
                </div>


                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title"> الوصف </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description_en" cols="50" rows="5" id="description"
                                spellcheck="false"> {{$newDescEn??''}}  </textarea>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-primary border" style="margin: 1em;">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="pull-left">
                                {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('news.index') }}" class="btn btn-default">رجوع</a>

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
