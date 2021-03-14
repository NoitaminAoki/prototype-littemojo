<header id="header" id="home">
    <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
            <div id="logo">
                <a href="index.html"><img src="img/logo.png" alt="" title="" /></a>
            </div>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="courses.html">Courses</a></li>
                    <li><a href="events.html">Events</a></li>
                    <li><a href="gallery.html">Gallery</a></li>
                    <li class="menu-has-children"><a href="">Blog</a>
                        <ul>
                            <li><a href="blog-home.html">Blog Home</a></li>
                            <li><a href="blog-single.html">Blog Single</a></li>
                        </ul>
                    </li>	
                    <li class="menu-has-children"><a href="">Pages</a>
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
                    </li>			
                    @auth('web')
                    <li><a class="genric-btn primary small border-0 text-capitalize" href="contact.html">My Dashboard</a></li>
                    @endauth		          					          		          
                    @guest
                    <li><a href="{{ route('login') }}">Sign In</a></li>
                    <li><a class="genric-btn primary small border-0 text-capitalize" href="contact.html">Join for Free</a></li>
                    @endguest
                </ul>
            </nav><!-- #nav-menu-container -->		    		
        </div>
    </div>
</header>