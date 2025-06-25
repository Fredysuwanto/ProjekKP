<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
    if ($request->filled('password')) {
        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password baru tidak boleh sama dengan password lama.'])->withInput();
        }

        $user->password = bcrypt($request->password);
    }
    
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // if ($validated['password']) {
        //     $user->password = Hash::make($validated['password']);
        // }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Data berhasil diperbarui');
    }
}
