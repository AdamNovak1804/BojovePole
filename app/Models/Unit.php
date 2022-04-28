<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'visible',
        'reliability',
        'type',
        'country',
        'location',
        'description',
        'longtitude',
        'latitude',
        'gallery'
    ];

    public function battles()
    {
        return $this->belongsToMany('App\Models\Battle', 'units_battles', 'unit_id', 'battle_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country', 'id');
    }
}
