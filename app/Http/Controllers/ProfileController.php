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
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'about' => 'required',
            'contact' => ['required', 'min:9', 'max:10'],
        ]);
        $user = Auth::user();
        $result = $user->update([
            'name' => $request->name,
            'about' => $request->about,
            'contact' => $request->contact 
        ]);

        return redirect()->route('profile')->with(['message' => 'successfully updated the profile']);
    }
}
