@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Slider Lang
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sliderLang, ['route' => ['sliderLangs.update', $sliderLang->id], 'method' => 'patch']) !!}

                        @include('slider_langs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection