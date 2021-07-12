@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Question Rate Answer Lang
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('question_rate_answer_langs.show_fields')
                    <a href="{{ route('questionRateAnswerLangs.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
