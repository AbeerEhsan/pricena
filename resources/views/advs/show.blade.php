@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            الاعلانات
        </h1>
    </section>
    <div style="margin-top:-45px;" class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('advs.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
