<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function editPhoto()
    {
        return view('uploadpoto.upload');
    }

    public function index()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'alamat' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5064',
        ]);

        $user = Auth::user();
        $photoName = $user->id . '.' . $request->photo->extension();
        $request->photo->move(public_path('images/'), $photoName);

        $user->path_poto = 'images/' . $photoName;
        $user->save();

        return redirect()->route('profile.photo')->with('success', 'Profile photo updated successfully!');
    }

}
