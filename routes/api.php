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

Route::get('/get_cards', 'IntroCardController@getCards');

Route::get('/get_received_messages', 'UserController@getReceivedMessages');
Route::get('/get_sent_messages', 'UserController@getSentMessages');
Route::get('/get_contacts', 'UserController@getContacts');
Route::get('/get_family', 'UserController@getFamily');

Route::get('/get_users_and_roles', 'DataController@getUsersAndRoles');

Route::get('/get_units', 'UnitController@getUnits');
Route::get('/get_battles', 'BattleController@getBattles');
Route::get('/get_cemeteries', 'CemeteryController@getCemeteries');
Route::get('/get_landmarks', 'LandmarkController@getLandmarks');
Route::get('/get_territories', 'TerritoryController@getTerritories');
Route::get('/get_countries', 'CountryController@getCountries');

Route::get('/get_cemetery_members', 'CemeteryController@getCemeteryMembers');
Route::get('/get_unit_members', 'UnitController@getUnitMembers');

Route::get('/get_family_member_requests', 'FamilyMemberController@getFamilyMemberRequests');
Route::get('/get_unit_requests', 'UnitController@getUnitRequests');
Route::get('/get_battle_requests', 'BattleController@getBattleRequests');
Route::get('/get_cemetery_requests', 'CemeteryController@getCemeteryRequests');
Route::get('/get_landmark_requests', 'LandmarkController@getLandmarkRequests');
Route::get('/get_territory_requests', 'TerritoryController@getTerritoryRequests');

Route::post('/post_unit', 'UnitController@postUnit');
Route::post('/post_battle', 'BattleController@postBattle');
Route::post('/post_cemetery', 'CemeteryController@postCemetery');
Route::post('/post_landmark', 'LandmarkController@postLandmark');
Route::post('/post_territory', 'TerritoryController@postTerritory');

Route::post('/update_family_member', 'FamilyMemberController@updateFamilyMember');
Route::post('/update_unit', 'UnitController@updateUnit');
Route::post('/update_battle', 'BattleController@updateBattle');
Route::post('/update_cemetery', 'CemeteryController@updateCemetery');
Route::post('/update_landmark', 'LandmarkController@updateLandmark');
Route::post('/update_territory', 'TerritoryController@updateTerritory');

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
Route::delete('/delete_members', 'UserController@deleteMembers');

Route::delete('/delete_family_member', 'FamilyMemberController@deleteFamilyMember');
Route::delete('/delete_unit', 'UnitController@deleteUnit');
Route::delete('/delete_battle', 'BattleController@deleteBattle');
Route::delete('/delete_cemetery', 'CemeteryController@deleteCemetery');
Route::delete('/delete_landmark', 'LandmarkController@deleteLandmark');
Route::delete('/delete_territory', 'TerritoryController@deleteTerritory');
