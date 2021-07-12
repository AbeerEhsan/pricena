<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Vision - Mobile App ">
    <meta name="keywords" content="HTML5, bootstrap, mobile, app, landing, ios, android, responsive">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Font -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;subset=arabic" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/frontassets/css/bootstrap.min.css') }}">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ url('/frontassets/css/themify-icons.css') }}">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="{{ url('/frontassets/css/owl.carousel.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('/frontassets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('/frontassets/css/main.css') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <style>
        p  , h3 , h4 , h5
        {
            text-align: right !important;

        }
        .section {
            padding: 120px 0 0 5px;
        }

        .icon
        {
            padding-left: 10px;
        }

        .nav-menu , .nav-menu.is-scrolling, .nav-menu.menu-is-open
        {
            background-color: #52CAFF !important;
            background-image: linear-gradient(to right, #52CAFF, #45a2d0 120% );
        }
        .nav-menu.is-scrolling, .nav-menu.menu-is-open{
            background-color: #52CAFF !important;
            background-image: linear-gradient(to right, #52CAFF, #45a2d0 120% );


        }
    </style>
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="30" dir="rtl">
<div class="nav-menu fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-dark navbar-expand-lg">
                    <a class="navbar-brand" href="">
                        <h3>World Best Price</h3>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"> <a class="nav-link active" href="{{url('/privacy')}}">سياسة الخصوصية <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="{{url('/contact_us')}}">اتصل بنا <span class="sr-only">(current)</span></a> </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="section light-bg" id="rules">
    <div class="container">

        
        @if(isset($privacy))
        <div class="col-md-12 col-sm-12">
            <h4 style="color:#0F7C76">سياسة الخصوصية</h4>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <p>{!! $privacy !!}</p>
            </div>
        </div>

        @elseif(isset($email) && isset($mobile))
            <div class="col-md-3 col-sm-3">
                <h4 style="color:#0F7C76"><i class="icon far fa-envelope-open"></i>البريد الالكتروني</h4>
            </div>
                <div class="col-md-3 col-sm-3">
                    <p>{!! $email !!}</p>
                </div>
            <div class="col-md-3 col-sm-3">
                <h4 style="color:#0F7C76"><i class="icon fas fa-mobile-alt"></i>الموبايل</h4>
            </div>
                <div class="col-md-3 col-sm-3">
                    <p>{!! $mobile !!}</p>
                </div>
        @endif
    </div>
</div>

<div class="row" >

</div>



<!-- jQuery and Bootstrap -->
<script src="{{ url('/frontassets/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{ url('/frontassets/js/bootstrap.bundle.min.js')}}"></script>
<!-- Plugins JS -->
<script src="{{ url('/frontassets/js/owl.carousel.min.js')}}"></script>
<!-- Custom JS -->
<script src="{{ url('/frontassets/js/script.js')}}"></script>


</body>
</html>
