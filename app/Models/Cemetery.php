<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cemetery extends Model
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
        'description',
        'longtitude',
        'latitude',
        'gallery'
    ];

    public function family_members()
    {
        return $this->hasMany('App\Models\FamilyMember');
    }
}
