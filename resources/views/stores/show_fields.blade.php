
<!------ Include the above in your HEAD tag ---------->

<div dir="rtl" class="container">

    <div class="row">

        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked admin-menu" >
                <li class="active"><a href="" data-target-id="profile"><i class="glyphicon glyphicon-user"></i>معلومات الشركة </a></li>
                <li><a href="" data-target-id="Arabic"><i class="glyphicon glyphicon-user"></i>الاسم و الوصف (AR) </a></li>
                <li><a href="" data-target-id="English"><i class="glyphicon glyphicon-lock"></i>الاسم والوصف (EN) </a></li>
                <li><a href="" data-target-id="location"> <i class="glyphicon glyphicon-map-marker"></i> الموقع </a></li>

            </ul>
        </div>

        <div class="col-md-8  admin-content" id="profile">

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">الصورة</h3>

                </div>
                <div class="panel-body">
                    @if (!(\Request::is('stores/create')))
                    <img style="width:200px; margin-top:5px;"  class='img-thumbnail' src='{{asset('uploads/images/stores/'.$store->img)}}' />
                    @endif
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">المدينة </h3>
                </div>
                <div class="panel-body">
                {{$store->city->name}}
                </div>
            </div>

            <div class="panel panel-primary" style="margin: 1em;">
                <div class="panel-heading">
                    <h3 class="panel-title">رابط الموقع</h3>
                </div>
                <div class="panel-body">
                  {{$store->link ??'لا يوجد بيانات لعرضها'}}
                </div>
            </div>


        </div>


        <div class="col-md-8  admin-content" id="Arabic">
                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title">  اسم الشركة </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                               {{$storeNameAr ??'لا يوجد بيانات لعرضها'}}
                            </div>
                        </div>

                    </div>
                </div>


                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label for="confirm_password" class="control-label panel-title">وصف الشركة   </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                                {{$storeDescAr ??'لا يوجد بيانات لعرضها'}}


                            </div>
                        </div>
                    </div>
                </div>



        </div>


        <div class="col-md-8  admin-content" id="English">


                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title"> اسم الشركة (EN) </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                                {{$storeNameEn ??'لا يوجد بيانات لعرضها'}}

                            </div>
                        </div>

                    </div>
                </div>


                <div class="panel panel-primary" style="margin: 1em;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><label  class="control-label panel-title">وصف الشركة (EN) </label></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                               {{$storeDescEn ??'لا يوجد بيانات لعرضها'}}

                            </div>
                        </div>
                    </div>
                </div>


                <div class="panel panel-primary border" style="margin: 1em;">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="pull-left">
                                <a href="{{ route('stores.index') }}" class="btn btn-default">رجوع</a>

                            </div>
                        </div>
                    </div>
                </div>

        </div>



         <div class="col-md-8  admin-content" id="location">


                        <div class="panel panel-primary" style="margin: 1em;">
                            <div class="panel-heading">
                                <h3 class="panel-title"><label  class="control-label panel-title">  الموقع </label></h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-sm-10">
                                     
                                        <input id="locationInput" name="location" type="hidden" value="{{json_encode($store->location)}}" name="location" />
                                        <div class="map" id="map" style=" width: 90%;height:150px;"></div>

                                    </div>
                                </div>

                            </div>
                        </div>


                        
                     

                    </div>


    </div>
</div>



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

    <script>

        function GoogleMapsDemo (){
            console.log('init map');
            
               var location = {lat: 23.8859, lng: 45.0792};
              @if (!(\Request::is('stores/create')))
               var location ={ lat:{{ json_decode($store->location)->lat??' 23.8859' }}, lng: {{ json_decode($store->location)->lng??'45.0792' }} };
              @endif 
            // create map
            // "map" is the id of the div that contain map(above)

            var map = new google.maps.Map(document.getElementById('map'), {
                center: location,
                zoom: 6
            });

            //create marker
            var marker = new google.maps.Marker({
                position: location,
                map: map ,
                animation: google.maps.Animation.BOUNCE,
                draggable: true,
            });

        }
    </script>
    <script src="//maps.google.com/maps/api/js?key={{env('Google_MAP_API_Key', 'AIzaSyAPceSsErOlOqRVJ7qIb2ZnbKTPnXb4uP0')}}&callback=GoogleMapsDemo" type="text/javascript"></script>
@endpush
