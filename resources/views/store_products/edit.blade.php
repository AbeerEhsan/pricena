@extends('layouts.app')
@section('css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
@endsection
@section('content')
    <section class="content-header">
        <h1>
            {{$product->productLangs->where('lang_id','=',request('lang')??'2')->first()->name}}  
        </h1>
   </section>
   <div  style="margin-top:-50px;" class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row"  style="padding-right: 20px;">
                   {!! Form::model($product, ['route' => ['storeProducts.update', $product->id],
                    'method' => 'patch',
                    'enctype'=>'multipart/form-data' ]) !!}

                        @include('store_products.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
