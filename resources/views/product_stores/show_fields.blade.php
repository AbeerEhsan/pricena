
<div dir="rtl" class="container">

    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="prod1"><i class="glyphicon glyphicon-user"></i> الشركة المنتجة والسعر  </a></li>
                <li><a href="" data-target-id="prod2"><i class="glyphicon glyphicon-user"></i> الخصم والعملة</a></li>
               

            </ul>
        </div>


<div class="col-md-8  admin-content" id="prod1">
            
    <div class="panel panel-primary" style="margin: 1em;">
        <div class="panel-heading">
            <h3 class="panel-title">الشركة  </h3>
        </div>
        <div class="panel-body">
            
                 {{$productStore->store->storeLangs->where('lang_id','=',request('lang')??'2')->first()->name}}


             </select>
        </div>
    </div>

    <div class="panel panel-primary" style="margin: 1em;">
        <div class="panel-heading">
            <h3 class="panel-title"> العملة </h3>
        </div>
        <div class="panel-body">
            {{$productStore->currency ??''}}
        </div>
    </div>


</div>


<div class="col-md-8  admin-content" id="prod2">
            

    <div class="panel panel-primary" style="margin: 1em;">
        <div class="panel-heading">
            <h3 class="panel-title"> السعر </h3>
        </div>
        <div class="panel-body">
           {{$productStore->price ??''}}
        </div>
    </div>

    <div class="panel panel-primary" style="margin: 1em;">
        <div class="panel-heading">
            <h3 class="panel-title"> الخصم </h3>
        </div>
        <div class="panel-body">
          {{$productStore->discount ??''}} %
        </div>
    </div>

    <div class="panel panel-primary" style="margin: 1em;">
        <div class="panel-heading">
            <h3 class="panel-title"> سعر التسليم </h3>
        </div>
        <div class="panel-body">
            {{$productStore->deliveryPrice ??''}}
        </div>
    </div>

   

    

    <div class="panel panel-primary border" style="margin: 1em;">
        <div class="panel-body">
            <div class="form-group">
                <div class="pull-left">
                    <a href="{{ route('productStore.index', $productStore->product_id) }}" class="btn btn-default">رجوع</a>

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
