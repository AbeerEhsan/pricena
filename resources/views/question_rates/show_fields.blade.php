
<!------ Include the above in your HEAD tag ---------->

<div dir="rtl" class="container">
  
    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="Arabic"><i class="glyphicon glyphicon-user"></i> السؤال  </a></li>
                <li><a href="" data-target-id="English"><i class="glyphicon glyphicon-user"></i> السؤال (En) </a></li>

            </ul>
        </div>



        <div class="col-md-8  admin-content" id="Arabic">
                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title">  السؤال   </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                               {{$questionAr ??''}}
                            </div>
                        </div>

                    </div>
                </div>

         
                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="confirm_password" class="control-label panel-title">  الاجابات     </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                                
                       @foreach ($questionRate->qusetionRateAnswers as $answer )
                        <li>
                        {{ $answer->qusetionRateAnswerLangs->where('lang_id','2')->first()->answer }}
                        </li>
                         @endforeach  
                                
                                
                                {{-- {{$answer ??''}} --}}
                            </div>
                        </div>
                    </div>
                </div>

                @if (!(\Request::is('questionRates/create'))) 
                <div class="panel panel-primary border" style="margin: 1em;">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="pull-left">
                                <a href="{{ route('questionRates.index') }}" class="btn btn-default">رجوع</a>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
              
        </div>

        <div class="col-md-8  admin-content" id="English">
                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title">  السؤال   </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                               {{$questionEn ??''}}
                            </div>
                        </div>

                    </div>
                </div>

         
                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="confirm_password" class="control-label panel-title">  الاجابات     </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                                
                       @foreach ($questionRate->qusetionRateAnswers as $answer )
                        <li>
                        {{ $answer->qusetionRateAnswerLangs->where('lang_id','1')->first()->answer }}
                        </li>
                         @endforeach  
                                
                                
                                {{-- {{$answer ??''}} --}}
                            </div>
                        </div>
                    </div>
                </div>

                @if (!(\Request::is('questionRates/create'))) 
                <div class="panel panel-primary border" style="margin: 1em;">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="pull-left">
                                <a href="{{ route('questionRates.index') }}" class="btn btn-default">رجوع</a>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
              
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