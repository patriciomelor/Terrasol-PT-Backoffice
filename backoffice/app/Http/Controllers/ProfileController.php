<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'updatedBy'])->where('id', '!=', 3)->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_login' => 'required|string|max:255|unique:users',
            'role' => 'required|exists:roles,id',
            // Añadir otras validaciones aquí si es necesario
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_login' => $request->user_login,
                'is_active' => $request->has('is_active'),
                'role_id' => $request->role,
            ]);

            return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('users.create')->with('error', 'Error al crear el usuario: ' . $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
            'user_login' => 'required|string|max:255|unique:users,user_login,' . $user->id,
        ]);
    
        try {
            $user->name = $request->name;
            $user->email = $request->email;
    
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
    
            if ($request->hasFile('avatar')) {
                $path = $request->file('avatar')->store('avatars', 'public');
                $user->profile_photo_path = $path;
            }
    
            $user->role_id = $request->role;
            $user->is_active = $request->has('is_active');
            $user->user_login = $request->user_login;
            $user->updated_by = auth()->id(); // Aquí se guarda el ID del usuario que realiza la modificación
            $user->save();
    
            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('users.edit', $user->id)->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }
    
    

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    public function toggleActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
        return redirect()->route('users.index')->with('success', 'Estado del usuario actualizado correctamente.');
    }
    public function generateToken()
{
    $user = User::find(1); // Obtén el usuario por ID u otro criterio
    $token = $user->createToken('TOKENPERMANT')->plainTextToken;

    return response()->json(['token' => $token]);
}

}
