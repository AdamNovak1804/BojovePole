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
    return Auth::user();
});

Route::get('/family_members', function() {
    return FamilyMember::index();
});

Route::get('/get_cards', 'IntroCardController@getCards');

Route::get('/get_messages', 'UserController@getMessages');

Route::get('/get_family', 'UserController@getFamily');

Route::get('/get_users_and_roles', 'DataController@getUsersAndRoles');

Route::get('/get_units', 'DataController@getUnits');

Route::get('/get_battles', 'DataController@getBattles');

Route::get('/get_cemeteries', 'DataController@getCemeteries');

Route::get('/get_landmarks', 'DataController@getLandmarks');

Route::get('/get_territories', 'DataController@getTerritories');

Route::get('/get_countries', 'DataController@getCountries');

Route::get('/get_unit_requests', 'DataController@getUnitRequests');

Route::get('/get_battle_requests', 'DataController@getBattleRequests');

Route::post('/post_unit', 'DataController@postUnit');
Route::post('/post_battle', 'DataController@postBattle');
Route::post('/post_cemetery', 'DataController@postCemetery');
Route::post('/post_landmark', 'DataController@postLandmark');

Route::post('/update_unit', 'DataController@updateUnit');
Route::post('/update_battle', 'DataController@updateBattle');

Route::post('/send_message', 'UserController@sendMessage');

Route::post('/post_member', 'UserController@postMember');

Route::post('/register', 'UserController@register');

Route::post('/login', 'UserController@login');

Route::post('/logout', 'UserController@logout');

Route::post('/update_user', 'UserController@updateUser');

Route::post('/update_user_role', 'UserController@updateUserRole');

Route::get('/image/{image}', 'UserController@getImage');

Route::get('/userContent/{image}', 'DataController@getUserContentImage');

Route::delete('/delete_user', 'UserController@deleteUser');
