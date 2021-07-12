
<!------ Include the above in your HEAD tag ---------->

<div dir="rtl" class="container">
  
    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="profile"> <i class="glyphicon glyphicon-menu-hamburger"></i> معلومات المنتج </a></li>
                <li><a href="" data-target-id="Arabic"><i class="glyphicon glyphicon-user"> </i> الاسم و الوصف (AR) </a></li>
                <li><a href="" data-target-id="English"><i class="glyphicon glyphicon-user"> </i> الاسم والوصف (EN) </a></li>
                {{-- <li><a href="" data-target-id="prod1"><i class="glyphicon glyphicon-home"> </i>  الشركات المنتجة </a></li> --}}
                <li><a href="" data-target-id="product"><i class="glyphicon glyphicon-picture"> </i> صور المنتج </a></li>
              


                
            </ul>
        </div>

        <div class="col-md-8  admin-content" id="profile">

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">الصورة</h3>

                </div>
                <div class="panel-body">          
                    @if (!(\Request::is('products/create'))) 
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
                    {{$product->link ??'لا يوجد بيانات لعرضها '}}
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"> SKU</h3>
                </div>
                <div class="panel-body">
                  {{$product->sku ??'لا يوجد بيانات لعرضها'}}
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">كود المنتج </h3>
                </div>
                <div class="panel-body">
                   {{$product->Barcode ??'لا يوجد بيانات لعرضها'}}
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
                              {{$productNameAr ??'لا يوجد بيانات لعرضها'}}
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
                             {{$productDescAr ??'لا يوجد بيانات لعرضها'}}                


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
                               {{$productNameEn ??'لا يوجد بيانات لعرضها'}}

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
                               {{$productDescEn ??'لا يوجد بيانات لعرضها'}}               
                   
                            </div>
                        </div>
                    </div>
                </div>

       
           

        </div>

        {{-- <div class="col-md-8  admin-content" id="prod1">

       
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"><label  class="control-label panel-title"> الشركات  </label></h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-10">

                            @if($product->productStores->count()>0)
                            <table   class="table mt-10 table-striped table-hover text-center">
                              <thead>
                                <tr>
                                  <th scope="col"> الشركة </th>
                                  <th scope="col">السعر</th>
                                  <th scope="col">العملة </th>
                                  <th scope="col">سعر التسليم </th>
                                  <th scope="col">الخصم </th>

                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($product->productStores as $store )
                                <tr>
                                      <td>{{$store->store->storeLangs->where('lang_id','=',request('lang')??'2')->first()->name}}</td>
                                      <td>{{$store->price}}</td>
                                      <td>{{$store->currency}} </td>
                                      <td>{{$store->deliveryPrice}} </td>
                                      <td>{{$store->discount}} </td>
                    
                                  

                                    </tr>
                                    @endforeach

                              </tbody>
                            </table>

                            
                        </div>
                    </div>

                </div>
            </div>
            @endif              
    
        </div> --}}

      
        
        <div class="col-md-8  admin-content" id="product">

       
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title"><label  class="control-label panel-title"> صور المنتج </label></h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-10">

                        @if ($product->productGalleries->count()>0)
                           
                         @foreach ($product->productGalleries->pluck('img') as $photo )

                          <img style="width:150px; height:150px; margin-top:5px;"  class='img-thumbnail' src='{{asset('/uploads/images/'.$photo)}}' />

                         @endforeach   
                        
                        @else
                        <p> لا يوجد صور خاصة بهذا المنتج </p> 
                        @endif
                        

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