<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function territories()
    {
        return $this->hasMany('App\Models\Territory');
    }

    public function units()
    {
        return $this->hasMany('App\Models\Unit');
    }
}
