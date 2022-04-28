<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id_from',
        'user_id_to',
        'text',
        'subject'
    ];

    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'user_id_from', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'user_id_to', 'id');
    }

    public static function index()
    {
        return Message::with('sender', 'receiver')->get()->toJson();
    }
}
