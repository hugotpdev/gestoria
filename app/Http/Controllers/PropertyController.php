<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PropertyController extends Controller {

    // Muestra la lista de propiedades disponibles
    public function index() {
        $properties = Property::where('status', 'disponible')->get();
        return view('properties.index', compact('properties'));
    }

    // Muestra los detalles de una propiedad
    public function show(Property $property) {
        return view('properties.show', compact('property'));
    }

    // Muestra el formulario para crear una propiedad
    public function create() {
        return view('properties.create');
    }

    // Guarda una nueva propiedad
    public function store(Request $request)
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

        $imagePath = null;
        if ($request->hasFile('image_url')) {
            $imageName = $request->file('image_url')->getClientOriginalName();
            $imagePath = 'properties/' . $imageName;

            // Verificar si la imagen ya existe en el directorio
            if (!file_exists(storage_path('app/public/' . $imagePath))) {
                $request->file('image_url')->storeAs('properties', $imageName, 'public');
            }
        }

        $property = Property::create(array_merge($validated, [
            'status' => 'disponible',
            'user_id' => auth()->id(), 
            'image_url' => $imagePath, 
        ]));

        return redirect()->route('properties.show', $property->id)
                        ->with('success', 'Propiedad creada correctamente.');
    }


    // Muestra el formulario de edición de la propiedad
    public function edit($id)
    {
        $property = Property::findOrFail($id);

        if (auth()->user()->id !== $property->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'No tienes permisos para editar esta propiedad');
        }

        if ($property->status !== 'disponible') {
            return redirect()->route('properties.index')->with('error', 'Solo se pueden actualizar propiedades con estado disponible');
        }

        return view('properties.edit', compact('property'));
    }

    // Actualiza los datos de una propiedad
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
    
        if ($property->status !== 'disponible') {
            return redirect()->route('properties.index')->with('error', 'Solo se pueden actualizar propiedades con estado disponible');
        }
    
        if (auth()->user()->id !== $property->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'No tienes permisos para actualizar esta propiedad');
        }
    
        if ($request->hasFile('image_url')) {
            $imageName = $request->file('image_url')->getClientOriginalName();
            $imagePath = 'properties/' . $imageName;
    
            // Verificar si la imagen ya existe en el directorio
            if (!file_exists(storage_path('app/public/' . $imagePath))) {
                $request->file('image_url')->storeAs('properties', $imageName, 'public');
            }
            $validated['image_url'] = $imagePath;
        }
    
        $property->update($validated);
    
        return redirect()->route('properties.index')->with('success', 'Propiedad actualizada con éxito');
    }
    

    // Elimina una propiedad
    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        if ($property->status !== 'disponible') {
            return redirect()->route('properties.index')->with('error', 'Solo se pueden eliminar propiedades con estado disponible');
        }

        if (auth()->user()->isAdmin() || auth()->user()->id === $property->user_id) {
            $property->delete();
            return redirect()->route('properties.index')->with('success', 'Propiedad eliminada con éxito.');
        }

        return redirect()->route('properties.index')->with('error', 'No tienes permiso para eliminar esta propiedad.');
    }

    // Muestra las propiedades activas del usuario
    public function showActiveProperties()
    {
        $properties = Property::where('user_id', auth()->id())
                              ->where('status', 'disponible')
                              ->get();
        
        return view('properties.active', compact('properties'));
    }

    // Muestra las transacciones del usuario
    public function showTransactions()
    {
        $user = Auth::user();
        $transactions = $user->buyerTransactions->merge($user->sellerTransactions);

        return view('properties.transactions', compact('user', 'transactions'));
    }

    // Redirige a la creación de transacción para comprar una propiedad
    public function buy($id)
    {
        $property = Property::findOrFail($id);
        return redirect()->route('transactions.create', ['property' => $property->id]);
    }
}