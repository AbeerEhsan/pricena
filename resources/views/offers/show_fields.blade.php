<!------ Include the above in your HEAD tag ---------->

<div dir="rtl" class="container">
  
    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="profile"><i class="glyphicon glyphicon-user"></i>معلومات العرض </a></li>
  
            </ul>
        </div>

        <div class="col-md-8  admin-content" id="profile">
         
          
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">المنتج </h3>
                </div>
                <div class="panel-body">
                
                {{ $offer->product->productLangs->where('lang_id','=',request('lang')??'2')->first()->name}}                </div>
            </div>

            
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">المتجر </h3>
                </div>
                <div class="panel-body">
                   
                 {{$offer->store->storeLangs->where('lang_id','=',request('lang')??'2')->first()->name}} 
                            
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">رابط الموقع</h3>
                </div>
                <div class="panel-body">
                    {{$offer->link ??'لا يوجد بيانات لعرضها'}}
                </div>
            </div>
        
            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">الخصم </h3>
                </div>
                <div class="panel-body">
                    {{$offer->discount ??'لا يوجد بيانات لعرضها'}}
                </div>
            </div>
        
            
            <div class="panel panel-primary border" style="margin: 1em;">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="pull-left">
                            <a href="{{ route('offers.index') }}" class="btn btn-default">رجوع</a>

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




