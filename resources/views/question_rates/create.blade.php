@extends('layouts.app')
@section('css')
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
@endsection
@section('content')
    <section class="content-header">
        <h1>
           الاسئلة
        </h1>
    </section>
    <div  style="margin-top:-40px;" class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'questionRates.store']) !!}

                        @include('question_rates.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
