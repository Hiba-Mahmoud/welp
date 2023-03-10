<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
if(env('APP_ENV') == 'production'){
    URL::forceScheme('https');
}

Route::get('/', function () {
    return view('welcome');
})->name('Home');

Route::fallback(function(){
    return Redirect()->route('Home');
});
