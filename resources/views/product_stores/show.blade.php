@extends('layouts.app')

@section('content')
    <section class="content-header">

      <h1>الشركات المنتجة  


    </section>
    <div style="margin-top:-40px;" class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('product_stores.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
