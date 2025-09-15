@extends('layouts.app')
@section('page-title','Projects')
@section('main-content')
    <!-- subheader -->
    <section id="subheader" data-stellar-background-ratio=".3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Projects</h1>
                    <div class="small-border-deco"><span></span></div>
                    <ul class="crumb">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li class="sep"></li>
                        <li>Projects</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- subheader close -->

    <!-- content begin -->
    <div id="content" class="no-top no-bottom">
        <!-- section begin -->
        <section id="section-portfolio" aria-label="section-portfolio" class="no-top no-bottom">
            <div class="container">

                <div class="spacer-single"></div>

                <!-- portfolio filter begin -->
                <div class="row">
                    <div class="col-md-12">
                        <ul id="filters">
                            <li><a href="#" data-filter=".commercial">Commercial</a></li>
                            <li><a href="#" data-filter=".education">Education</a></li>
                            <li><a href="#" data-filter=".hospitaly">Hospitaly</a></li>
                            <li><a href="#" data-filter=".office">Office</a></li>
                            <li><a href="#" data-filter=".residential">Residential</a></li>
                            <li class="pull-right"><a href="#" data-filter="*" class="selected">All Projects</a></li>
                        </ul>

                    </div>
                </div>
                <!-- portfolio filter close -->

            </div>

            <div id="gallery" class="gallery full-gallery de-gallery pf_full_width pf_4_cols">

                <!-- gallery item -->
                <div class="item residential">
                    <div class="picframe">
                        <a href="project-details-1.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Green House</span>
                                    </span>
                                </span>
                        </a>
                        <img src="images/portfolio/pf%20%281%29.jpg" alt="">
                    </div>
                </div>
                <!-- close gallery item -->

                <!-- gallery item -->
                <div class="item commercial education">
                    <div class="picframe">
                        <a href="project-details-2.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Contemporary Building</span>
                                    </span>
                                </span>
                        </a>

                        <img src="images/portfolio/pf%20%282%29.jpg" alt="">
                    </div>
                </div>
                <!-- close gallery item -->

                <!-- gallery item -->
                <div class="item commercial hospitaly">
                    <div class="picframe">
                        <a href="project-details-3.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Twin Tower</span>
                                    </span>
                                </span>
                        </a>

                        <img src="images/portfolio/pf%20%283%29.jpg" alt="">
                    </div>
                </div>
                <!-- close gallery item -->

                <!-- gallery item -->
                <div class="item commercial hospitaly">
                    <div class="picframe">
                        <a href="project-details-4.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Modern Skyline</span>
                                    </span>
                                </span>
                        </a>
                        <img src="images/portfolio/pf%20%284%29.jpg" alt="">
                    </div>
                </div>
                <!-- close gallery item -->

                <!-- gallery item -->
                <div class="item office commercial">
                    <div class="picframe">
                        <a href="project-details-5.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Modern Office</span>
                                    </span>
                                </span>
                        </a>
                        <img src="images/portfolio/pf%20%285%29.jpg" alt="">
                    </div>
                </div>
                <!-- close gallery item -->

                <!-- gallery item -->
                <div class="item residential">
                    <div class="picframe">
                        <a href="project-details-1.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Country Side House</span>
                                    </span>
                                </span>
                        </a>
                        <img src="images/portfolio/pf%20%286%29.jpg" alt="">
                    </div>
                </div>
                <!-- close gallery item -->

                <!-- gallery item -->
                <div class="item office education">
                    <div class="picframe">
                        <a href="project-details-2.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Cube Office</span>
                                    </span>
                                </span>
                        </a>

                        <img src="images/portfolio/pf%20%287%29.jpg" alt="">
                    </div>
                </div>
                <!-- close gallery item -->

                <!-- gallery item -->
                <div class="item residential">
                    <div class="picframe">
                        <a href="project-details-3.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">London Luxury House</span>
                                    </span>
                                </span>
                        </a>

                        <img src="images/portfolio/pf%20%288%29.jpg" alt="">
                    </div>
                </div>
                <!-- close gallery item -->

                <!-- gallery item -->
                <div class="item office">
                    <div class="picframe">
                        <a href="project-details-4.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Uptown University</span>
                                    </span>
                                </span>
                        </a>

                        <img src="images/portfolio/pf%20%289%29.jpg" alt="">
                    </div>
                </div>
                <!-- close gallery item -->

                <!-- gallery item -->
                <div class="item residential">
                    <div class="picframe">
                        <a href="project-details-5.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Sentra Hospital</span>
                                    </span>
                                </span>
                        </a>

                        <img src="images/portfolio/pf%20%2810%29.jpg" alt="">
                    </div>
                </div>
                <!-- close gallery item -->

                <!-- gallery item -->
                <div class="item hospitaly">
                    <div class="picframe">
                        <a href="project-details-1.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Deluxe Residence</span>
                                    </span>
                                </span>
                        </a>

                        <img src="images/portfolio/pf%20%2811%29.jpg" alt="">
                    </div>
                </div>
                <!-- close gallery item -->

                <!-- gallery item -->
                <div class="item commercial">
                    <div class="picframe">
                        <a href="project-details-2.html">
                                <span class="overlay">
                                    <span class="pf_text">
                                        <span class="project-name">Suburban Office</span>
                                    </span>
                                </span>
                        </a>

                        <img src="images/portfolio/pf%20%2812%29.jpg" alt="">
                    </div>
                </div>
                <!-- close gallery item -->

            </div>

        </section>
        <!-- section close -->

        <!-- section begin -->
        <section class="call-to-action bg-color dark pt20 pb20" data-speed="5" data-type="background">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="mt10">Looking for best partner for your next construction works?</h3>
                    </div>

                    <div class="col-md-4 text-right">
                        <a href="contact.html" class="btn btn-line-black btn-fx">Hire Us Now</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->
    </div>
@endsection
