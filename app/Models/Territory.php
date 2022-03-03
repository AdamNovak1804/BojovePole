<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
    use HasFactory;
    protected $table = 'Territory';

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'Country', 'idCountries');
    }
}
