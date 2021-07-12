
<!------ Include the above in your HEAD tag ---------->

<div dir="rtl" class="container">

    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="profile"><i class="glyphicon glyphicon-user"></i>معلومات المنتج </a></li>
                <li><a href="" data-target-id="Arabic"><i class="glyphicon glyphicon-user"></i>الاسم و الوصف (AR) </a></li>
                <li><a href="" data-target-id="English"><i class="glyphicon glyphicon-lock"></i>الاسم والوصف (EN) </a></li>
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
                    {!! Form::file('img', null, ['class' => 'form-control']) !!}

                    @if (!(\Request::is('products/create')))
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



            @if (!(\Request::is('products/create')))
            <div class="panel panel-primary border" style="margin: 1em;">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="pull-left">
                            {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('products.index') }}" class="btn btn-default">رجوع</a>

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
                                <input class="form-control" name="name_ar" type="text" id="name"
                                value= "{{$productNameAr ??''}}">
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
                               <textarea class="form-control" name="description_ar" cols="50" rows="5" id="description" spellcheck="false"> {{$productDescAr ??''}} </textarea>


                            </div>
                        </div>
                    </div>
                </div>

                @if (!(\Request::is('products/create')))
                <div class="panel panel-primary border" style="margin: 1em;">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="pull-left">
                                {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('products.index') }}" class="btn btn-default">رجوع</a>

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
                                <input class="form-control" name="name_en" type="text" id="name"
                                value= "{{$productNameEn ??''}}">

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
                                <textarea class="form-control" name="description_en" cols="50" rows="5" id="description"
                                spellcheck="false"> {{$productDescEn ??''}} </textarea>

                            </div>
                        </div>
                    </div>
                </div>

                @if (!(\Request::is('products/create')))
                <div class="panel panel-primary border" style="margin: 1em;">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="pull-left">
                                {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('products.index') }}" class="btn btn-default">رجوع</a>

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
                    

                            @if (!(\Request::is('products/create')))

                            @foreach ($product->productGalleries->pluck('img') as $photo )
                            
                            
                            <div class=" input-group control-group ">
                                <div class="control-group input-group" style="margin-top:10px">
                                
                                    <img style="width:100px; height:100px; margin-top:5px;"  class='img-thumbnail' src='{{asset('/uploads/images/'.$photo)}}' />     
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





{{-- 
      @if ((\Request::is('products/create')))  
    
        <div class="col-md-8  admin-content" id="prod1">

                <h3>الشركات</h3>
                <br />
              <div class="table-responsive">
                           <form method="post" id="dynamic_form">
                            <span id="result"></span>
                            <table class="table table-bordered table-striped" id="user_table">
                          <thead>
                           <tr>
                               <th width="30%">الشركة</th>
                               <th width="15%"> السعر</th>
                               <th width="15%"> العملة</th>
                               <th width="15%"> سعر التسليم</th>
                               <th width="15%"> الخصم</th>
                               <th width="10%">الاجراء</th>
                           </tr>
                          </thead>
                          <tbody>
           
                          </tbody>
                          
                      </table>

                      <div class="panel panel-primary border" style="margin: 1em;">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="pull-left">
                                    {{-- {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!} 
                                   
                                    <input type="submit" name="save" id="save" class="btn btn-primary" value="حفظ" />
                                    <a href="{{ route('products.index') }}" class="btn btn-default">رجوع</a>
        
                                </div>
                            </div>
                        </div>
                    </div>
                           </form>
              </div>
            </body>
           </html>

        </div>
                
     
      @endif 
        
@if (!(\Request::is('products/create')))    

            <div class="col-md-8  admin-content" id="prod1">
        
                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title"> الشركات  </label></h3>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <h1 class="pull-left">
                                    <a class="btn btn-primary pull-left" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('productStore.create',$product->id) }}">اضافة جديد </a>
                                </h1>
             @if($product->productStores->count()>0)

                                    <table    class="table mt-10 table-striped table-hover text-center">
                                        <thead>
                                            <tr>
                                            <th scope="col"> الشركة </th>
                                            <th scope="col">السعر</th>
                                            <th scope="col">العملة </th>
                                            <th scope="col">سعر التسليم </th>
                                            <th scope="col">الخصم </th>
                                            <th scope="col">الاجراءات </th>
                                
                                            <th></th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                
                                                @php
                                                    $index = 0;
                                                @endphp

                                                @foreach ($product->productStores as $store)
                                                        
                                                        <tr > 

                                                            <tr id="company-{{ $store->id }}">
                                                            <td> <input id="store-{{ $store->id }}" value="{{$store->store->storeLangs->where('lang_id','=',request('lang')??'2')->first()->name }}" type="text" name="company[{{ $store->id }}][store_id]" class="form-control" /> </td>
                                                            <td><input id="price-{{ $store->id }}" value="{{$store->price }}" type="text" name="company[{{ $store->id }}][price]" class="form-control" /></td>
                                                            <td><input id="currency-{{ $store->id }}" value="{{$store->currency }}" type="text" name="company[{{ $store->id }}][currency]" class="form-control" /></td>
                                                            <td><input id="deliveryPrice-{{ $store->id }}" value="{{$store->deliveryPrice }}" type="text" name="company[{{ $store->id }}][deliveryPrice]" class="form-control" /></td>
                                                            <td><input id="discount-{{ $store->id }}" value="{{ $store->discount }}" type="text" name="company[{{$store->id}}][discount]" class="form-control" /></td>

                                                        <td>

                                                            <div class='btn-group'>

                                                                    @if($index == 0)
                                                                        <button type="button" name="add" id="add" class="btn btn-success">  <i class="fas fa-plus"> </i></button>
                                                                    @else
                                                                        <button type="button" name="remove" id="del-{{ $store->id }}" class="btn btn-danger remove"> <i class="fas fa-trash"> </i> </button>
                                                                    @endif
                                                            
                                                            </div>

                                                        </td>


                                                        </tr>
                                                
                                                    @php
                                                        $index++;
                                                    @endphp
                                                @endforeach

                                            </tbody>
                                                    
                            
                                    </table>

                                    
                            </div>
                        </div>

                    </div>
                </div>

             @endif              

    
@endif 




   </div>
    
</div>
--}}



{{-- @push('scripts')
    

  <script>
      $(document).ready(function(){
           
            
            var count = {{  isset($product) ? count($product->productStores) : 0 }};
           if( !count ){
               dynamic_field(count);
           }
           
            function dynamic_field(number){

                html = `<tr id="company-${number}">
                        <td> <input id="store-${number}" type="text" name="company[${number}][store_id]" class="form-control" /> </td>
                        <td><input id="price-${number}" type="text" name="company[${number}][price]" class="form-control" /></td>
                        <td><input id="currency-${number}" type="text" name="company[${number}][currency]" class="form-control" /></td>
                        <td><input id="deliveryPrice-${number}" type="text" name="company[${number}][deliveryPrice]" class="form-control" /></td>
                        <td><input id="discount-${number}" type="text" name="company[${number}][discount]" class="form-control" /></td>`;
                
                if(number == 0){
                    html += '<td><button type="button" name="add" id="add" class="btn btn-success">  <i class="fas fa-plus"> </i></button></td></tr>';
                    $('tbody').html(html);
                }else{   
                    html += `<td><button type="button" name="remove" id="del-${number}" class="btn btn-danger remove"> <i class="fas fa-trash"> </i> </button></td></tr>`;
                    $('tbody').append(html);
                }
            }
           
            $(document).on('click', '#add', function(){
                count++;
                dynamic_field(count);
            });
           
            $(document).on('click', '.remove', function(){
             count--;
             $(this).closest("tr").remove();
            });
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            // console.log('link','{!! route("products.store") !!} ');



            // $('#dynamic_form').on('submit', function(event){
            //        event.preventDefault();
            //     //    $('input[name^="store_id"]')
            //     // price
            //     // currency
            //     // deliveryPrice
            //     // discount

            //     // count
            //     var listPrice = [];
            //     for(let i = 0; i < count ;i++){
            //         let id = i+1;
            //         listPrice[i] = {
            //             store_id:  $(`#store-${id}`).prop('value'),
            //             price: $(`#price-${id}`).prop('value'), 
            //             currency: $(`#currency-${id}`).prop('value'), 
            //             deliveryPrice: $(`#deliveryPrice-${id}`).prop('value'), 
            //             discount: $(`#discount-${id}`).prop('value'), 
            //         };
            //     }
            //     console.log(listPrice);
            //     // return ;
            //        $.ajax({
            //            url:'{{ route("products.store") }}',
            //            method:'post',
            //            data: listPrice,
            //            dataType:'json',
            //            beforeSend:function(){
            //                $('#save').attr('disabled','disabled');
            //            },
            //            success:function(data)
            //            {
            //                 console.log(data);
            //                if(data.error)
            //                {
            //                    var error_html = '';
            //                    for(var count = 0; count < data.error.length; count++)
            //                    {
            //                        error_html += '<p>'+data.error[count]+'</p>';
            //                    }
            //                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
            //                }
            //                else
            //                {
            //                    dynamic_field(1);
            //                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
            //                }
            //                $('#save').attr('disabled', false);
            //            },
            //            error: err=> console.error(err)
            //        })
            // });
           
           });
    </script> --}}



@push('scripts')

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
