<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    public function battles()
    {
        return $this->belongsToMany('App\Models\Battle', 'units_battles', 'unit_id', 'battle_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
}
