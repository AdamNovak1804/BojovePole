<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use App\Models\Cemetery;
use App\Models\FamilyMember;

class CemeteryController extends Controller
{
    public function getCemeteries()
    {
        return Cemetery::where('visible', '=', 1)->get()->toJson();
    }

    public function getCemeteryMembers(Request $request)
    {
        return FamilyMember::where('cemetery', '=', $request->id)->get()->toJson();
    }

    public function getCemeteryRequests()
    {
        return Cemetery::where('visible', '=', 0)->get()->toJson();
    }

    public function postCemetery(Request $request)
    {
        if ( !Auth::check() )
        {
            throw ValidationException::withMessages([
                'login' => 'Používateľ nie je príhlasený!',
            ]);
        }

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
        $cemetery->visible = (int) $request->visible;
        $cemetery->name = $request->name;
        $cemetery->longtitude = $request->input('latlng.0');
        $cemetery->latitude = $request->input('latlng.1');
        $cemetery->description = $request->description;

        if ( !empty($request->reliability) ) {
            $cemetery->reliability = $request->reliability;
        }
        else {
            $cemetery->reliability = '0';
        }

        if ( $gallery->images !== [] ) {
            $cemetery->gallery = '{"images": '.json_encode($gallery->images).'}';
        }

        $cemetery->save();
    }

    public function deleteCemetery(Request $request)
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
        
        Cemetery::find($request->id)->delete();
    }
}
