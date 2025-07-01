<!-- Menu Navigation starts -->
<style>
  nav .app-nav .main-nav>li:not(.menu-title)>.active {
    color: var(--white);
    background: rgba(var(--primary), 1);
  }
</style>
<nav class="@if ($role == 1) vertical-sidebar @else horizontal-sidebar @endif"> 
  <div class="app-logo">
    <a class="logo d-inline-block" href="{{ route('customer') }}">
      <img src="{{ asset('assets/images/logo/kliktopup-logo.png') }}" alt="#">
    </a>

    <span class="bg-light-primary toggle-semi-nav">
      <i class="ti ti-chevrons-right f-s-20"></i>
    </span>
  </div>
  <div class="app-nav" id="app-simple-bar">
    <ul class="main-nav p-0 mt-2">
      @if ($role == 1)
      <li class="menu-title">
      <span>Dashboard</span>
      </li>
      <li class="no-sub">
      <a class="{{ Route::is('admin') ? 'active' : '' }}" href="/admin">
        <i class="ph-duotone ph-house"></i> Dashboard
      </a>
      <li class="menu-title">
      <span>Transaction</span>
      </li>
      </li>
      <li class="no-sub">
      <a class="{{ Route::is('admin_order*') ? 'active' : '' }}" href="/admin_order_list">
        <i class="ph-duotone  ph-clipboard"></i>Order
      </a>
      </li>
      <li class="no-sub">
      <a class="{{ Route::is('admin_report*') ? 'active' : '' }}" href="/admin_report_list">
        <i class="ph-duotone  ph-book-bookmark"></i> Report
      </a>
      </li>
      <li class="menu-title">
      <span>Data Management</span>
      </li>
      <li class="no-sub">
      <a class="{{ Route::is('admin_product*') ? 'active' : '' }}" href="/admin_product_list">
        <i class="ph-duotone  ph-archive"></i> Product
      </a>
      </li>
      <li class="no-sub">
      <a class="{{ Route::is('admin_user*') ? 'active' : '' }}" href="/admin_user_list">
        <i class="ph-duotone ph-user"></i> User
      </a>
      </li>
    @else
   
     <li class="no-sub">
            <a class="{{ Route::is('customer') ? 'active' : '' }}" href="{{ route('customer') }}">
              <i class="ph-duotone  ph-house-line"></i> Beranda
            </a>
          </li>
          <li class="no-sub">
            <a class="{{ Route::is('customer_product*') ? 'active' : '' }}" href="{{ route('customer_product_list') }}">
              <i class="ph ph-game-controller"></i> Games
            </a>
          </li>
          <li class="no-sub">
            <a class="{{ Route::is('customer_order*') ? 'active' : '' }}" href="{{ !session('guest') ? route('customer_order_list') : '#' }}" onclick="if({{session('guest')}}){showToast('danger', 'Silahkan login untuk menggunakan semua fitur KlikTopup!')}">
              <i class="ti ti-report-search"></i> Cek Pesanan
            </a>
          </li>
    @endif
    </ul>
  </div>

  <div class="menu-navs">
    <span class="menu-previous"><i class="ti ti-chevron-left"></i></span>
    <span class="menu-next"><i class="ti ti-chevron-right"></i></span>
  </div>

</nav>
<!-- Menu Navigation ends -->