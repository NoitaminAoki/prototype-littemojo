<header id="header" id="home">
    <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                <a href="{{ route('home.index') }}"><img src="{{ asset('page_dist/img/logo.png') }}" alt="" title="" /></a>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="index.html">Home</a></li>
                    {{-- <li><a href="about.html">About</a></li> --}}
                    <li><a href="{{url('courses')}}">Courses</a></li>
                    {{-- <li><a href="events.html">Events</a></li> --}}
                    {{-- <li><a href="gallery.html">Gallery</a></li> --}}
                    {{-- <li class="menu-has-children"><a href="">Blog 
                        @hasSection ('font-awesome')
                        <i class="fas fa-angle-down" style="padding-left: 3px;"></i>
                        @endif
                    </a>
                        <ul>
                            <li><a href="blog-home.html">Blog Home</a></li>
                            <li><a href="blog-single.html">Blog Single</a></li>
                        </ul>
                    </li>	 --}}
                    {{-- <li class="menu-has-children"><a href="">Pages 
                        @hasSection ('font-awesome')
                        <i class="fas fa-angle-down" style="padding-left: 3px;"></i>
                        @endif
                    </a>
                        <ul>
                            <li><a href="course-details.html">Course Details</a></li>		
                            <li><a href="event-details.html">Event Details</a></li>		
                            <li><a href="elements.html">Elements</a></li>
                            <li class="menu-has-children"><a href="">Level 2 </a>
                                <ul>
                                    <li><a href="#">Item One</a></li>
                                    <li><a href="#">Item Two</a></li>
                                </ul>
                            </li>					                		
                        </ul>
                    </li>			 --}}
                    @auth('web')
                    <li class="menu-has-children">
                        <a href="javascript:void(0)">
                            Account 
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
                    <li><a class="genric-btn primary small border-0 text-capitalize" href="{{ route('partner.dashboard') }}">Partner Dashboard</a></li>
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