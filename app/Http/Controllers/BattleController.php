<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use App\Models\Battle;

class BattleController extends Controller
{
    public function getBattles()
    {
        return Battle::with('side1', 'side2')->where('visible', '=', 1)->orderBy('start')->get()->toJson();
    }

    public function getBattleRequests()
    {
        return Battle::with('side1', 'side2')->where('visible', '=', 0)->get()->toJson();
    }

    public function postBattle(Request $request)
    {
        if ( !Auth::check() )
        {
            throw ValidationException::withMessages([
                'login' => 'Používateľ nie je príhlasený!',
            ]);
        }

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

        $files = null;

        if ( !empty($request->gallery) )
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
            if ( $gallery->images === [] )
            {
                $gallery = null;
            }
            else
            {
                $gallery = array_values($gallery->images);
            }
        }

        if ( empty($gallery) ) {
            $gallery = new \stdClass;
            $gallery->images = [];
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

        if ( $gallery->images !== [] ) {
            $battle->gallery = '{"images": '.json_encode($gallery->images).'}';
        }

        $battle->save();
    }

    public function deleteBattle(Request $request)
    {
        $images = array_column(array_values($request->input('gallery'))[0], "path");
        foreach( $images as $image )
        {
            $path = public_path().'/images/userContent/'.$image;
            if ( File::exists($path) )
            {
                File::delete($path);
            }

            $path = public_path().'/images/'.$image;
            if ( File::exists($path) )
            {
                File::delete($path);
            }
        }

        $images = $request->input('to_delete');
        foreach( $images as $image )
        {
            $path = public_path().'/images/userContent/'.$image;
            if ( File::exists($path) )
            {
                File::delete($path);
            }

            $path = public_path().'/images/'.$image;
            if ( File::exists($path) )
            {
                File::delete($path);
            }
        }

        Battle::find($request->id)->delete();
    }
}
