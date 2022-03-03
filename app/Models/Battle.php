<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    use HasFactory;
    protected $table = 'Battles';

    public function side1()
    {
        return $this->belongsTo('App\Models\Country', 'Side1', 'idCountries');
    }

    public function side2()
    {
        return $this->belongsTo('App\Models\Country', 'Side2', 'idCountries');
    }

    public static function index()
    {
        return Battle::with('side1', 'side2')->get()->toJson();
    }
}
