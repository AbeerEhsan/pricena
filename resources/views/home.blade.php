@extends('layouts.app')

@section('css')
    <style>
        .bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body {
            background-color: #65caf8    !important;}
        .bg-red, .callout.callout-danger, .alert-danger, .alert-error, .label-danger, .modal-danger .modal-body {
            background-color: #81caee  !important;
        }
        .bg-blue1, .callout.callout-success, .alert-success, .label-success, .modal-success .modal-body {
            background-color: #a9c9e0  !important ;
            color:white !important ;
        }
        .bg-yellow, .callout.callout-warning, .alert-warning, .label-warning, .modal-warning .modal-body {
            background-color: #c8c8d4  !important;
        }
        .product-info >a{
            color: #5197BE    !important;;
        }

        .users-list > li img {
            width: 100px;
            border-radius: 50%;
            max-width: 100%;
            height: 100px !important;
        }

        .box-header > .fa, .box-header > .glyphicon, .box-header > .ion, .box-header .box-title {
            display: inline-block;
            font-size: 15px !important;
        }
    </style>
@endsection

@section('content')

    <section class="content-header">
        <h1>
            لوحة تحكم و الإحصائيات
            <small>إدارة الموقع </small>
        </h1>
    </section>
    <section class="content home">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">المستخدمين</span>
                        <span class="info-box-number">{{$users_count}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fas fa-box-open"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">المنتجات </span>
                        <span class="info-box-number">{{$products_count}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue1"><i class="fas fa-store-alt"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">المتاجر</span>
                        <span class="info-box-number">{{$store_count}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->



            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-th"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">العروض</span>
                        <span class="info-box-number">{{$offers_count}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <div class="box" style="border-top: 3px solid #5197BE;">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="color: #5197BE">
                            <i class="fas fa-users"></i>
                            المستخدمين الجدد</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            @foreach($latest_users as $user)
                                <li>
                                    <img src="
                                    @if(isset($user->img))
                                    {{ url('uploads/images/users/'.$user->img) }}
                                    @endif
                                            " alt="User Image">
                                    <a class="users-list-name">{{$user->name}}</a>
                                </li>
                            @endforeach

                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{route('users.index')}}" class="uppercase">عرض المستخدمين</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!--/.box -->
            </div>

            <div class="col-md-6">
                <!-- PRODUCT LIST -->
                <div class="box" style="border-top: 3px solid #5197BE;">
                    <div class="box-header with-border">
                        <h3 class="box-title" style="color: #5197BE">
                            <i class="far fa-calendar-alt"></i>
                            المنتجات المضافة حديثا</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    {{-- <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            @foreach($latest_products as $product)
                                <li class="item">
                                    <div class="product-img">
                                        <img src="{{url('uploads/images/'.$product->img)}}" alt="Product Image">
                                    </div>
                                    <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">{{$product->productLangs->where('lang_id','2')->first()->name}}
                                        </a>
                                        <span class="product-description">
                                       {{$product->productLangs->where('lang_id','=','2')->first()->description}}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div> --}}
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="{{route('products.index')}}" class="uppercase">عرض المنتجات</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>



        </div>

    </section>




@endsection

