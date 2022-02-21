<?php

use Illuminate\Support\Facades\Route;

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


/*
| Base URL redirects to the home page
*/
Route::get('/', function () {
    return redirect('/domov');
});

/*
| Home page
*/
Route::get('/domov', function () {
    return view('home');
});

/*
| Intro page
*/
Route::get('/uvod', function () {
    return view('intro');
});

/*
| Map page
*/
Route::get('/mapa', function () {
    return view('map');
});
