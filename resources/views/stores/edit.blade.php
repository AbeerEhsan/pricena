@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{$store->storeLangs->where('lang_id','=',request('lang')??'2')->first()->name}}  
        </h1>
   </section>
   <div style="margin-top:-50px;" class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($store, ['route' => ['stores.update', $store->id], 
                   'method' => 'patch',
                   'enctype'=>'multipart/form-data' ]) !!}

                        @include('stores.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection