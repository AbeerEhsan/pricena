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
                    {!! Form::open(['route' => 'categories.store',
                    'enctype'=>'multipart/form-data' ]) !!}

                        @include('categories.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
