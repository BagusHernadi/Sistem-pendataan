<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('profile.edit')
                        ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/[0-9]/', 'regex:/[a-zA-Z]/'],
        ], [
            'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf dan satu angka.',
            'current_password.current_password' => 'Kata sandi saat ini tidak valid.'
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Kata sandi berhasil diubah!');
    }

    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile-photos', 'public');
            
            $user = Auth::user();
            $user->profile_photo_path = $path;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Foto profil berhasil diunggah.',
                'photo_url' => asset('storage/' . $path)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengunggah foto profil.'
        ], 400);
    }
}
