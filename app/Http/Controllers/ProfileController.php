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
        $user =  Auth::user();
        $user['profileUrl'] = route("show.restaurant",['id' => $user->id]);
        return Inertia::render('Profile',[
            'user' => $user
        ]);
    }

    /**
     * Update the profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'about' => 'required',
            'contact' => ['required', 'min:9', 'max:9'],
        ]);
        $user = Auth::user();
        $result = $user->update([
            'name' => $request->name,
            'about' => $request->about,
            'contact' => $request->contact 
        ]);

        return redirect()->route('profile')->with(['message' => 'successfully updated the profile']);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required'],
            'email' => ['required'],
        ]);

        $user = Auth::user();
        //validate password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('profile')->withErrors(["password"=>"Current password is invalid"]);
        }
        //validate email address
        if ($request->email != $user->email) {
            return redirect()->route('profile')->withErrors(["email"=>"Current email is invalid"]);
        }
        //remove the user account
        $user->delete();

        return redirect()->route('dashboard');
    }
}
