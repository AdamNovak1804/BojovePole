<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;
    protected $table = 'family_members';

    public function roles()
    {
        return $this->belongsToMany('App\Models\Users', 'users_family_members', 'user_id', 'family_member_id');
    }

    public static function index()
    {
        return FamilyMember::all()->toJson();
    }

}
