<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebSitePagesController extends Controller
{
    public function homePage()
    {
        return view('pages.home-page');
    }
    public function projectsPage()
    {
        return view('pages.projects-page');
    }
    public function servicesPage()
    {
        return view('pages.services-page');
    }
    public function aboutPage()
    {
        return view('pages.about-page');
    }
    public function contactPage()
    {
        return view('pages.contact-page');
    }

}
