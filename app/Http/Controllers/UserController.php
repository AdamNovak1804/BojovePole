<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use App\Models\Message;
use App\Models\FamilyMember;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ],
        [
            'email.required' => 'Email nebol zadaný!',
            'email.email' => 'Email musí mať správny formát!',
            'password.required' => 'Heslo nebolo zadané!'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(Auth::user(), 200);
        }
        throw ValidationException::withMessages([
            'email' => 'Prihlasovacie údaje sú nesprávne!',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:45'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'confirmed']
        ],
        [
            'name.required' => 'Nebolo zadané používateľské meno!',
            'name.max' => 'Používateľské meno musí mať menej ako 46 znakov!',
            'email.required' => 'Nebola zadaná emailová adresa používateľa!',
            'email.unique' => 'Používateľ s daným emailom už existuje!',
            'email.email' => 'Email musí mať správny formát!',
            'password.required' => 'Nebolo zadané používateľské heslo!',
            'password.confirmed' => 'Heslo nebolo potvrdené!'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'image' => 'generic-profile.png'
        ]);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function getReceivedMessages()
    {
        $id = Auth::id();

        return Message::with('sender', 'receiver')->where('user_id_to', $id)->get()->toJson();
    }

    public function getContacts()
    {
        $user = Auth::user();

        if ( !strcmp($user->role, "user") )
        {
            return User::where('role', '=', 'historian')->orWhere('role', '=', 'admin')->orderBy('role', 'desc')->get()->toJson();
        }
        else
        {
            return User::all()->except(Auth::id());
        }
    }

    public function getSentMessages()
    {
        $id = Auth::id();

        return Message::with('sender', 'receiver')->where('user_id_from', $id)->orderBy('created_at')->get()->toJson();
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

    public function getFamily()
    {
        $user = Auth::user()->family_members()->with('cemetery', 'unit')->get();

        return $user;
    }

    public function postMember(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'max:45'],
            'lastname' => ['required', 'max:45'],
            'date_of_birth' => ['nullable', 'after_or_equal:"1840-01-01"', 'before_or_equal:"1901-01-01"'],
            'date_of_death' => ['nullable', 'after_or_equal:"1914-07-28"', 'before_or_equal:"2010-01-01"'],
            'biography' => ['max:65535']
        ],
        [
            'firstname.required' => 'Nebolo zadané krstné meno rodinného príslušníka!',
            'firstname.max' => 'Krstné meno nemôže mať viac ako 45 znakov!',
            'lastname.required' => 'Nebolo zadané priezvisko rodinného príslušníka!',
            'lastname.max' => 'Priezvisko nemôže mať viac ako 45 znakov!',
            'date_of_birth.after_or_equal' => 'Dátum narodenia nemôže byť starší ako 1. január 1840!',
            'date_of_birth.before_or_equal' => 'Dátum narodenia nemôže byť mladší ako 1. január 1901!',
            'date_of_death.after_or_equal' => 'Dátum úmrtia nemôže byť starší ako 7. júl 1914!',
            'date_of_death.before_or_equal' => 'Dátum úmrtia nemôže byť mladší ako 1. január 2010!',
            'biography.max' => 'Presiahnutý limit znakov v tele biografie!'
        ]);

        $gallery = [];
        $gallery_json = null;

        /* Add new images */
        if ( !empty($request->gallery) )
        {
            $iter = 0;
            foreach ( $request->gallery as $image )
            {
                $name = time().'_'.$iter.'.'.$image->getClientOriginalExtension();
                $file = json_encode(array("path" => $name));
                $image->move(public_path('/images/userContent/'), $name);
                array_push($gallery, json_decode($file));
                $iter++;
            }
            $gallery_json = '{"images": '.json_encode($gallery).'}';
        }

        $member = FamilyMember::create([
            'name' => $request->firstname.' '.$request->lastname,
            'visible' => '0',
            'reliability' => '0',
            'date_of_birth' => $request->date_of_birth,
            'date_of_death' => $request->date_of_death,
            'biography' => $request->biography,
            'cemetery' => $request->cemetery,
            'unit' => $request->unit,
            'gallery' => $gallery_json
        ]);

        User::find(Auth::id())->family_members()->attach($member);
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:45'],
            'password' => ['nullable', 'confirmed'],
            'about' => ['max:65535'],
            'image' => ['nullable', 'mimes:jpg,png', 'max:20971520'],
            'about' => ['max:65535']
        ],
        [
            'name.required' => 'Meno používateľa je povinné!',
            'name.max' => 'Meno používateľa nesmie mať viac ako 45 znakov!',
            'password.confirmed' => 'Heslo nebolo potvrdené!',
            'about.max' => 'Sekcia o mne nemôže mať viac ako 65535 znakov!',
            'image.max' => 'Obrázok nemôže mať veľkosť viac ako 20 MB!',
            'about.max' => 'Sekcia "o mne" nemôže mať viac ako 65535 znakov!'
        ]);

        $user = Auth::user();

        if ( !empty($request->image) )
        {
            $file = $request->file('image');
            $name = $user->id.'.'.$file->getClientOriginalExtension();

            $old = public_path().'/images/'.$user->image;

            if ( File::exists($old) && !!strcmp($user->image, 'generic-profile.png') )
            {
                File::Delete($old);
            }

            $request->image->move(public_path('/images'), $name);
            $user->image = $name;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ( $request->password != '' )
        {
            $user->password = Hash::make($request->password);
        }
        $user->about = $request->about;

        $user->save();

        return $user;
    }

    public function getImage($image)
    {
        $path = public_path().'/images/'.$image;

        if ( file_exists($path) )
        {
            readfile($path);
            die();
        }
        else {
            die("Error: File not found.");
        }
    }

    public function updateUserRole(Request $request)
    {
        $user = User::find($request->id);

        $user->role = $request->role;
        $user->save();

        return $user;
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);

        $image = public_path().'/images/'.$user->image;
        if ( File::exists($image) && !!strcmp($user->image, 'generic-profile.png') )
        {
            File::delete($image);
        }

        $user->family_members()->delete();
        $user->delete();

        return $user;
    }

    public function deleteMembers(Request $request)
    {
        $members = FamilyMember::findMany($request->all());
        $count = $members->count();

        $members->each->delete();

        return $count;
    }
}
