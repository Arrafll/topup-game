<!-- Menu Navigation starts -->
<style>
  nav .app-nav .main-nav>li:not(.menu-title)>.active {
    color: var(--white);
    background: rgba(var(--primary), 1);
  }
</style>
<nav class="@if ($role == 1) vertical-sidebar @else horizontal-sidebar @endif">
  <div class="app-logo">
    <a class="logo d-inline-block" href="index.html">
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
      <a class="{{ Route::is('admin_order*') ? 'active' : '' }}" href="/admin_product_list">
        <i class="ph-duotone  ph-clipboard"></i>Order
      </a>
      </li>
      <li class="no-sub">
      <a class="" href="widget.html">
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
      <li>
      <a class="" data-bs-toggle="collapse" href="#apps" aria-expanded="false">
        <i class="ph-duotone  ph-stack"></i>
        Apps
      </a>
      <ul class="collapse" id="apps">
        <li><a href="calendar.html">Calender</a></li>
        <li class="another-level">
        <a class="" data-bs-toggle="collapse" href="#Profile-page" aria-expanded="false">
          Profile
        </a>
        <ul class="collapse" id="Profile-page">
          <li><a href="profile.html">Profile</a></li>
          <li><a href="setting.html">Setting</a></li>
        </ul>
        </li>
        <li class="another-level">
        <a class="" data-bs-toggle="collapse" href="#projects-page" aria-expanded="false">
          Projects Page
        </a>
        <ul class="collapse" id="projects-page">
          <li><a href="project_app.html">projects</a></li>
          <li><a href="project_details.html">projects Details</a></li>
        </ul>
        </li>
        <li><a href="to_do.html">To-Do</a></li>
        <li><a href="team.html">Team</a></li>
        <li><a href="api.html">API</a></li>
        <li class="another-level">
        <a class="" data-bs-toggle="collapse" href="#ticket-page" aria-expanded="false">
          Ticket
        </a>
        <ul class="collapse" id="ticket-page">
          <li><a href="ticket.html">Ticket</a></li>
          <li><a href="ticket_details.html">Ticket Details</a></li>
        </ul>
        </li>
        <li class="another-level">
        <a class="" data-bs-toggle="collapse" href="#email-page" aria-expanded="false">
          Email Page
        </a>
        <ul class="collapse" id="email-page">
          <li><a href="email.html"> Email</a></li>
          <li><a href="read_email.html">Read Email</a></li>
        </ul>
        </li>
        <li class="another-level">
        <a class="" data-bs-toggle="collapse" href="#e-shop" aria-expanded="false">
          E-shop
        </a>
        <ul class="collapse" id="e-shop">
          <li><a href="cart.html">Cart</a></li>
          <li><a href="product.html">Product</a></li>
          <li><a href="add_product.html">Add Product</a></li>
          <li><a href="product_details.html">Product-Details</a></li>
          <li><a href="product_list.html">Product list</a></li>
          <li><a href="orders.html">Orders</a></li>
          <li><a href="orders_details.html">Orders Details</a></li>
          <li><a href="orders_list.html">Orders List</a></li>
          <li><a href="checkout.html">Check out</a></li>
          <li><a href="wishlist.html">Wishlist</a></li>
        </ul>
        </li>
        <li><a href="invoice.html">Invoice</a></li>
        <li><a href="chat.html">Chat</a></li>
        <li><a href="file_manager.html">File manager</a></li>
        <li><a href="bookmark.html">Bookmark</a></li>
        <li><a href="kanban_board.html">Kanban board</a></li>
        <li><a href="timeline.html">Timeline</a></li>
        <li><a href="faq.html">FAQS</a></li>
        <li><a href="pricing.html">Pricing</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li class="another-level">
        <a class="" data-bs-toggle="collapse" href="#blog-page" aria-expanded="false">
          Blog Page
        </a>
        <ul class="collapse" id="blog-page">
          <li><a href="blog.html">Blog</a></li>
          <li><a href="blog_read_more.html">Blog Details</a></li>
          <li><a href="add_blog.html">Add Blog</a></li>

        </ul>
        </li>
      </ul>
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