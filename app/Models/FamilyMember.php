<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'family_members_users', 'family_member_id', 'user_id');
    }

    public function cemetery()
    {
        return $this->belongsTo('App\Models\Cemetery');
    }
}
