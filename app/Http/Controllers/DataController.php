<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Unit;
use App\Models\Battle;
use App\Models\Cemetery;
use App\Models\Landmark;
use App\Models\Territory;

class DataController extends Controller
{
    public function getUnits() {
        return Unit::with('country')->get()->toJson();
    }

    public function getBattles() {
        return Battle::with('side1', 'side2')->get()->toJson();
    }

    public function getCemeteries() {
        return Cemetery::all()->toJson();
    }

    public function getLandmarks() {
        return Landmark::all()->toJson();
    }

    public function getTerritories() {
        return Territory::all()->toJson();
    }
}
