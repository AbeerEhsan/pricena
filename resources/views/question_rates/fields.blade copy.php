
<!------ Include the above in your HEAD tag ---------->

<div dir="rtl" class="container">
  
    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="Arabic"><i class="glyphicon glyphicon-user"></i>  السؤال(Ar) </a></li>
                <li><a href="" data-target-id="English"><i class="glyphicon glyphicon-user"></i>  السؤال(EN) </a></li>
               
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
                                <input class="form-control" name="question_ar" type="text" id="name" value= "{{$questionAr ??''}}">
                            </div>
                        </div>

                    </div>
                </div>

         
                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title"> الاجابات    </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10 answersList">

                                
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div> 
                            @endif
                    
                    
                            <div class="input-group control-group increment" >
                                <input type="text" name="answer_ar[]" class="form-control">
                                <div class="input-group-btn "> 
                                <button style="margin-right:10px;" class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                                </div>
                            </div>
                            
                            {{-- <div class="clone hide">
                                <div class="control-group input-group" style="margin-top:10px">
                                <input type="text" name="answer_ar" class="form-control">
                                <div class="input-group-btn"> 
                                    <button  style="margin-right:10px;" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                </div>
                                </div>
                            </div> --}}
                    

                            @if (!(\Request::is('questionRates/create')))
                        
                            @if($questionRate->qusetionRateAnswers->count() > 0)

                              @foreach ($questionRate->qusetionRateAnswers as $answer )
                            
                            
                            <div class=" input-group control-group ">
                                <div class="control-group input-group" style="margin-top:10px">
                                
                                    <input  name="answer_ars[]" value="{{ $answer->qusetionRateAnswerLangs->where('lang_id','2')->first()->answer }}">
                                    <div class="input-group-btn"> 
                                    <button  style="margin-right:10px;" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                </div>
                                </div>
                            </div>
                    
                            
                            @endforeach  

                            @endif
                            @endif


                            </div>
                        </div>
                    </div>
                </div>

                @if (!(\Request::is('questionRates/create'))) 
                <div class="panel panel-primary border" style="margin: 1em;">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="pull-left">
                                {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
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
                    <h3 class="panel-title"><label  class="control-label panel-title">  السؤال (En)  </label></h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input class="form-control" name="question_en" type="text" id="name" value= "{{$questionEn ??''}}">
                        </div>
                    </div>

                </div>
            </div>

     
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"><label  class="control-label panel-title"> الاجابات(En)    </label></h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-10 answersList">
                            {{-- <input class="form-control" name="answer_en" type="text" id="name" value= "{{$answerEn ??''}}"> --}}

                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div> 
                            @endif
                    
                    
                            <div class="input-group control-group increment" >
                                <input type="text" name="answer_en[]" class="form-control" >
                                <div class="input-group-btn "> 
                                <button style="margin-right:10px;" class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                                </div>
                            </div>
                            
                            {{-- <div class="clone hide">
                                <div class="control-group input-group" style="margin-top:10px">
                                <input type="text" name="answer_en" class="form-control" value="">
                                <div class="input-group-btn"> 
                                    <button  style="margin-right:10px;" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                </div>
                                </div>
                            </div> --}}
                    

                            @if (!(\Request::is('questionRates/create')))

                            @if($questionRate->qusetionRateAnswers->count() > 0)
                            @foreach ($questionRate->qusetionRateAnswers as $answer )
                            
                            
                            <div class=" input-group control-group ">
                                <div class="control-group input-group" style="margin-top:10px">
                                
                                    <input  name="answer_ens[]" value="{{ $answer->qusetionRateAnswerLangs->where('lang_id','1')->first()->answer }}">
                                    <div class="input-group-btn"> 
                                    <button  style="margin-right:10px;" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                </div>
                                </div>
                            </div>
                    
                            
                            @endforeach  

                            @endif
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-primary border" style="margin: 1em;">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="pull-left">
                            {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('questionRates.index') }}" class="btn btn-default">رجوع</a>

                        </div>
                    </div>
                </div>
            </div>
          
    </div>


    </div>
</div>


@push('scripts')
    
<script>
$(document).ready(function(){
    var navItems = $('.admin-menu li > a');
    var navListItems = $('.admin-menu li');
    var allWells = $('.admin-content');
    var allWellsExceptFirst = $('.admin-content:not(:first)');
    allWellsExceptFirst.hide();
    navItems.click(function(e){
        e.preventDefault();
        navListItems.removeClass('active');
        $(this).closest('li').addClass('active');
        allWells.hide();
        var target = $(this).attr('data-target-id');
        $('#' + target).show();
    });
});
</script>

<script type="text/javascript">

    $(document).ready(function() {
        var answer_index = 1;
      $(".btn-success").click(function(){ 
        //   var html = $(".clone").html();
        //   $(html).children('input').prop('name', 'plaPla[0000]');
        //   $(html).addClass(`answer-${answer_index}`);
        var html = `
                <div class="control-group input-group answer-${answer_index}" data-id="${answer_index}" style="margin-top:10px">
                    <input type="text" name="answer_ar[]" class="form-control">
                    <div class="input-group-btn"> 
                        <button style="margin-right:10px;" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                    </div>
                </div>
            `;
        var html_en = `
                <div class="control-group input-group answer-${answer_index}" data-id="${answer_index}" style="margin-top:10px">
                    <input type="text" name="answer_en[]" class="form-control">
                    <div class="input-group-btn"> 
                        <button style="margin-right:10px;" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                    </div>
                </div>
            `;


        //   console.log(html)
        //   console.log($(html))
        //   $(".answersList").append(html);
          $("#Arabic .answersList").append(html);
          $("#English .answersList").append(html_en);
          answer_index++;
      });
      $("body").on("click",".btn-danger",function(e){
          let answerId =  $(this).parents(".control-group").data('id');
          $(`.answer-${answerId}`).remove();
      });

    });

</script>

<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>

@endpush
