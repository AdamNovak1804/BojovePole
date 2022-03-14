<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    public function sender()
    {
        return $this->hasOne('App\Models\User');
    }

    public function receiver()
    {
        return $this->hasOne('App\Models\User');
    }

    public static function index()
    {
        return Request::all()->toJson();
    }
}
