@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Cobons
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($cobons, ['route' => ['cobons.update', $cobons->id], 'method' => 'patch']) !!}

                        @include('cobons.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection