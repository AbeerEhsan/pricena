@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            الاقسام
        </h1>
    </section>
    <div style="margin-top:-40px;" class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-right: 20px">
                    @include('categories.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
