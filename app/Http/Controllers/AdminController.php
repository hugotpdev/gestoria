<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{

    // Mostrar la vista de edición de un usuario
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $user->makeHidden(['password']);

        return view('admin.edit_user', compact('user'));
    }

    // Actualizar los detalles del usuario
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);  

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:4|confirmed',  
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));  
        }
        $user->save();  

        return redirect()->route('admin.users')->with('success', 'Usuario actualizado correctamente');
    }

    // Muestra todos los usuarios que no son administradores
    public function showMembersUsers()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
    
        return view('admin.users', compact('users'));
    }

    // Elimina un usuario por su ID
    public function destroyUser($id)
    {
        $user = User::findOrFail($id); 
        $user->delete(); 

        return redirect()->route('admin.users')->with('success', 'Usuario eliminado con éxito');
    }
}
