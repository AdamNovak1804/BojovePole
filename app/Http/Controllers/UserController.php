<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(Auth::user(), 200);
        }
        throw ValidationException::withMessages([
            'email' => ['Prihlasovacie údaje sú nesprávne']
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'confirmed']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => Hash::make($request->password)
        ]);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function getMessages()
    {
        $id = Auth::id();

        return Message::with('sender', 'receiver')->where('user_id_to', $id)->get()->toJson();
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'recipient' => ['required', 'exists:users,email', 'email'],
            'subject' => ['max:45'],
            'text' => ['max:65535']
        ],
        [
            'recipient.required' => 'Nebola zadaná emailová adresa príjemcu!',
            'recipient.exists' => 'Zadaný používateľ neexistuje!',
            'recipient.email' => 'Emailová adresa má zlý formát!',
            'subject.max' => 'Presiahnutý limit znakov v predmete správy!',
            'text.max' => 'Presiahnutý limit znakov v tele správy!'
        ]);

        $email = $request->recipient;
        $recipient = User::where('email', '=', $email)->first();

        $sender_id = Auth::id();
        $recipient_id = $recipient->id;

        Message::create([
            'user_id_from' => $sender_id,
            'user_id_to' => $recipient_id,
            'text' => $request->input('text'),
            'subject' => $request->input('subject')
        ]);
    }
}
