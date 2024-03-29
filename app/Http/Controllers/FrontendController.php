<?php

namespace App\Http\Controllers;

use App\Models\Catering;
use App\Models\Menu;
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
        $menus = Menu::all();
        foreach ($menus as $menu) {
            $menu->items = json_decode($menu->items);
        }
        return view('frontend.pages.menu.menu', compact('menus'));
    }
    public function contactUS() {
        return view('frontend.pages.contact-us.contact_us');
    }
    public function catering() {
        $caterings = Catering::where('status', 1)->get();
        return $caterings;
        return view('frontend.pages.catering.catering', compact('caterings'));
    }
}
