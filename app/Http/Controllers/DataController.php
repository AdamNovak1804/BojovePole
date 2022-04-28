<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Unit;
use App\Models\Battle;
use App\Models\Cemetery;
use App\Models\Landmark;
use App\Models\Territory;
use App\Models\Country;

class DataController extends Controller
{
    public function getUsersAndRoles()
    {
        $user = Auth::user();

        if ($user->role == 'admin')
        {
            return User::where('id', '!=', $user->id)->get()->toJSon();
        }
        else
        {
            return null;
        }
    }

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

    public function getCountries() {
        return Country::all()->toJson();
    }

    public function postUnit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:45'],
            'type' => ['required'],
            'country' => ['required'],
            'location' => ['required', 'max:45'],
            'latlng' => ['required'],
            'description' => ['max:65535']
        ],
        [
            'name.required' => 'Nebol zadaný názov vojenského útvaru!',
            'name.max' => 'Názov vojenského útvaru musí mať menej ako 46 znakov!',
            'type.required' => 'Nebol zadaný typ vojenského útvaru!',
            'country.required' => 'Nebola zadaná krajina pôvodu vojenského útvaru!',
            'location.required' => 'Nebolo zadané mesto základne vojenského útvaru!',
            'location.max' => 'Názov mesta základne musí mať menej ako 46 znakov!',
            'latlng.required' => 'Nebola zadaná geografická poloha vojenského útvaru na mape!',
            'description.max' => 'Presihnutý maximálny počet znakov v opise!'
        ]);

        Unit::create([
            'name' => $request->name,
            'visible' => '0',
            'reliability' => '0',
            'type' => $request->type,
            'country' => $request->country,
            'location' => $request->location,
            'longtitude' => $request->input('latlng[0]'),
            'latitude' => $request->input('latlng[1]'),
            'description' => $request->description
        ]);
    }

    public function postBattle(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:45'],
            'start' => ['required', 'date', 'after_or_equal:"1914-07-28"', 'before_or_equal:"1918-11-11"'],
            'end' => ['required', 'date', 'after_or_equal:start', 'before_or_equal:"1918-11-11"'],
            'side1' => ['required', 'different:side2'],
            'side2' => ['required'],
            'outcome' => ['required'],
            'latlng' => ['required'],
            'description' => ['max:65535']
        ],
        [
            'title.required' => 'Nebol zadaný názov bitky!',
            'title.max' => 'Názov bitky musí mať menej ako 46 znakov!',
            'start.required' => 'Nebol zadaný dátum začiatku bitky!',
            'start.after_or_equal' => 'Dátum začatia bitky musí byť aspoň 28. júl 1914!',
            'start.before_or_equal' => 'Dátum začatia bitky nesmie byť neskôr ako 11. November 1918!',
            'start.date' => 'Nesprávny formát vstupu!',
            'end.required' => 'Nebol zadaný dátum konca bitky!',
            'end.date' => 'Nesprávny formát vstupu!',
            'end.after_or_equal' => 'Koncový dátum nemôže byť pred začiatkom!',
            'end.before_or_equal' => 'Dátum zakončenia bitky nesmie byť neskôr ako 11. November 1918!',
            'side1.required' => 'Nebol zadaný útočník!',
            'side2.required' => 'Nebol zadaný obranca!',
            'side1.different' => 'Útočník a obranca sa nesmú zhodovať!',
            'outcome.required' => 'Nebol zadaný výsledok bitky!',
            'latlng.required' => 'Nebola zadaná geografická poloha bitky na mape!',
            'description.max' => 'Presihnutý maximálny počet znakov v opise!'
        ]);

        $files = '';

        if ( $request->gallery != null )
        {
            $iter = 0;
            $files = '{ "images" : [';
            foreach ( $request->gallery as $image )
            {
                $name = time().'_'.$iter.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('/images/battles/'), $name);
                $files = $files.' { "path" : "'.$name.'" },';
                $iter++;
            }
            $files[-1] = ' ';
            $files = $files.'] }';
        }

        Battle::create([
            'title' => $request->title,
            'visible' => '0',
            'reliability' => '0',
            'start' => $request->start,
            'end' => $request->end,
            'side1' => $request->side1,
            'side2' => $request->side2,
            'outcome' => $request->outcome,
            'description' => $request->description,
            'longtitude' => $request->input('latlng.1'),
            'latitude' => $request->input('latlng.0'),
            'description' => $request->description,
            'gallery' => $files
        ]);
    }

    public function postCemetery(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:45'],
            'description' => ['max:65535'],
            'latlng' => ['required'],
        ],
        [
            'name.required' => 'Nebol zadaný názov cintorína!',
            'name.max' => 'Názov cintorína musí mať menej ako 46 znakov!',
            'description' => 'Presihnutý maximálny počet znakov v opise!',
            'latlng.required' => 'Nebola zadaná geografická poloha cintorína na mape!',
        ]);

        Cemetery::create([
            'name' => $request->name,
            'visible' => '0',
            'reliability' => '0',
            'description' => $request->description,
            'longtitude' => $request->input('latlng.lng'),
            'latitude' => $request->input('latlng.lat')
        ]);
    }

    public function postLandmark(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:45'],
            'description' => ['max:65535'],
            'latlng' => ['required']
        ],
        [
            'name.required' => 'Nebol zadaný názov pamätníka!',
            'name.max' => 'Názov pamätníka musí mať menej ako 46 znakov!',
            'description.max' => 'Presihnutý maximálny počet znakov v opise!',
            'latlng.required' => 'Nebola zadaná geografická poloha pamätníka na mape!'
        ]);

        Landmark::create([
            'name' => $request->name,
            'visible' => '0',
            'reliability' => '0',
            'description' => $request->description,
            'longtitude' => $request->input('latlng.lng'),
            'latitude' => $request->input('latlng.lat')
        ]);
    }
}
