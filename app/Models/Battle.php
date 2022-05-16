<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'visible',
        'reliability',
        'start',
        'end',
        'side1',
        'side2',
        'outcome',
        'description',
        'longtitude',
        'latitude',
        'gallery'
    ];

    public function side1()
    {
        return $this->belongsTo('App\Models\Country', 'side1', 'id');
    }

    public function side2()
    {
        return $this->belongsTo('App\Models\Country', 'side2', 'id');
    }
}
