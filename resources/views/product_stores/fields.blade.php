
<div dir="rtl" class="container">

    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="prod1"><i class="glyphicon glyphicon-user"></i> الشركة المنتجة   </a></li>
                <li><a href="" data-target-id="prod2"><i class="glyphicon glyphicon-user"></i> السعر و الخصم</a></li>
               

            </ul>
        </div>


<div class="col-md-8  admin-content" id="prod1">
            
    <div class="panel panel-primary" style="margin: 1em;">
        <div class="panel-heading">
            <h3 class="panel-title">الشركة  </h3>
        </div>
        <div class="panel-body">
            <select name="store_id" id="store" class="js-states form-control">
                @foreach($stores as $store)
                    <option  {{isset($productStore) && $productStore->store_id==$store->id?"selected":" "}}
                     value='{{$store->id}}'> {{$store->storeLangs->where('lang_id','=',request('lang')??'2')->first()->name}} </option>

                @endforeach

             </select>
        </div>


        <div class="panel panel-primary" style="margin: 1em;">
            <div class="panel-heading">
                <h3 class="panel-title"> العملة </h3>
            </div>
            <div class="panel-body">
                <input class="form-control" name="currency" value="{{$productStore->currency ??''}}">
            </div>
        </div>

    </div>
</div>


<div class="col-md-8  admin-content" id="prod2">
            
 
   
    <div class="panel panel-primary" style="margin: 1em;">
            <div class="panel-heading">
                <h3 class="panel-title"> السعر </h3>
            </div>
            <div class="panel-body">
                <input class="form-control" name="price" value="{{$productStore->price ??''}}">
                <input type="hidden" class="form-control" name="product_id" value="{{$product->id ??''}}">
            </div>
    </div>

    <div class="panel panel-primary" style="margin: 1em;">
        <div class="panel-heading">
            <h3 class="panel-title"> الخصم% </h3>
        </div>
        <div class="panel-body">
            <input class="form-control" name="discount" value="{{$productStore->discount ??''}}">
        </div>
    </div>

    {{-- <div class="panel panel-primary" style="margin: 1em;">
        <div class="panel-heading">
            <h3 class="panel-title"> سعر التسليم </h3>
        </div>
        <div class="panel-body">
            <input disabled class="form-control" name="deliveryPrice" value="{{$productStore->deliveryPrice ??''}}">
        </div>
    </div> --}}

 
    <div class="panel panel-primary border" style="margin: 1em;">
        <div class="panel-body">
            <div class="form-group">
                <div class="pull-left">
                    {!! Form::submit('حفظ', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('productStore.index', $product->id) }}" class="btn btn-default">رجوع</a>

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
