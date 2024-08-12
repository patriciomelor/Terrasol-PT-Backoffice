<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role; // Importa el modelo Role

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $roles = Role::all();  // Obtén todos los roles disponibles

        return view('profile.edit', compact('user', 'roles'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|exists:roles,id'  // Validar que el rol existe
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $avatarName = $user->id . '_avatar.' . $request->avatar->extension();
            $request->avatar->storeAs('avatars', $avatarName, 'public');
            $user->profile_photo_path = 'avatars/' . $avatarName;
        }

        $user->name = $request->name;
        $user->email = $request->email;

        // Asigna el rol al usuario
        $user->roles()->sync([$request->role]);

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    }
}