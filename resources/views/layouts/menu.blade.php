{{-- @section('css')
<style>
    li .active{
        color: #52caff;
    }
</style>
@endsection --}}

{{-- {{dd(Request::is('users/store'))}} --}}
<li class="{{ Request::is('home') || Request::is('/')  ? 'active' : '' }}">
    <a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i><span>لوحة التحكم</span></a>
</li>

{{-- to separate users --}}
<li class="treeview {{ Request::is('users*') ? 'active' : '' }}" >
    <a href="{!! route('users.index') !!}">
        <span class="pull-left-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
        <i class="fas fa-users"></i><span>المستخدمين</span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="{!! route('users.index') !!}">
                <i class="fa "></i>
               الكل
            </a>
        </li>
        <li class=" {{ Request::is('users/admin') ? 'active' : '' }}">
            <a href="{!! route('users.admins1', ['type'=>'admin']) !!}">
                <i class="fa "></i>
               الادارة
            </a>
        </li>
        <li class=" {{ Request::is('users/store') ? 'active' : '' }}">
            <a href="{!! route('users.admins1', ['type'=>'store']) !!}">
                <i class="fa "></i>
               أصحاب المتاجر
            </a>
        </li>
        <li class=" {{ Request::is('users/user') ? 'active' : '' }}">
            <a href="{!! route('users.admins1', ['type'=>'user']) !!}">
                <i class="fa "></i>
               الزبائن
            </a>
        </li>
    </ul>
</li>

{{--  <li class="{{ Request::is('languages*') ? 'active' : '' }}">
    <a href="{{ route('languages.index') }}"><i class="fas fa-language fa-lg"></i><span>اللغات </span></a>
</li>

<li class="{{ Request::is('countries*') ? 'active' : '' }}">
    <a href="{{ route('countries.index') }}"><i class="fas fa-building fa-lg"></i><span>بلدان</span></a>
</li>

<li class="{{ Request::is('cities*') ? 'active' : '' }}">
    <a href="{{ route('cities.index') }}"><i class="fas fa-building fa-lg"></i><span>مدن</span></a>
</li>  --}}

<li class="{{ Request::is('stores*') ? 'active' : '' }}">
    <a href="{{ route('stores.index') }}"><i class="fas fa-store-alt"></i><span>الشركات </span></a>
</li>

{{-- <li class="{{ Request::is('storeLangs*') ? 'active' : '' }}">
    <a href="{{ route('storeLangs.index') }}"><i class="fa fa-edit"></i><span>Store Langs</span></a>
</li> --}}

<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{{ route('categories.index') }}"><i class="fa fa-th"></i><span>الأقسام</span></a>
</li>

{{-- <li class="{{ Request::is('categoryLanguages*') ? 'active' : '' }}">
    <a href="{{ route('categoryLanguages.index') }}"><i class="fa fa-edit"></i><span>Category Languages</span></a>
</li> --}}

<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{{ route('products.index') }}"><i class="fa fa-store"></i><span>المنتجات </span></a>
</li>

{{--  <li class="{{ Request::is('productLangs*') ? 'active' : '' }}">
    <a href="{{ route('productLangs.index') }}"><i class="fa fa-edit"></i><span>Product Langs</span></a>
</li>  --}}

{{--  <li class="{{ Request::is('productStores*') ? 'active' : '' }}">
    <a href="{{ route('productStores.index') }}"><i class="fa fa-edit"></i><span>Product Stores</span></a>
</li>

<li class="{{ Request::is('productGalleries*') ? 'active' : '' }}">
    <a href="{{ route('productGalleries.index') }}"><i class="fa fa-edit"></i><span>Product Galleries</span></a>
</li>  --}}

{{-- <li class="{{ Request::is('favourites*') ? 'active' : '' }}">
    <a href="{{ route('favourites.index') }}"><i class="fa fa-star"></i><span>المفضلة</span></a>
</li> --}}
{{--
<li class="{{ Request::is('questions*') ? 'active' : '' }}">
    <a href="{{ route('questions.index') }}"><i class="fa fa-edit"></i><span>الأسئلة</span></a>
</li> --}}

{{--  <li class="{{ Request::is('answers*') ? 'active' : '' }}">
    <a href="{{ route('answers.index') }}"><i class="fa fa-edit"></i><span>Answers</span></a>
</li>  --}}

<li class="{{ Request::is('offers*') ? 'active' : '' }}">
    <a href="{{ route('offers.index') }}"><i class="fa fa-th"></i><span>العروض</span></a>
</li>


<li class="{{ Request::is('advs*') ? 'active' : '' }}">
    <a href="{{ route('advs.index') }}"><i class="fa fa-edit"></i><span>الاعلانات </span></a>
</li>

 <li class="{{ Request::is('news*') ? 'active' : '' }}">
    <a href="{{ route('news.index') }}"><i class="fa fa-edit"></i><span>الأخبار</span></a>
</li> 

{{-- <li class="{{ Request::is('cobons*') ? 'active' : '' }}">
    <a href="{{ route('cobons.index') }}"><i class="fa fa-edit"></i><span>Cobons</span></a>
</li> --}}

{{-- <li class="{{ Request::is('sliders*') ? 'active' : '' }}">
    <a href="{{ route('sliders.index') }}"><i class="fa fa-edit"></i><span>سلايدر</span></a>
</li> --}}

{{--  <li class="{{ Request::is('sliderLangs*') ? 'active' : '' }}">
    <a href="{{ route('sliderLangs.index') }}"><i class="fa fa-edit"></i><span>Slider Langs</span></a>
</li>  --}}

<li class="{{ Request::is('questionRates*') ? 'active' : '' }}">
    <a href="{{ route('questionRates.index') }}"><i class="fas fa-question"></i><span>  الاسئلة</span></a>
</li>
{{--
<li class="{{ Request::is('questionRateLangs*') ? 'active' : '' }}">
    <a href="{{ route('questionRateLangs.index') }}"><i class="fa fa-edit"></i><span>Question Rate Langs</span></a>
</li> --}}

{{-- <li class="{{ Request::is('questionRateAnswers*') ? 'active' : '' }}">
    <a href="{{ route('questionRateAnswers.index') }}"><i class="fa fa-edit"></i><span>  الاجابات </span></a>
</li> --}}

{{--
<li class="{{ Request::is('questionRateAnswerLangs*') ? 'active' : '' }}">
    <a href="{{ route('questionRateAnswerLangs.index') }}"><i class="fa fa-edit"></i><span>Question Rate Answer Langs</span></a>
</li> --}}

<li class="{{ Request::is('tipAppSliders*') ? 'active' : '' }}">
    <a href="{{ route('tipAppSliders.index') }}"><i class="fa fa-edit"></i><span>سلايدر التطبيق</span></a>
</li>

{{-- <li class="{{ Request::is('scraping*') ? 'active' : '' }}">
    <a href="{{ route('scraping.index') }}">
        <i class="fa fa-edit"></i><span>سحب المنتجات</span>
    </a>
</li> --}}

<li class="{{ Request::is('notification*') ? 'active' : '' }}">
    <a href="{{ route('notification.index') }}"><i class="fa fa-bell"></i><span>الاشعارات</span></a>
</li>

<li class="{{ Request::is('settings*') ? 'active' : '' }}">
    <a href="{{ route('settings.index') }}"><i class="fa fa-cog"></i><span>الاعدادات</span></a>
</li>
{{--  </li><li class="{{ Request::is('cobonProducts*') ? 'active' : '' }}">
    <a href="{{ route('cobonProducts.index') }}"><i class="fa fa-edit"></i><span>Cobon Products</span></a>
</li>  --}}

{{-- 

<li class="{{ Request::is('questions*') ? 'active' : '' }}">
    <a href="{{ route('questions.index') }}"><i class="fa fa-edit"></i><span>Questions</span></a>
</li> --}}

