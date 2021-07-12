

<div dir="rtl" class="container">
  
    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="profile"><i class="glyphicon glyphicon-user"></i> معلومات الاعلان </a></li>
                <li><a href="" data-target-id="Arabic"><i class="glyphicon glyphicon-user"></i> وصف الاعلان </a></li>
  
            </ul>
        </div>

        <div class="col-md-8  admin-content" id="profile">
         
         
            
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">الصورة/الفيديو</h3>

                </div>
                <div class="panel-body">
                    
                    <input name="img" accept="video/mp4 ,image/*" type="file">
                   
                    @if (!(\Request::is('advs/create')))
                    
                        @if($adv->type == 'photo')
                            <img style="width:150px; margin-top:5px;"  class='img-thumbnail' src='{{asset('uploads/images/adv/'.$adv->media_link)}}' />
                        @else
                      
                            <video style="margin-top:10px;" 
                                class="video-js"
                                width="320" height="240" 
                                controls 
                                data-setup="{}"
                                preload="auto"
                                class='img-thumbnail'>
                                <source src='{{asset('uploads/images/adv/'.$adv->media_link)}}' type="video/mp4">
                                <p class="vjs-no-js">
                                    To view this video please enable JavaScript, and consider upgrading to a
                                    web browser that
                                </p>
                            </video>
                            
                        @endif


                    @endif
                </div>
            </div>


            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">رابط الاعلان</h3>
                </div>
                <div class="panel-body">
                    <input class="form-control" name="link" value="{{$adv->link ??''}}">    
                </div>
            </div>
        

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">ظهور الاعلان  </h3>
                </div>
                <div class="panel-body">
    
                <input type='hidden' value='0' name='is_active'/>
                @if (!(\Request::is('advs/create'))) 
                <input {{$adv->is_active?"checked":""}} id="toggle-state"  value='1' name="is_active" type="checkbox" data-toggle="toggle">
                 @else
                 <input id="toggle-state"  value='1' name="is_active" type="checkbox" data-toggle="toggle">
                @endif

                </div>
            </div>


            @if (!(\Request::is('advs/create'))) 
            <div class="panel panel-primary border" style="margin: 1em;">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="pull-left">
                            {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('advs.index') }}" class="btn btn-default">رجوع</a>

                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

        <div class="col-md-8  admin-content" id="Arabic">
         
    

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">النوع </h3>
                </div>
                <div class="panel-body">
                    
                    <select name="type" id="type" class="js-states form-control">
                       
                        @if (!(\Request::is('advs/create'))) 
                        <option {{ $adv->type == 'photo' ? 'selected':'' }} value='photo'>  Photo    </option>
                        <option {{ $adv->type == 'vedio' ? 'selected':'' }} value='vedio'>  Vedio    </option>     

                        @else

                        <option value='photo'>  Photo    </option>
                        <option value='vedio'>  Vedio    </option>     
                       
                        @endif

                     </select>
                    



                </div>
            </div>
        
            


            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"><label for="confirm_password" class="control-label panel-title">الوصف    </label></h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-10">
                           <textarea class="form-control" name="description" cols="50" rows="5" id="description" spellcheck="false"> {{$adv->description ??''}} </textarea>


                        </div>
                    </div>
                </div>
            </div>



            <div class="panel panel-primary border" style="margin: 1em;">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="pull-left">
                            {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('advs.index') }}" class="btn btn-default">رجوع</a>

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

@endpush




