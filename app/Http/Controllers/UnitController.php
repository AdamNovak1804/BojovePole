<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Unit;
use App\Models\FamilyMember;

class UnitController extends Controller
{
    public function getUnits()
    {
        return Unit::with('country')->where('visible', '=', 1)->get()->toJson();
    }

    public function getUnitMembers(Request $request)
    {
        return FamilyMember::where('unit', '=', $request->id)->get()->toJson();
    }

    public function getUnitRequests()
    {
        return Unit::with('country')->where('visible', '=', 0)->get()->toJson();
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

        if ( $gallery->images !== [] ) {
            $unit->gallery = '{"images": '.json_encode($gallery->images).'}';
        }

        $unit->save();
    }

    public function deleteUnit(Request $request)
    {
        Unit::find($request->id)->delete();
    }
}
