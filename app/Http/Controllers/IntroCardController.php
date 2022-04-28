<?php

namespace App\Http\Controllers;

use App\Models\IntroCard;
use Illuminate\Http\Request;

class IntroCardController extends Controller
{
    public function getCards()
    {
        return IntroCard::all()->toJson();
    }
}
