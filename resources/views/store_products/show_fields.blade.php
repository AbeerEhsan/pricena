
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
                    @if (!(\Request::is('store_products/create'))) 
                    <img style="width:150px; margin-top:5px;"  class='img-thumbnail' src='{{asset('/uploads/images/'.$product->img)}}' />
                    @endif
                </div>
            </div>


            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">القسم  </h3>
                </div>
                <div class="panel-body">
                   
                    @if(request('lang'))
                  
                    {{$product->productLangs->where('lang_id','=',request('lang'))->first()->name}} 

                    @else
                    {{$product->productLangs->where('lang_id','=','2')->first()->name}} 

                    @endif
        
                        
                </div>
            </div>
           
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">رابط المنتج</h3>
                </div>
                <div class="panel-body">
                    {{$product->link ??''}}
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"> SKU</h3>
                </div>
                <div class="panel-body">
                  {{$product->sku ??''}}
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">كود المنتج </h3>
                </div>
                <div class="panel-body">
                   {{$product->Barcode ??''}}
                </div>
            </div>


        </div>

        <div class="col-md-8  admin-content" id="Arabic">
                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title">  اسم المنتج </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                              {{$product->productLangs->where('lang_id','=','2')->first()->name ??''}}
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
                             {{$product->productLangs->where('lang_id','=','2')->first()->description ??''}}                


                            </div>
                        </div>
                    </div>
                </div>

               
              
        </div>
    
        <div class="col-md-8  admin-content" id="English">

       
                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title"> اسم المنتج (EN) </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                               {{$product->productLangs->where('lang_id','=','1')->first()->name ??''}}

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
                               {{$product->productLangs->where('lang_id','=','1')->first()->description ??''}}               
                   
                            </div>
                        </div>
                    </div>
                </div>

       
           

        </div>

       
 
        <div class="col-md-8  admin-content" id="prod1">


        
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"> السعر </h3>
                </div>
                <div class="panel-body">
               {{$product->productStores->where('store_id',App\Models\Store::where('user_id',Auth::user()->id)->first()->id)->first()->price}}
                </div>
            </div>
           

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"> العملة </h3>
                </div>
                <div class="panel-body">
               {{$product->productStores->where('store_id',App\Models\Store::where('user_id',Auth::user()->id)->first()->id)->first()->currency}}
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"> السعر بعد الخصم </h3>
                </div>
                <div class="panel-body">
               {{$product->productStores->where('store_id',App\Models\Store::where('user_id',Auth::user()->id)->first()->id)->first()->deliveryPrice}}
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"> الخصم </h3>
                </div>
                <div class="panel-body">
                {{$product->productStores->where('store_id',App\Models\Store::where('user_id',Auth::user()->id)->first()->id)->first()->discount}}
                </div>
            </div> 

            



        </div>
     
          
        <div class="col-md-8  admin-content" id="product">

            
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"><label  class="control-label panel-title"> صور المنتج </label></h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-10">

                        @foreach ($product->productGalleries->pluck('img') as $photo )

                        <img style="width:150px; height:150px; margin-top:5px;"  class='img-thumbnail' src='{{asset('/uploads/images/'.$photo)}}' />

                        @endforeach   
                        

                        </div>
                    </div>

                </div>
            </div>

            <div class="panel panel-primary border" style="margin: 1em;">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="pull-left">
                            <a href="{{ route('products.index') }}" class="btn btn-default">رجوع</a>

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