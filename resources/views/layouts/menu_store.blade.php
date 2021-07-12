<li class="{{ Request::is('home') || Request::is('/')  ? 'active' : '' }}">
    <a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i><span>لوحة التحكم</span></a>
</li>




<li class="{{ Request::is('storeProducts*') ? 'active' : '' }}">
    <a href="{{ route('storeProducts.index') }}"><i class="fa fa-store"></i><span>المنتجات </span></a>
</li>


<li class="{{ Request::is('storeOffers*') ? 'active' : '' }}">
    <a href="{{ route('storeOffers.index') }}"><i class="fa fa-th"></i><span>العروض</span></a>
</li>



