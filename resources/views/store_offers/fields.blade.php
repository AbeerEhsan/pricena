<!------ Include the above in your HEAD tag ---------->

<div dir="rtl" class="container">
  
    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="profile"><i class="glyphicon glyphicon-user"></i> معلومات العرض </a></li>
  
            </ul>
        </div>

        <div class="col-md-8  admin-content" id="profile">
         
          
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">المنتج </h3>
                </div>
                <div class="panel-body">
                    <select name="product_id" id="city" class="js-states form-control">
                        @foreach($products as $product)   
                        
                        @if(request('lang'))
                        <option {{isset($offer) && $offer->product_id==$product->productLangs->where('lang_id','=',request('lang'))->first()->product_id?"selected":" "}}
                        value='{{$product->id}}'> {{$product->productLangs->where('lang_id','=',request('lang'))->first()->name}} </option>
    
                        @else
                        <option {{isset($offer) && $offer->product_id==$product->productLangs->where('lang_id','=','2')->first()->product_id?"selected":" "}}
                            value='{{$product->id}}'> {{$product->productLangs->where('lang_id','=','2')->first()->name}} </option>
        
                        @endif
                        
                       @endforeach
                    </select>
                </div>
            </div>

            
         
{{-- 
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">تفعيل كـ سلايدر </h3>
                </div>
                <div class="panel-body">
    
                <input type='hidden' value='0' name='is_star'/>
                @if (!(\Request::is('offers/create'))) 
                <input {{$offer->is_star?"checked":""}} id="toggle-state"  value='1' name="is_star" type="checkbox" data-toggle="toggle">
                 @else
                 <input id="toggle-state"  value='1' name="is_star" type="checkbox" data-toggle="toggle">
                @endif

                </div>
            </div> --}}


            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">رابط الموقع</h3>
                </div>
                <div class="panel-body">
                    <input class="form-control" name="link" value="{{$offer->link ??''}}">    
                </div>
            </div>
        
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">الخصم </h3>
                </div>
                <div class="panel-body">
                    <input class="form-control" name="discount" value="{{$offer->discount ??''}}">    
                </div>
            </div>
        
            
            <div class="panel panel-primary border" style="margin: 1em;">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="pull-left">
                            {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('storeOffers.index') }}" class="btn btn-default">رجوع</a>

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




