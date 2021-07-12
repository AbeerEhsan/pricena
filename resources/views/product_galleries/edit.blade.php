@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Product Gallery
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productGallery, ['route' => ['productGalleries.update', $productGallery->id], 'method' => 'patch']) !!}

                        @include('product_galleries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection