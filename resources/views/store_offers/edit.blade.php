@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            العروض
        </h1>
   </section>
   <div style="margin-top:-40px;" class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($offer, ['route' => ['storeOffers.update', $offer->id], 'method' => 'patch']) !!}

                        @include('store_offers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection