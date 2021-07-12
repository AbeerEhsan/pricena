@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{$product->productLangs->where('lang_id','=',request('lang')??'2')->first()->name}}  

        </h1>
    </section>
    <div  style="margin-top:-50px;" class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-right: 20px">
                    @include('products.show_fields')

                </div>
            </div>
        </div>
    </div>
@endsection
