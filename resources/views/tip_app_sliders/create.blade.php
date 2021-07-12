@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            سلايدر التطبيق
        </h1>
    </section>
    <div style="margin-top:-45px;" class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'tipAppSliders.store',
                     'enctype'=>'multipart/form-data']) !!}

                        @include('tip_app_sliders.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
