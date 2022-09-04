<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
        <i class="fas fa-store"></i>
    </div>
    <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>{{ __('admin.dashboard') }}</span></a>
</li>

<hr class="sidebar-divider my-0">

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
        aria-expanded="true" aria-controls="collapseCategory">
        <i class="fas fa-fw fa-tags"></i>
        <span>{{ __('admin.categories') }}</span>
    </a>
    <div id="collapseCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">

            <a class="collapse-item" href="buttons.html">All Categories</a>
            <a class="collapse-item" href="cards.html">Add New</a>
        </div>
    </div>
</li>

<hr class="sidebar-divider my-0">

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
        aria-expanded="true" aria-controls="collapseProduct">
        <i class="fas fa-fw fa-heart"></i>
        <span>{{ __('admin.products') }}</span>
    </a>
    <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">

            <a class="collapse-item" href="buttons.html">All Products</a>
            <a class="collapse-item" href="cards.html">Add New</a>
        </div>
    </div>
</li>

<hr class="sidebar-divider my-0">

<li class="nav-item">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-shopping-cart"></i>
        <span>{{ __('admin.orders') }}</span></a>
</li>

<hr class="sidebar-divider my-0">

<li class="nav-item">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-money-bill"></i>
        <span>{{ __('admin.payments') }}</span></a>
</li>

<hr class="sidebar-divider my-0">

<li class="nav-item">
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-users"></i>
        <span>{{ __('admin.users') }}</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->
