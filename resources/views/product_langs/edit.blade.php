@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Product Lang
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productLang, ['route' => ['productLangs.update', $productLang->id], 'method' => 'patch']) !!}

                        @include('product_langs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection