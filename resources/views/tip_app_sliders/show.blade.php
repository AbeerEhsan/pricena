@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            سلايدر التطبيق
        </h1>
    </section>
    <div  style="margin-top:-45px;" class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('tip_app_sliders.show_fields')
                    <a href="{{ route('tipAppSliders.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
