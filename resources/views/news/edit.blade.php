@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            الأخبار
        </h1>
   </section>
   <div style="margin-top:-45px;" class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($news, ['route' => ['news.update', $news->id], 
                   'enctype'=>'multipart/form-data',
                   'method' => 'patch']) !!}

                        @include('news.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection