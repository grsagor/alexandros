<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(FrontendController::class)->group(function() {
    Route::get('/', 'home')->name('frontend.home');
    Route::get('/about-us', 'aboutUs')->name('frontend.about.us');
    Route::get('/menu', 'menu')->name('frontend.menu');
    Route::get('/contact-us', 'contactUS')->name('frontend.contact.us');
});