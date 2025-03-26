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
    // Validación de los datos, incluyendo la imagen
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string|max:255',
        'price' => 'required|numeric',
        'type' => 'required|string|max:255',
        'bedrooms' => 'required|integer',
        'bathrooms' => 'required|integer',
        'area' => 'required|numeric',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación para imagen
    ]);

    // Si se ha subido una imagen, guardarla en el directorio 'public/properties'
    $imagePath = null;
    if ($request->hasFile('image_url')) {
        $imagePath = $request->file('image_url')->store('properties', 'public');
    }

    // Crear la propiedad con el estado predeterminado "disponible"
    $property = Property::create(array_merge($validated, [
        'status' => 'disponible',
        'user_id' => auth()->id(),  // Si necesitas asignar el usuario actual como creador
        'image_url' => $imagePath, // Guardar la ruta de la imagen
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
        'area' => 'required|numeric',
        'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $property = Property::findOrFail($id);

    // Verifica si el usuario es el propietario o un administrador
    if (auth()->user()->id !== $property->user_id && !auth()->user()->isAdmin()) {
        abort(403, 'No tienes permisos para actualizar esta propiedad');
    }
    
    if ($request->hasFile('image_url')) {
        // Subir la nueva imagen
        $imagePath = $request->file('image_url')->store('properties', 'public');
        $validated['image_url'] = $imagePath;
    }
    

    $property->update($validated);

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

    public function buy($id)
    {
        $property = Property::findOrFail($id);
        return redirect()->route('transactions.create', ['property' => $property->id]);
    }
    
}
