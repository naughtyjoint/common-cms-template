<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="/img/logo.jpg" alt="9055" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('cms.store_name') }}管理後台</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#"
                   class="d-block"> {{auth()->user()->name!=null ? auth()->user()->name : "Administrator"}} </a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#option" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>網站參數管理</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#type" class="nav-link">
                        <i class="nav-icon fas fa-leaf"></i>
                        <p>分類管理</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#payment" class="nav-link">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>支付管理</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#discount" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>折扣管理</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#item" class="nav-link">
                        <i class="nav-icon fas fa-carrot"></i>
                        <p>品項管理</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#order" class="nav-link">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>訂單管理</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
