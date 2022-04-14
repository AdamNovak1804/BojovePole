<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    use HasFactory;

    public function side1()
    {
        return $this->belongsTo('App\Models\Country', 'side1', 'id');
    }

    public function side2()
    {
        return $this->belongsTo('App\Models\Country', 'side2', 'id');
    }

    public function units()
    {
        return $this->belongsToMany('App\Models\Unit', 'units_battles', 'unit_id', 'battle_id');
    }
}
