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

        // Ocultar el campo de la contraseña al pasar los datos a la vista
        $user->makeHidden(['password']);

        return view('admin.edit_user', compact('user'));
    }
    // Actualizar los detalles del usuario
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);  // Buscar al usuario por ID

        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:4|confirmed',  // Se puede dejar vacío si no se quiere cambiar
        ]);

        // Actualizar el usuario
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));  // Encriptar la nueva contraseña
        }
        $user->save();  // Guardar cambios

        return redirect()->route('admin.users')->with('success', 'Usuario actualizado correctamente');
    }

    public function showMembersUsers()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
    
        return view('admin.users', compact('users'));
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id); // Encuentra el usuario por su ID
        $user->delete(); // Elimina el usuario

        return redirect()->route('admin.users')->with('success', 'Usuario eliminado con éxito');
    }
}
