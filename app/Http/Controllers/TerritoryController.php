<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Territory;

class TerritoryController extends Controller
{
    public function getTerritories()
    {
        return Territory::with('country')->where('visible', '=', 1)->orderBy('start_date')->get()->toJson();
    }

    public function getTerritoryRequests()
    {
        return Territory::with('country')->where('visible', '=', 0)->get()->toJson();
    }

    public function postTerritory(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:"1914-07-28"', 'before_or_equal:"1918-11-11"'],
            'end_date' => ['required', 'date', 'after_or_equal:start', 'before_or_equal:"1918-11-11"'],
            'country' => ['required'],
            'map' => ['required', 'array', 'min:3']
        ],
        [
            'start_date.required' => 'Nebol zadaný dátum začatia situácie!',
            'start_date.date' => 'Zadaný dátum je v zlom formáte!',
            'start_date.after_or_equal' => 'Dátum začatia situácie musí byť aspoň 28. júl 1914!',
            'start_date.before_or_equal' => 'Dátum začatia situácie nesmie byť neskôr ako 11. November 1918!',
            'end_date.required' => 'Nebol zadaný dátum ukončenia situácie!',
            'end_date.date' => 'Zadaný dátum je v zlom formáte!',
            'end_date.after_or_equal' => 'Koncový dátum nemôže byť pred začiatkom!',
            'end_date.before_or_equal' => 'Dátum ukončenia situácie nesmie byť neskôr ako 11. November 1918!',
            'country.required' => 'Nebola zadaná krajina!',
            'map.required' => 'Chýba údaj o území!',
            'map.array' => 'Neplatný dátový typ územia!',
            'map.min' => 'Územie musí mať aspoň 3 body!'
        ]);

        $list = '{"vertices": [';

        foreach ( $request->map as $vertex )
        {
            $list = $list.'['.$vertex.'], ';
        }

        $list[-2] = ']';
        $list[-1] = '}';

        Territory::create([
            'visible' => '0',
            'reliability' => '0',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'country' => $request->country,
            'color' => $request->color,
            'map' => $list
        ]);
    }

    public function updateTerritory(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:"1914-07-28"', 'before_or_equal:"1918-11-11"'],
            'end_date' => ['required', 'date', 'after_or_equal:start', 'before_or_equal:"1918-11-11"'],
            'country' => ['required'],
            'map' => ['required', 'array', 'min:3']
        ],
        [
            'start_date.required' => 'Nebol zadaný dátum začatia situácie!',
            'start_date.date' => 'Zadaný dátum je v zlom formáte!',
            'start_date.after_or_equal' => 'Dátum začatia situácie musí byť aspoň 28. júl 1914!',
            'start_date.before_or_equal' => 'Dátum začatia situácie nesmie byť neskôr ako 11. November 1918!',
            'end_date.required' => 'Nebol zadaný dátum ukončenia situácie!',
            'end_date.date' => 'Zadaný dátum je v zlom formáte!',
            'end_date.after_or_equal' => 'Koncový dátum nemôže byť pred začiatkom!',
            'end_date.before_or_equal' => 'Dátum ukončenia situácie nesmie byť neskôr ako 11. November 1918!',
            'country.required' => 'Nebola zadaná krajina!',
            'map.required' => 'Chýba údaj o území!',
            'map.array' => 'Neplatný dátový typ územia!',
            'map.min' => 'Územie musí mať aspoň 3 body!'
        ]);

        $territory = Territory::find($request->id);

        $list = '{"vertices": [';

        foreach ( $request->map as $vertex )
        {
            $list = $list.'['.$vertex.'], ';
        }

        $list[-2] = ']';
        $list[-1] = '}';

        $territory->start_date = $request->start_date;
        $territory->end_date = $request->end_date;
        $territory->country = $request->country;
        $territory->map = $list;

        if ( !empty($request->reliability) ) {
            $territory->reliability = $request->reliability;
        }
        else {
            $territory->reliability = '0';
        }

        $territory->save();
    }

    public function deleteTerritory(Request $request)
    {
        Territory::find($request->id)->delete();
    }
}
