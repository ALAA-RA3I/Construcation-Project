@extends('layouts.app')
@section('page-title','About Us')
@section('main-content')
    <!-- subheader -->
    <section id="subheader" data-stellar-background-ratio=".3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Contact Us</h1>
                    <div class="small-border-deco"><span></span></div>
                    <ul class="crumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="sep"></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- subheader close -->

    <!-- content begin -->
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="de_tab tab_style_2">
                        <ul class="de_nav">
                            <li class="active" data-wow-delay="0s"><span>New York</span><div class="v-border"></div>
                            </li>
                            <li><span>London</span><div class="v-border"></div>
                            </li>
                        </ul>

                        <div class="de_tab_content tc_style-1">
                            <div id="tab1">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="map-container">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.840289118618!2d144.9537363149519!3d-37.817209742012885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sid!4v1462781318185" width="600" height="380" frameborder="0" style="border: 0" allowfullscreen></iframe>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <address class="address-style-2">
                                            <span><strong>Address:</strong>Collins Street West, Victoria 8007 Australia</span>
                                            <span><strong>Phone:</strong>(208) 333 9296</span>
                                            <span><strong>Fax:</strong>(208) 333 9298</span>
                                            <span><strong>Email:</strong><a href="mailto:contact@buildpro.com">contact@buildpro.com</a></span>
                                            <span><strong>Web:</strong><a href="#test">http://buildpro-construction.com</a></span>
                                            <span><strong>Open</strong>Sunday - Friday 08:00 - 18:00</span>
                                        </address>
                                    </div>
                                </div>

                            </div>
                            <div id="tab2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="map-container">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12607.36483401036!2d144.94717023712022!3d-37.817188209049284!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642b4758afc1d%3A0x3e495e32dc26749f!2sEnvato!5e0!3m2!1sen!2s!4v1478765341687" width="600" height="450" frameborder="0" style="border: 0" allowfullscreen></iframe>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <address class="address-style-2">
                                            <span><strong>Address:</strong>Collins Street West, Victoria 8007 Australia</span>
                                            <span><strong>Phone:</strong>(208) 333 9296</span>
                                            <span><strong>Fax:</strong>(208) 333 9298</span>
                                            <span><strong>Email:</strong><a href="mailto:contact@buildpro.com">contact@buildpro.com</a></span>
                                            <span><strong>Web:</strong><a href="#test">http://buildpro-construction.com</a></span>
                                            <span><strong>Open</strong>Sunday - Friday 08:00 - 18:00</span>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="padding30" data-bgcolor="#f5f5f5">

                        <h3>Send Us Message
                            <span class="tiny-border"></span>
                        </h3>
                        <form name="contactForm" id='contact_form' method="post" action='email.php'>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id='name_error' class='error'>Please enter your name.</div>
                                    <div>
                                        <input type='text' name='name' id='name' class="form-control" placeholder="Your Name">
                                    </div>

                                    <div id='email_error' class='error'>Please enter your valid E-mail ID.</div>
                                    <div>
                                        <input type='text' name='email' id='email' class="form-control" placeholder="Your Email">
                                    </div>

                                    <div id='phone_error' class='error'>Please enter your phone number.</div>
                                    <div>
                                        <input type='text' name='phone' id='phone' class="form-control" placeholder="Your Phone">
                                    </div>

                                    <div id='message_error' class='error'>Please enter your message.</div>
                                    <div>
                                        <textarea name='message' id='message' class="form-control" placeholder="Your Message"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div id='submit'>
                                        <input type='submit' id='send_message' value='Submit Form' class="btn btn-line">
                                    </div>
                                    <div id='mail_success' class='success'>Your message has been sent successfully.</div>
                                    <div id='mail_fail' class='error'>Sorry, error occured this time sending your message.</div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
