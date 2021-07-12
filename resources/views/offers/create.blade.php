@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            العروض
        </h1>
    </section>
    <div style="margin-top:-40px;" class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'offers.store']) !!}

                        @include('offers.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
