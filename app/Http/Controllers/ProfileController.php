<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Profile',[
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $request->validate([
            'name' => 'required',
            'about' => 'required',
            'contact' => 'required|regex:/(0)[0-9]{9}/',
        ]);

        $user_params = ["name"=>$request->name,"about"=>$request->about,"contact"=>$request->contact];
        $logged_user = Auth::user();

        $user->where('email',$logged_user->email)->update($user_params);

        return redirect()->route('profile')->with(['message' => 'profile info successfully updated']);
    }

    /**
     * Update the password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function passwordUpdate(Request $request,User $user)
    {
        $request->validate([
            'new_password' => ['required', 'confirmed', Password::min(8)->mixedCase()],
            'password' => ['required'],
        ]);

        $logged_user = Auth::user();
        $upwd_params = bcrypt($request->new_password);

        if (Hash::check($request->password, $logged_user->getAuthPassword())) {
            $user->where('email',$logged_user->email)->update(['password'=>$upwd_params]);
        }

        return redirect()->route('profile')->with(['message' => 'pasword successfully updated']);
    }
}
