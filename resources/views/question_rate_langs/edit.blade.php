@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Question Rate Lang
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($questionRateLang, ['route' => ['questionRateLangs.update', $questionRateLang->id], 'method' => 'patch']) !!}

                        @include('question_rate_langs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection