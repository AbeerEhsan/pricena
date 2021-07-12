@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Question Rate Answer
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($questionRateAnswer, ['route' => ['questionRateAnswers.update', $questionRateAnswer->id], 'method' => 'patch']) !!}

                        @include('question_rate_answers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection