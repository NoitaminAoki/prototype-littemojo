<nav class="main-header navbar navbar-expand-md navbar-dark navbar-navy pl-0 pr-0 pb-0 border-bottom-0">
    <div class="d-flex flex-wrap w-100">
        <div class="container pb-2 pr-2" style="padding-left: calc(4.5rem);">
            <a href="{{ route('home.index') }}" class="navbar-brand">
                <img src="{{ asset('page_dist/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
                {{-- <span class="brand-text font-weight-light">LittleMojo</span> --}}
            </a>
            
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('home.dashboard.index') }}" class="nav-link">Home</a>
                    </li>
                </ul>
                
                <!-- SEARCH FORM -->
                <form class="form-inline ml-0 ml-md-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar text-white" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Messages Dropdown Menu -->
                
            </ul>
        </div>
        @hasSection ('breadcrumb-navbar')
        <div class="w-100 mt-2 bg-white border-bottom">
            @yield('breadcrumb-navbar')
        </div>
        @else
            
        @endif
    </div>
</nav>