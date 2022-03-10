<?php

use App\Models\Battle;
use App\Models\User;
use App\Models\FamilyMember;
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

Route::get('/battles', function() {
    return Battle::index();
});

Route::get('/users', function() {
    return User::index();
});

Route::get('/family_members', function() {
    return FamilyMember::index();
});
