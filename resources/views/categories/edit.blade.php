@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            الاقسام
        </h1>
   </section>
   <div style="margin-top:-40px;" class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($category, ['route' => ['categories.update', $category->id], 
                   'method' => 'patch',
                   'enctype'=>'multipart/form-data' ]) !!}

                        @include('categories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection