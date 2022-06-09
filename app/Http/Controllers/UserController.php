<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function edit(User $user)
    // {   
    //     $user = Auth::user();
    //     return view('users.profile', compact('user'));
    // }

    public function dashboard(){
        return view('profile.dashboard');
    }

    public function edit_profile(){
        return view('profile.edit_profile');
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
            return back()
            ->with('message_type', 'danger')
            ->with('message', 'Your current password does not matches with the password.');;
        }

            $user->name     = request('name');
            $user->email    = $user->email;
            $user->phone    = request('phone');

            $user->photo    =  $user->photo;
            $user->password =  $user->password;

            $user->save();   
        return back()
        ->with('message_type', 'success')
        ->with('message', 'You have successfully update your profile');
    }

    public function change_password(){ 
        return view('profile.change_password');
    }

    public function update_password(User $user)
    {
        $this->validate(request(), [
            'new_password' => 'required|string|min:8',
            'password_confirmation' =>'same:new_password']);
        // 'password' => ['required', 'string', 'min:8', 'confirmed']
        if (!(Hash::check(request('current-password'), $user->password))) {
            // The passwords matches
            return redirect()->back()
            ->with('message_type', 'danger')
            ->with('message', 'Your current password does not matches with the password.');
        }

            $user->name     = $user->name;
            $user->email    = $user->email;
            $user->phone    = $user->phone;
            $user->photo    =  $user->photo;
            $user->password =  Hash::make(request('new_password'));

            $user->save();   
        return back()
        ->with('message_type', 'success')
        ->with('message', 'You have successfully update the password');
    }
}