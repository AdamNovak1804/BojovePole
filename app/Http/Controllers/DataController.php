<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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

    public function getUnits()
    {
        return Unit::with('country')->get()->toJson();
    }

    public function getUnitRequests()
    {
        return Unit::with('country')->where('visible', '=', 0)->get()->toJson();
    }

    public function getBattles()
    {
        return Battle::with('side1', 'side2')->orderBy('start')->get()->toJson();
    }

    public function getBattleRequests()
    {
        return Battle::with('side1', 'side2')->where('visible', '=', 0)->get()->toJson();
    }

    public function getCemeteries()
    {
        return Cemetery::all()->toJson();
    }

    public function getCemeteryRequests()
    {
        return Cemetery::where('visible', '=', 0)->get()->toJson();
    }

    public function getLandmarks()
    {
        return Landmark::all()->toJson();
    }

    public function getLandmarkRequests()
    {
        return Landmark::where('visible', '=', 0)->get()->toJson();
    }

    public function getTerritories()
    {
        return Territory::all()->toJson();
    }

    public function getTerritoryRequests()
    {
        return Territory::where('visible', '=', 0)->get()->toJson();
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

        $files = '';

        if ( $request->gallery != null )
        {
            $iter = 0;
            $files = '{ "images" : [';
            foreach ( $request->gallery as $image )
            {
                $name = time().'_'.$iter.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('/images/userContent/'), $name);
                $files = $files.' { "path" : "'.$name.'" },';
                $iter++;
            }
            $files[-1] = ' ';
            $files = $files.'] }';
        }

        Unit::create([
            'name' => $request->name,
            'visible' => '0',
            'reliability' => '0',
            'type' => $request->type,
            'country' => $request->country,
            'location' => $request->location,
            'longtitude' => $request->input('latlng.1'),
            'latitude' => $request->input('latlng.0'),
            'description' => $request->description,
            'gallery' => $files
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
                $image->move(public_path('/images/userContent/'), $name);
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

        $files = '';

        if ( $request->gallery != null )
        {
            $iter = 0;
            $files = '{ "images" : [';
            foreach ( $request->gallery as $image )
            {
                $name = time().'_'.$iter.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('/images/userContent/'), $name);
                $files = $files.' { "path" : "'.$name.'" },';
                $iter++;
            }
            $files[-1] = ' ';
            $files = $files.'] }';
        }

        Cemetery::create([
            'name' => $request->name,
            'visible' => '0',
            'reliability' => '0',
            'description' => $request->description,
            'longtitude' => $request->input('latlng.1'),
            'latitude' => $request->input('latlng.0'),
            'gallery' => $files
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

        $files = '';

        if ( $request->gallery != null )
        {
            $iter = 0;
            $files = '{ "images" : [';
            foreach ( $request->gallery as $image )
            {
                $name = time().'_'.$iter.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('/images/userContent/'), $name);
                $files = $files.' { "path" : "'.$name.'" },';
                $iter++;
            }
            $files[-1] = ' ';
            $files = $files.'] }';
        }

        Landmark::create([
            'name' => $request->name,
            'visible' => '0',
            'reliability' => '0',
            'description' => $request->description,
            'longtitude' => $request->input('latlng.1'),
            'latitude' => $request->input('latlng.0'),
            'gallery' => $files
        ]);
    }

    public function updateUnit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:45'],
            'country' => ['required'],
            'type' => ['required'],
            'location' => ['required'],
            'latlng' => ['required'],
            'description' => ['max:65535']
        ],
        [
            'name.required' => 'Nebol zadaný názov vojenského útvaru!',
            'name.max' => 'Názov vojenského útvaru musí mať menej ako 46 znakov!',
            'country.required' => 'Nebola zadaná krajina pôvodu!',
            'type.required' => 'Nebol zadaný typ vojenského útvaru!',
            'location.required' => 'Nebola zadaná základňa vojenského útvaru!',
            'latlng.required' => 'Nebola zadaná geografická poloha bitky na mape!',
            'description.max' => 'Presihnutý maximálny počet znakov v opise!'
        ]);

        $unit = Unit::find($request->id);

        $gallery = json_decode($unit->gallery);
        $deleted = $request->to_delete;
        $uploaded = $request->to_upload;

        /* Remove deleted images */
        if ( !empty($deleted) )
        {
            foreach ( $gallery->images as $key => $image )
            {
                foreach ( $deleted as $delete )
                {
                    if ( $image->path == $delete )
                    {
                        $path = public_path().'/images/userContent/'.$delete;
                        
                        if ( File::exists($path) )
                        {
                            File::Delete($path);
                        }

                        $path = public_path().'/images/'.$delete;
                        if ( File::exists($path) )
                        {
                            File::Delete($path);
                        }

                        unset($gallery->images[$key]);
                    }
                }
            }
        }

        /* Add new images */
        if ( !empty($uploaded) )
        {
            $iter = 0;
            foreach ( $uploaded as $upload )
            {
                $name = time().'_'.$iter.'.'.$upload->getClientOriginalExtension();
                $file = json_encode(array("path" => $name));
                $upload->move(public_path('/images/userContent/'), $name);
                array_push($gallery->images, json_decode($file));
                $iter++;
            }
        }

        /* Save new data */
        $unit->visible = (int) $request->visible;
        $unit->name = $request->name;
        $unit->country = (int) $request->country;
        $unit->location = $request->location;
        $unit->type = $request->type;
        $unit->longtitude = $request->input('latlng.0');
        $unit->latitude = $request->input('latlng.1');
        $unit->description = $request->description;

        if ( !empty($request->reliability) ) {
            $unit->reliability = $request->reliability;
        }
        else {
            $unit->reliability = '0';
        }

        if ( !empty($gallery) ) {
            $unit->gallery = '{"images": '.json_encode($gallery->images).'}';
        }

        $unit->save();
    }

    public function updateBattle(Request $request)
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

        $battle = Battle::find($request->id);

        $gallery = json_decode($battle->gallery);
        $deleted = $request->to_delete;
        $uploaded = $request->to_upload;

        /* Remove deleted images */
        if ( !empty($deleted) )
        {
            foreach ( $gallery->images as $key => $image )
            {
                foreach ( $deleted as $delete )
                {
                    if ( $image->path == $delete )
                    {
                        $path = public_path().'/images/userContent/'.$delete;
                        
                        if ( File::exists($path) )
                        {
                            File::Delete($path);
                        }

                        $path = public_path().'/images/'.$delete;
                        if ( File::exists($path) )
                        {
                            File::Delete($path);
                        }

                        unset($gallery->images[$key]);
                    }
                }
            }
        }
        
        /* Add new images */
        if ( !empty($uploaded) )
        {
            $iter = 0;
            foreach ( $uploaded as $upload )
            {
                $name = time().'_'.$iter.'.'.$upload->getClientOriginalExtension();
                $file = json_encode(array("path" => $name));
                $upload->move(public_path('/images/userContent/'), $name);
                array_push($gallery->images, json_decode($file));
                $iter++;
            }
        }

        /* Save new data */
        $battle->visible = (int) $request->visible;
        $battle->title = $request->title;
        $battle->start = $request->start;
        $battle->end = $request->end;
        $battle->side1 = (int) $request->side1;
        $battle->side2 = (int) $request->side2;
        $battle->outcome = $request->outcome;
        $battle->longtitude = $request->input('latlng.0');
        $battle->latitude = $request->input('latlng.1');
        $battle->description = $request->description;

        if ( !empty($request->reliability) ) {
            $battle->reliability = $request->reliability;
        }
        else {
            $battle->reliability = '0';
        }

        if ( !empty($gallery) ) {
            $battle->gallery = '{"images": '.json_encode($gallery->images).'}';
        }

        $battle->save();
    }

    public function updateCemetery(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:45'],
            'latlng' => ['required'],
            'description' => ['max:65535']
        ],
        [
            'name.required' => 'Nebol zadaný názov bitky!',
            'name.max' => 'Názov bitky musí mať menej ako 46 znakov!',
            'latlng.required' => 'Nebola zadaná geografická poloha bitky na mape!',
            'description.max' => 'Presihnutý maximálny počet znakov v opise!'
        ]);

        $cemetery = Cemetery::find($request->id);

        $gallery = json_decode($cemetery->gallery);
        $deleted = $request->to_delete;
        $uploaded = $request->to_upload;

        /* Remove deleted images */
        if ( !empty($deleted) )
        {
            foreach ( $gallery->images as $key => $image )
            {
                foreach ( $deleted as $delete )
                {
                    if ( $image->path == $delete )
                    {
                        $path = public_path().'/images/userContent/'.$delete;
                        
                        if ( File::exists($path) )
                        {
                            File::Delete($path);
                        }

                        $path = public_path().'/images/'.$delete;
                        if ( File::exists($path) )
                        {
                            File::Delete($path);
                        }

                        unset($gallery->images[$key]);
                    }
                }
            }
        }
        
        /* Add new images */
        if ( !empty($uploaded) )
        {
            $iter = 0;
            foreach ( $uploaded as $upload )
            {
                $name = time().'_'.$iter.'.'.$upload->getClientOriginalExtension();
                $file = json_encode(array("path" => $name));
                $upload->move(public_path('/images/userContent/'), $name);
                array_push($gallery->images, json_decode($file));
                $iter++;
            }
        }

        /* Save new data */
        $cemetery->visible = (int) $request->visible;
        $cemetery->name = $request->name;
        $cemetery->longtitude = $request->input('latlng.0');
        $cemetery->latitude = $request->input('latlng.1');
        $cemetery->description = $request->description;

        if ( !empty($gallery) ) {
            $cemetery->gallery = '{"images": '.json_encode($gallery->images).'}';
        }

        $cemetery->save();
    }

    public function updateLandmark(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:45'],
            'latlng' => ['required'],
            'description' => ['max:65535']
        ],
        [
            'name.required' => 'Nebol zadaný názov bitky!',
            'name.max' => 'Názov bitky musí mať menej ako 46 znakov!',
            'latlng.required' => 'Nebola zadaná geografická poloha bitky na mape!',
            'description.max' => 'Presihnutý maximálny počet znakov v opise!'
        ]);

        $landmark = Landmark::find($request->id);

        $gallery = json_decode($landmark->gallery);
        $deleted = $request->to_delete;
        $uploaded = $request->to_upload;

        /* Remove deleted images */
        if ( !empty($deleted) )
        {
            foreach ( $gallery->images as $key => $image )
            {
                foreach ( $deleted as $delete )
                {
                    if ( $image->path == $delete )
                    {
                        $path = public_path().'/images/userContent/'.$delete;
                        
                        if ( File::exists($path) )
                        {
                            File::Delete($path);
                        }

                        $path = public_path().'/images/'.$delete;
                        if ( File::exists($path) )
                        {
                            File::Delete($path);
                        }

                        unset($gallery->images[$key]);
                    }
                }
            }
        }
        
        /* Add new images */
        if ( !empty($uploaded) )
        {
            $iter = 0;
            foreach ( $uploaded as $upload )
            {
                $name = time().'_'.$iter.'.'.$upload->getClientOriginalExtension();
                $file = json_encode(array("path" => $name));
                $upload->move(public_path('/images/userContent/'), $name);
                array_push($gallery->images, json_decode($file));
                $iter++;
            }
        }

        /* Save new data */
        $landmark->visible = (int) $request->visible;
        $landmark->name = $request->name;
        $landmark->longtitude = $request->input('latlng.0');
        $landmark->latitude = $request->input('latlng.1');
        $landmark->description = $request->description;

        if ( !empty($gallery) ) {
            $landmark->gallery = '{"images": '.json_encode($gallery->images).'}';
        }

        $landmark->save();
    }

    public function getUserContentImage($image)
    {
        $path = public_path().'/images/userContent/'.$image;

        $headers = array(
            'Content-Type' => 'image/png'
        );

        return response()->file($path, $headers);
    }

    public function deleteBattle(Request $request)
    {
        Battle::find($request->id)->delete();
    }

    public function deleteUnit(Request $request)
    {
        Unit::find($request->id)->delete();
    }

    public function deleteCemetery(Request $request)
    {
        Cemetery::find($request->id)->delete();
    }
}
