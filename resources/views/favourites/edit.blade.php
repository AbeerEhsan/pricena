@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Favourite
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($favourite, ['route' => ['favourites.update', $favourite->id], 'method' => 'patch']) !!}

                        @include('favourites.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection