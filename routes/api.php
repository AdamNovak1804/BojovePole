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

Route::get('/user', function() {
    return User::find(Auth::id());
});

Route::get('/family_members', function() {
    return FamilyMember::index();
});

Route::get('/get_cards', 'IntroCardController@getCards');

Route::get('/get_messages', 'UserController@getMessages');

Route::get('/get_family', 'UserController@getFamily');

Route::get('/get_units', 'DataController@getUnits');

Route::get('/get_battles', 'DataController@getBattles');

Route::get('/get_cemeteries', 'DataController@getCemeteries');

Route::get('/get_landmarks', 'DataController@getLandmarks');

Route::get('/get_territories', 'DataController@getTerritories');

Route::get('/get_countries', 'DataController@getCountries');

Route::post('/post_unit', 'DataController@postUnit');

Route::post('/post_battle', 'DataController@postBattle');

Route::post('/post_cemetery', 'DataController@postCemetery');

Route::post('/post_landmark', 'DataController@postLandmark');

Route::post('/send_message', 'UserController@sendMessage');

Route::post('/post_member', 'UserController@postMember');

Route::post('/register', 'UserController@register');

Route::post('/login', 'UserController@login');

Route::post('/logout', 'UserController@logout');

Route::post('/update_user', 'UserController@updateUser');
