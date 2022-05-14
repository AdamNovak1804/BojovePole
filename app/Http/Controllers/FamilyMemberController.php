<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\FamilyMember;

class FamilyMemberController extends Controller
{
    public function getFamilyMemberRequests()
    {
        return FamilyMember::with('unit', 'cemetery')->where('visible', '=', 0)->get()->toJson();
    }

    public function updateFamilyMember(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:45'],
            'date_of_birth' => ['nullable', 'after_or_equal:"1840-01-01"', 'before_or_equal:"1901-01-01"'],
            'date_of_death' => ['nullable', 'after_or_equal:"1914-07-28"', 'before_or_equal:"2010-01-01"'],
            'biography' => ['max:65535']
        ],
        [
            'name.required' => 'Nebolo zadané meno a priezvisko rodinného príslušníka!',
            'name.max' => 'Meno a priezvisko nemôže mať viac ako 45 znakov!',
            'date_of_birth.after_or_equal' => 'Dátum narodenia nemôže byť starší ako 1. január 1840!',
            'date_of_birth.before_or_equal' => 'Dátum narodenia nemôže byť mladší ako 1. január 1901!',
            'date_of_death.after_or_equal' => 'Dátum úmrtia nemôže byť starší ako 7. júl 1914!',
            'date_of_death.before_or_equal' => 'Dátum úmrtia nemôže byť mladší ako 1. január 2010!',
            'biography.max' => 'Presiahnutý limit znakov v tele biografie!'
        ]);

        $family_member = FamilyMember::find($request->id);

        $gallery = json_decode($family_member->gallery);
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
        $family_member->visible = (int) $request->visible;
        $family_member->name = $request->name;
        $family_member->date_of_birth = $request->date_of_birth;
        $family_member->date_of_death = $request->date_of_death;
        if ( !empty($request->cemetery) )
        {
            $family_member->cemetery = (int) $request->cemetery;
        }
        else
        {
            $family_member->cemetery = null;
        }
        
        if ( !empty($request->unit) )
        {
            $family_member->unit = (int) $request->unit;
        }
        else
        {
            $family_member->unit = null;
        }
        $family_member->biography = $request->biography;

        if ( !empty($request->reliability) ) {
            $family_member->reliability = $request->reliability;
        }
        else {
            $family_member->reliability = '0';
        }

        if ( $gallery->images !== [] ) {
            $family_member->gallery = '{"images": '.json_encode($gallery->images).'}';
        }

        $family_member->save();
    }

    public function deleteFamilyMember(Request $request)
    {
        FamilyMember::find($request->id)->delete();
    }
}
