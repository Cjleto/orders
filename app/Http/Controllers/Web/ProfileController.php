<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        if ($request->password) {
            Auth::user()->update(['password' => Hash::make($request->password)]);
        }

        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
