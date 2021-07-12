@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            الاشعارات
        </h1>
   </section>
   <div style="margin-top:-45px;" class="content">
       @include('adminlte-templates::common.errors')
       <div class="clearfix"></div>

       @include('flash::message')

       <div class="clearfix"></div>
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
               {!! Form::open(['route' => 'notification.store',
                 'enctype'=>'multipart/form-data'
                 ]) !!}

                   <div class="col-md-12" style="font-weight: bold;color: darkred;margin-bottom: 2em">
                       تنبيه : سوف تقوم بارسال الاشعار الى جميع مستخدمي التطبيق
                   </div>
                   <!-- Name Field -->
                       <div class="form-group col-sm-12">
                           {!! Form::label('data', 'نص الاشعار : ') !!}
                           {!! Form::textarea('data', null, ['class' => 'form-control']) !!}
                       </div>

                   <!-- Submit Field -->
                       <div class="form-group col-sm-12">
                           {!! Form::submit('ارسال', ['class' => 'btn btn-primary']) !!}
                       </div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection