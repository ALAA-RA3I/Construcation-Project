<header>
    <div class="info">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="col"><span class="id-color"><i class="fa fa-map-marker"></i></span>Collins Street West, Victoria 8007 Australia </div>
                    <div class="col"><span class="id-color"><i class="fa fa-clock-o"></i></span>Monday - Friday 08:00-16:00</div>
                    <div class="col"><span class="id-color"><i class="fa fa-phone"></i></span>1800.899.900</div>
                </div>
                <div class="col-md-4 text-right">
                    <!-- social icons -->
                    <div class="col social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-rss"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                        <a href="#"><i class="fa fa-envelope-o"></i></a>
                    </div>
                    <!-- social icons close -->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- logo begin -->
                <div id="logo">
                    <a href="index.html">
                        <img class="logo" src="images/logo.png" alt="">
                        <img class="logo-2" src="images/logo-2.png" alt="">
                    </a>
                </div>
                <!-- logo close -->

                <!-- small button begin -->
                <span id="menu-btn"></span>
                <!-- small button close -->

                <!-- mainmenu begin -->
                <nav>
                    <ul id="mainmenu">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('projects') }}">Projects</a></li>
                        <li><a href="{{ route('services') }}">Services</a>
                            <ul>
                                <li><a href="service-1.html">General Consulting</a></li>
                                <li><a href="service-2.html">Construction Management</a></li>
                                <li><a href="service-3.html">Design and Build</a></li>
                                <li><a href="service-4.html">Preconstruction Consulting</a></li>
                                <li><a href="service-5.html">Special Projects</a></li>
                                <li><a href="service-6.html">Renovations</a></li>
                                <li><a href="{{ route('services') }}">All Services</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('unitsSales') }}">Apartments for Sale</a></li>
                        <li><a href=" {{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>
                <!-- mainmenu close -->

            </div>
        </div>
    </div></header>
