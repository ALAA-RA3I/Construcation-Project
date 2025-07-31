@extends('layouts.app')
@section('page-title','About Us')
@section('main-content')
    <!-- subheader -->
    <section id="subheader" data-stellar-background-ratio=".3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>About Us</h1>
                    <div class="small-border-deco"><span></span></div>
                    <ul class="crumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="sep"></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- subheader close -->

    <!-- content begin -->
    <div id="content" class="no-bottom">

        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="padding30 mb30" data-bgcolor="#eee">
                                <div class="box-icon-simple left">
                                    <i class="icon_comment_alt wow bounceIn id-color" data-wow-delay=".5s"></i>
                                    <div class="text">
                                        <h3>Our Vision</h3>
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="padding30 mb30" data-bgcolor="#eee">
                                <div class="box-icon-simple left">
                                    <i class="icon_clock_alt wow bounceIn id-color" data-wow-delay=".5s"></i>
                                    <div class="text">
                                        <h3>Our Mission</h3>
                                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <figure class="pic-hover hover-scale mb30">
                                    <span class="center-xy">
                                        <a class="popup-youtube" href="https://www.youtube.com/watch?v=rwvmru5JmXk">
                                            <i class="fa fa-play btn-action btn-play btn-action-hide"></i></a>
                                    </span>
                                <span class="bg-overlay"></span>
                                <img src="images/misc/pic_5.jpg" class="img-responsive" alt="">
                            </figure>
                        </div>


                        <div class="col-md-6">

                            <figure class="pic-hover hover-scale mb20">
                                    <span class="center-xy">
                                        <a class="image-popup" href="images/misc/pic_6.jpg">
                                            <i class="fa fa-image btn-action btn-action-hide"></i></a>
                                    </span>
                                <span class="bg-overlay"></span>
                                <img src="images/misc/pic_6.jpg" class="img-responsive" alt="">
                            </figure>

                            <h3>Planning</h3>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae. </p>
                        </div>

                        <div class="col-md-6">
                            <h3>Constructing</h3>
                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae. </p>

                            <figure class="pic-hover hover-scale mt20">
                                    <span class="center-xy">
                                        <a class="image-popup" href="images/misc/pic_7.jpg">
                                            <i class="fa fa-image btn-action btn-action-hide"></i></a>
                                    </span>
                                <span class="bg-overlay"></span>
                                <img src="images/misc/pic_7.jpg" class="img-responsive" alt="">
                            </figure>

                        </div>
                    </div>
                </div>

                <aside id="sidebar" class="col-md-3">

                    <div class="widget">
                        <div class="padding30 text-black" data-bgimage="url(images/background/banner-1.jpg)">
                            <h4>Attention!</h4>
                            Looking for best partner for your next construction works? Sed ut perspiciatis unde omnis iste natus error sit voluptatem.
                            <div class="text-center">
                                <a href="contact.html" class="btn btn-line-black btn-fx mt20">Hire Us Now</a>
                            </div>
                        </div>
                    </div>


                </aside>

            </div>
        </div>

        <!-- section begin -->
        <section class="call-to-action bg-color dark pt20 pb20 mt80" data-speed="5" data-type="background">
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
