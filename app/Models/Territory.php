<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'start_date',
        'end_date',
        'visible',
        'reliability',
        'country',
        'color',
        'map'
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country', 'id');
    }
}
