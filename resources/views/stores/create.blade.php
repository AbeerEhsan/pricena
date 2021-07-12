@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            الشركات
        </h1>
    </section>
    <div style="margin-top:-50px;" class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'stores.store',
                    'enctype'=>'multipart/form-data' ]) !!}

                        @include('stores.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
