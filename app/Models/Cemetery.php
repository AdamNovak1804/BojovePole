<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cemetery extends Model
{
    use HasFactory;

    public function family_members()
    {
        return $this->hasMany('App\Models\FamilyMember');
    }
}
