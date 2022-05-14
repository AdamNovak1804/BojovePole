<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class DataController extends Controller
{
    public function getUsersAndRoles()
    {
        $user = Auth::user();

        if ($user->role == 'admin')
        {
            return User::where('id', '!=', $user->id)->get()->toJSon();
        }
        else
        {
            return null;
        }
    }

    public function getUserContentImage($image)
    {
        $path = public_path().'/images/userContent/'.$image;

        $headers = array(
            'Content-Type' => 'image/png'
        );

        return response()->file($path, $headers);
    }
}
