<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home() {
        return view('frontend.pages.home.home');
    }
    public function aboutUs() {
        return view('frontend.pages.about-us.about_us');
    }
    public function menu() {
        return view('frontend.pages.menu.menu');
    }
    public function contactUS() {
        return view('frontend.pages.contact-us.contact_us');
    }
}
