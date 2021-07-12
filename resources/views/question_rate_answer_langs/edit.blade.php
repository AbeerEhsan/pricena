@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Question Rate Answer Lang
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($questionRateAnswerLang, ['route' => ['questionRateAnswerLangs.update', $questionRateAnswerLang->id], 'method' => 'patch']) !!}

                        @include('question_rate_answer_langs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection