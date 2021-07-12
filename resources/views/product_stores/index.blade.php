@extends('layouts.app')

@section('content')
     
    <section class="content-header">
        <h1>الشركات المنتجة لـ  ( {{$productId->productLangs->where('lang_id','=',request('lang')??'2')->first()->name}} ) </h1>    
        
        <h1 class="pull-right">
                <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('productStore.create',$productId) }}">اضافة جديدة</a>
        </h1>
    </section>
    
    <div style="margin-top:-40px;" class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('product_stores.table')
                    <a href="{{ route('products.index') }}" class="btn btn-default">رجوع</a>

            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

