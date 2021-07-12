
<!------ Include the above in your HEAD tag ---------->

<div dir="rtl" class="container">

    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="profile"> <i class="glyphicon glyphicon-user"> </i> معلومات المنتج </a></li>
                <li><a href="" data-target-id="Arabic"> <i class="glyphicon glyphicon-edit"> </i> الاسم و الوصف (AR) </a></li>
                <li><a href="" data-target-id="English"> <i class="glyphicon glyphicon-edit"> </i> الاسم والوصف (EN) </a></li>
                <li><a href="" data-target-id="prod1"> <i class="fa fa-dollar"> </i>  السعر و العملة </a></li>
                <li><a href="" data-target-id="product"> <i class="glyphicon glyphicon-picture"> </i> صور المنتج </a></li>             

            </ul>
        </div>

        <div class="col-md-8  admin-content" id="profile">

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">الصورة</h3>

                </div>
                <div class="panel-body">
                    {!! Form::file('img', null, ['class' => 'form-control']) !!}

                    @if (!(\Request::is('storeProducts/create')))
                    <img style="width:150px; margin-top:5px;"  class='img-thumbnail' src='{{asset('uploads/images/'.$product->img)}}' />
                    @endif
                </div>
            </div>


            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">القسم  </h3>
                </div>
                <div class="panel-body">
                    <select name="category_id" id="category" class="js-states form-control">
                        @foreach($categories as $categ)
                            @if(request('lang'))
                            <option {{isset($product) && $product->category_id==$categ->categoryLangs->first()->category_id?"selected":" "}}
                            value='{{$categ->id}}'> {{$categ->categoryLangs->first()->name}} </option>

                            @else
                            <option {{isset($product) && $product->category_id==$categ->categoryLangs->first()->category_id?"selected":" "}}
                                value='{{$categ->id}}'> {{$categ->categoryLangs->first()->name}} </option>

                            @endif

                        @endforeach

                     </select>
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">رابط المنتج</h3>
                </div>
                <div class="panel-body">
                    <input class="form-control" name="link" value="{{$product->link ??''}}">
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"> SKU</h3>
                </div>
                <div class="panel-body">
                    <input class="form-control" name="sku" value="{{$product->sku ??''}}">
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">كود المنتج </h3>
                </div>
                <div class="panel-body">
                    <input class="form-control" name="Barcode" value="{{$product->Barcode ??''}}">
                </div>
            </div>



            @if (!(\Request::is('storeProducts/create')))
            <div class="panel panel-primary border" style="margin: 1em;">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="pull-left">
                            {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('storeProducts.index') }}" class="btn btn-default">رجوع</a>

                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-8  admin-content" id="Arabic">
                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title">  اسم المنتج </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                                @if (!(\Request::is('storeProducts/create')))

                                <input class="form-control" name="name_ar" type="text" id="name"
                                value= "{{$product->productLangs->where('lang_id','=','2')->first()->name  ??''}}">
                               @else
                               <input class="form-control" name="name_ar" type="text" id="name">
                                @endif

                            </div>
                        </div>

                    </div>
                </div>


                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="confirm_password" class="control-label panel-title">وصف المنتج   </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                                @if (!(\Request::is('storeProducts/create')))
                                <textarea class="form-control" name="description_ar" cols="50" rows="5" id="description" spellcheck="false"> {{$product->productLangs->where('lang_id','=','2')->first()->description  ??''}} </textarea>

                                @else
                                <textarea class="form-control" name="description_ar" cols="50" rows="5" id="description" spellcheck="false">  </textarea>

                                @endif


                            </div>
                        </div>
                    </div>
                </div>

                @if (!(\Request::is('storeProducts/create')))
                <div class="panel panel-primary border" style="margin: 1em;">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="pull-left">
                                {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('storeProducts.index') }}" class="btn btn-default">رجوع</a>

                            </div>
                        </div>
                    </div>
                </div>
                @endif

        </div>

        <div class="col-md-8  admin-content" id="English">


                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title"> اسم المنتج (EN) </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                                @if (!(\Request::is('storeProducts/create')))
                                <input class="form-control" name="name_en" type="text" id="name"
                                value= "{{$product->productLangs->where('lang_id','=','1')->first()->name  ??''}}">

                                @else
                                <input class="form-control" name="name_en" type="text" id="name">

                                @endif
                               
                            </div>
                        </div>

                    </div>
                </div>


                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title">وصف المنتج (EN) </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                                @if (!(\Request::is('storeProducts/create')))
                                <textarea class="form-control" name="description_en" cols="50" rows="5" id="description"
                                spellcheck="false"> {{$product->productLangs->where('lang_id','=','1')->first()->description  ??''}} </textarea>

                                @else
                                <textarea class="form-control" name="description_en" cols="50" rows="5" id="description"
                                spellcheck="false"> </textarea>

                                @endif
                            
                            </div>
                        </div>
                    </div>
                </div>

                @if (!(\Request::is('storeProducts/create')))
                <div class="panel panel-primary border" style="margin: 1em;">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="pull-left">
                                {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('storeProducts.index') }}" class="btn btn-default">رجوع</a>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
        </div>


    
      <div class="col-md-8  admin-content" id="prod1">


        
        <div class="panel panel-primary" style="margin: 1em;">
            <div class="panel-heading">
                <h3 class="panel-title"> السعر </h3>
            </div>
            <div class="panel-body">
                @if (!(\Request::is('storeProducts/create')))
                <input class="form-control" name="price" value="{{$product->productStores->where('store_id',App\Models\Store::where('user_id',Auth::user()->id)->first()->id)->first()->price??''}}">

                @else
                <input class="form-control" name="price" value="">

                @endif
            </div>
        </div>
       

        <div class="panel panel-primary" style="margin: 1em;">
            <div class="panel-heading">
                <h3 class="panel-title"> العملة </h3>
            </div>
            <div class="panel-body">
                @if (!(\Request::is('storeProducts/create')))
                <input class="form-control" name="currency"  value="{{$product->productStores->where('store_id',App\Models\Store::where('user_id',Auth::user()->id)->first()->id)->first()->currency??''}}" >

                @else
                <input class="form-control" name="currency" >

                @endif
            </div>
        </div>

     
        <div class="panel panel-primary" style="margin: 1em;">
            <div class="panel-heading">
                <h3 class="panel-title"> الخصم </h3>
            </div>
            <div class="panel-body">
                @if (!(\Request::is('storeProducts/create')))
                <input class="form-control" name="discount" value="{{$product->productStores->where('store_id',App\Models\Store::where('user_id',Auth::user()->id)->first()->id)->first()->discount??''}}" >

                @else
                <input class="form-control" name="discount"  >

                @endif
            </div>
        </div> 

        <div class="panel panel-primary" style="margin: 1em;">
            <div class="panel-heading">
                <h3 class="panel-title">   السعر بعد الخصم</h3>
            </div>
            <div class="panel-body">
                @if (!(\Request::is('storeProducts/create')))
                <input class="form-control" name="deliveryPrice" value="{{$product->productStores->where('store_id',App\Models\Store::where('user_id',Auth::user()->id)->first()->id)->first()->deliveryPrice??''}}" >

                @else
                <input class="form-control" name="deliveryPrice"  >

                @endif
            </div>
        </div>


        @if (!(\Request::is('storeProducts/create')))
        <div class="panel panel-primary border" style="margin: 1em;">
            <div class="panel-body">
                <div class="form-group">
                    <div class="pull-left">
                        {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('storeProducts.index') }}" class="btn btn-default">رجوع</a>

                    </div>
                </div>
            </div>
        </div>
        @endif

        



      </div> 
      
        <div class="col-md-8  admin-content" id="product">

            
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"><label  class="control-label panel-title"> صور المنتج </label></h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-10">
                            
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                              <strong>Whoops!</strong> There were some problems with your input.<br><br>
                              <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                              </ul>
                            </div>
                            @endif
                      
                              @if(session('success'))
                              <div class="alert alert-success">
                                {{ session('success') }}
                              </div> 
                              @endif
                      
                       
                              <div class="input-group control-group increment" >
                                <input type="file" name="gallery[]" class="form-control">
                                <div class="input-group-btn "> 
                                  <button style="margin-right:10px;" class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i></button>
                                </div>
                              </div>
                              
                              <div class="clone hide">
                                <div class="control-group input-group" style="margin-top:10px">
                                  <input type="file" name="gallery[]" class="form-control">
                                  <div class="input-group-btn"> 
                                    <button  style="margin-right:10px;" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                  </div>
                                </div>
                              </div>
                      



                            @if (!(\Request::is('storeProducts/create')))

                            @foreach ($product->productGalleries->pluck('img') as $photo )
                               
                            
                              <div class=" input-group control-group ">
                                <div class="control-group input-group" style="margin-top:10px">
                                  
                                    <img style="width:120px; height:120px; margin-top:5px;"  class='img-thumbnail' src='{{asset('/uploads/images/'.$photo)}}' />     
                                    <input hidden name="galleries[]" value="{{$photo}}">
                                    <div class="input-group-btn"> 
                                    <button  style="margin-right:10px;" class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                  </div>
                                </div>
                              </div>
                       
                            
                            @endforeach  

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
                            <a href="{{ route('storeProducts.index') }}" class="btn btn-default">رجوع</a>

                        </div>
                    </div>
                </div>
            </div>

        </div>




</div>
    
</div>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
