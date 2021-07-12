@extends('layouts.app')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/scrapping.css')}}">
@endsection

@section('content')

    <section class="content-header">
        <h1 class="pull-left">سحب أسعار المنتجات</h1>
        {{-- <h1 class="pull-right">
           <a class="btn btn-primary pull-right"
           style="margin-top: -10px;margin-bottom: 5px"
           href="{{ route('advs.create') }}">Add New</a>
        </h1> --}}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div id="loader" class="hide">
                <div class="spinner"></div>
            </div>
            <div class="box-body">
                    {{-- @include('advs.table') --}}
                <h4>روابط مقترحة</h4>
                <ul class="list-unstyled suggesting-links">
                    <li>
                        <a href="#" data-href="https://www.noon.com/saudi-en/casual-shemagh-red-white/N26248695V/p?o=c5d66307ed0376fc">
                            Casual Shemagh Red/White
                        </a>
                    </li>
                    <li>
                        <a href="#" data-href="https://www.noon.com/saudi-en/airpods-2019-with-charging-case-white/N22732308A/p?o=a11a78f88c441a1a">
                            AirPods (2019) With Charging Case White
                        </a>
                    </li>
                    <li>
                        <a href="#" data-href="https://www.noon.com/saudi-en/iphone-x-without-facetime-silver-64gb-4g-lte/N12311053A/p?o=f11d4bba69a259ce">
                            iPhone X Without FaceTime Silver 64GB 4G LTE
                        </a>
                    </li>
                    <li>
                        <a href="#" data-href="https://www.noon.com/saudi-en/iphone-11-with-facetime-purple-128gb-4g-lte-ksa-specs/N29885950A/p?o=f56781bb2dc3ea7f">
                            iPhone 11 With FaceTime Purple 128GB 4G LTE - KSA Specs
                        </a>
                    </li>
                </ul>
                <br>
                <form id="scrapForm" method="get" action="">
                    <div class="form-group">
                        <label for="scrapLink">أدخل رابط منتج من منصة نون للبحث عنه</label>

                        <div class="input-group">
                            <input type="text" class="form-control" name="link"
                            id="scrapLink" aria-describedby="helpId" placeholder="https://www.noon.com/******">

                            <div class="input-group-btn">
                                <button type="button" id="doScrap" class="btn btn-primary ">جلب البيانات </button>
                            </div>
                        </div>

                        <small id="helpId" class="form-text text-muted">ادخل الرابط كامل للاعلان:
                            <a href="#" data-href="https://www.noon.com/saudi-en/airpods-2019-with-charging-case-white/N22732308A/p?o=a11a78f88c441a1a">
                                https://www.noon.com/saudi-en/airpods-2019-with-charging-case-white/N22732308A/p?o=a11a78f88c441a1a
                            </a>
                        </small>
                    </div>
                </form>

            </div>
        </div>
        {{-- {
            "data": {
                "price": "85.00",
                "currency": "SAR",
                "image": "https://k.nooncdn.com/t_desktop-pdp-v1/v1543307361/N19655586V_1.jpg"
            },
            "message": "successfully detection"
        } --}}
        <div id="getPrice" class="row" style="display: none ;">
            <h6 class="text-right header-hint">
                تفاصيل المنتج
            </h6>
            <div id="products">

            </div>


        </div>
        <div class="text-center">
        </div>

    </div>
@endsection


@push('scripts')
    <script>
        $('a[data-href]').click(e=>{
            // getPrice(e.target.dataset.href);
            e.preventDefault();
            $('#scrapLink').prop('value',e.target.dataset.href );
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getPrice(link) {
            toggleLoader();
            $.post({
                url: "{{ route('scraping.getPrice')}}",
                data: {link: link}
            },response=>{
                // console.log(response);
                displayData(response.data);
            }).fail(err=>{
                console.error(err);
                alert('error !');
            }).always(()=>toggleLoader());
        }

        $('#doScrap').click(e=>{
            e.preventDefault();
            $('#getPrice').css('display', 'none');
            let url = $('#scrapLink').prop('value');
            if(url.trim() == ""){
                return alert('Error, Please insert link');
            }
            getPrice( url);
        });

        $('#scrapForm').submit(e=> {
            e.preventDefault();
            $('#doScrap').click();
        });

        function displayData(data) {
            $('#getPrice').css('display', 'block');
            let product = `
                <div class="col-md-4">
                    <div class="box box-primary product">
                        <div class="box-body">
                            <img class="img-fluid" src="${data.image}">
                            <h4>
                                <a target="_blank" href="${data.url}">${data.title}</a>
                            </h4>
                            <p>السعر: ${data.price} ${data.currency}</p>
                        </div>
                    </div>
                </div>
                `;
            $('#products').html(product);
        }

        var toggleLoader = ()=>{
            $('#loader').toggleClass('hide');
        }

    </script>
@endpush

