<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PropertyController extends Controller {
    public function index() {
        $properties = Property::where('status', 'disponible')->get();

        return view('properties.index', compact('properties'));
    }

    public function show(Property $property) {
        return view('properties.show', compact('property'));
    }


    public function create()
    {
        return view('properties.create');
    }


    public function store(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type' => 'required|string|max:255',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'area' => 'required|integer',
            'image_url' => 'nullable|url',
        ]);

        // Crear la propiedad con el estado predeterminado "disponible"
        $property = Property::create(array_merge($validated, [
            'status' => 'disponible',
            'user_id' => auth()->id(),  // Si necesitas asignar el usuario actual como creador
        ]));

        // Redirigir con un mensaje de éxito
        return redirect()->route('properties.show', $property->id)
                        ->with('success', 'Propiedad creada correctamente.');
    }


     // Función para mostrar el formulario de edición
     public function edit($id)
     {
        $property = Property::findOrFail($id);  // Obtiene la propiedad por su ID

        // Verifica si el usuario es el propietario o un administrador
        if (auth()->user()->id !== $property->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'No tienes permisos para editar esta propiedad');
        }
    
        return view('properties.edit', compact('property'));  // Pasa la propiedad a la vista
     }
 
     // Función para actualizar los datos de la propiedad
     public function update(Request $request, $id)
     {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'type' => 'required|string|max:255',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|integer',
            'area' => 'required|integer',
            'image_url' => 'nullable|url',
        ]);
    
        $property = Property::findOrFail($id);  // Encuentra la propiedad por su ID
    
        // Verifica si el usuario es el propietario o un administrador
        if (auth()->user()->id !== $property->user_id && !auth()->user()->is_admin) {
            abort(403, 'No tienes permisos para actualizar esta propiedad');
        }
    
        $property->update($request->all());  // Actualiza la propiedad con los datos del formulario
    
        return redirect()->route('properties.index')->with('success', 'Propiedad actualizada con éxito');
     }

     public function destroy($id)
    {
        $property = Property::findOrFail($id);

        // Verificar si el usuario es el propietario de la propiedad o un administrador
        if (auth()->user()->isAdmin() || auth()->user()->id === $property->user_id) {
            // Eliminar la propiedad
            $property->delete();
    
            return redirect()->route('properties.index')->with('success', 'Propiedad eliminada con éxito.');
        }
    
        // Si no tiene permisos, redirigir con un mensaje de error
        return redirect()->route('properties.index')->with('error', 'No tienes permiso para eliminar esta propiedad.');
    }

    public function showActiveProperties()
    {
        $properties = Property::where('user_id', auth()->id())
                            ->where('status', 'disponible')
                            ->get();
        
        return view('properties.active', compact('properties'));
    }

    public function showTransactions()
    {
        $user = Auth::user();

        $transactions = $user->buyerTransactions->merge($user->sellerTransactions);

        return view('properties.transactions', compact('user', 'transactions'));
    }
    
}
