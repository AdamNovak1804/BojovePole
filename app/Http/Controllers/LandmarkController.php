<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Landmark;

class LandmarkController extends Controller
{
    public function getLandmarks()
    {
        return Landmark::where('visible', '=', 1)->get()->toJson();
    }

    public function getLandmarkRequests()
    {
        return Landmark::where('visible', '=', 0)->get()->toJson();
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
                        $path = public_path().'/images/userContent/'.$delete;/*
                        
                        if ( File::exists($path) )
                        {
                            File::Delete($path);
                        }*/

                        $path = public_path().'/images/'.$delete;/*
                        if ( File::exists($path) )
                        {
                            File::Delete($path);
                        }*/

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
                $file = json_encode(array("path" => $name));/*
                $upload->move(public_path('/images/userContent/'), $name);*/
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

        if ( $gallery->images !== [] ) {
            $landmark->gallery = '{"images": '.json_encode($gallery->images).'}';
        }

        $landmark->save();
    }

    public function deleteLandmark(Request $request)
    {
        Landmark::find($request->id)->delete();
    }
}
