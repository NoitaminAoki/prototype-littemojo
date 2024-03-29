<header id="header" id="home">
    <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                <a href="{{ route('home.index') }}"><img src="{{ asset('page_dist/img/logo.png') }}" alt="" title="" /></a>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li><a href="{{url('courses')}}">Courses</a></li>
                    @auth('web')
                    <li class="menu-has-children">
                        <a href="javascript:void(0)">
                            Account 
                            <i class="fas fa-angle-down" style="padding-left: 3px;"></i>
                        </a>
                        <ul>
                            <li><a href="course-details.html">Profile</a></li>		
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    
                                        <i><button type="submit" class="btn btn-link btn-block text-left btn-nav-link">Logout</button></i>
                                    
                                </form>
                            </li>  		
                        </ul>
                    </li>
                    <li><a class="genric-btn primary small border-0 text-capitalize" href="{{ route('home.dashboard.index') }}">My Dashboard</a></li>
                    @endauth
                    @auth('partner')
                    <li><a class="genric-btn primary small border-0 text-capitalize" href="{{ route('partner.dashboard') }}">My Dashboard</a></li>
                    @endauth		   	          					          		          
                    @guest('web')
                    @guest('partner')
                    <li><a href="{{ route('login') }}">Sign In</a></li>
                    <li><a class="genric-btn primary small border-0 text-capitalize" href="{{ route('register') }}">Join for Free</a></li>
                    @endguest
                    @endguest
                </ul>
            </nav><!-- #nav-menu-container -->		    		
        </div>
    </div>
</header>