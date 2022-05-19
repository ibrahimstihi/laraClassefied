<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {   
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function update(User $user)
    { 
        if($user->phone == request('phone')){
            $this->validate(request(), [
                'name' => 'required|unique:users',
                //'email' => 'required|email|unique:users',
                'phone' => 'required|min:10',
                // 'current-password' => 'required|min:6|new MatchOldPassword'
                ]);
            }elseif($user->name == request('name')){
                $this->validate(request(), [
                    'name' => 'required',
                    //'email' => 'required|email|unique:users',
                    'phone' => 'required|unique:users||min:10',
                    // 'current-password' => 'required|min:6|new MatchOldPassword'
                    ]);
            }
    
        if (!(Hash::check(request('current-password'), $user->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

            $user->name = request('name');
            $user->email = $user->email;
            $user->phone = request('phone');

            $user->photo =  $user->photo ;
            $user->password =$user->password;

            $user->save();
        

        return back();
    }

}
