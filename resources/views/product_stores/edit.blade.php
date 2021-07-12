@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            <h1>الشركات المنتجة لـ  ( {{$product->productLangs->where('lang_id','=',request('lang')??'2')->first()->name}} ) 
            </h1>
   </section>
   <div style="margin-top:-40px;" class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productStore, ['route' => ['productStores.update', $productStore->id], 'method' => 'patch']) !!}

                        @include('product_stores.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection