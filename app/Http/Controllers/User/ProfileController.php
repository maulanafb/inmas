<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Laravolt\Indonesia\Models\City;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function edit()
    {
        $user = Auth::user();
        $cities = City::all();
        return view('pages.user.edit-profile.index', compact('user', 'cities'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone_number' => 'required|string|max:15',
            'city_id' => 'nullable|exists:indonesia_cities,id',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'password' => 'nullable|string|min:8|confirmed', // Added password validation
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->city_id = $request->city_id;

        if ($request->hasFile('profile_photo')) {
            $imageName = time() . '.' . $request->profile_photo->extension();
            $request->profile_photo->move(public_path('images'), $imageName);
            $user->profile_photo = $imageName;
        }

        // Update password if it's not empty
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }


        $user->save();

        return redirect()->route('user.profile.edit')->with('success', 'Berhasil memperbarui profil.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
