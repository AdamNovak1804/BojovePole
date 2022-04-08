<?php

use App\Models\Battle;
use App\Models\User;
use App\Models\FamilyMember;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authenticated', function() {
    return true;
});

Route::get('/battles', function() {
    return Battle::index();
});

Route::get('/users', function() {
    return User::index();
});

Route::get('/family_members', function() {
    return FamilyMember::index();
});

Route::get('/get_cards', 'IntroCardController@getCards');

Route::get('/get_messages', 'UserController@getMessages');

Route::post('/send_message', 'UserController@sendMessage');

Route::post('/register', 'UserController@register');

Route::post('/login', 'UserController@login');

Route::post('/logout', 'UserController@logout');
