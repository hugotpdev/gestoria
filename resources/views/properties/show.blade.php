<x-app-layout>
    <div class="container mx-auto mt-10">
        <h1 class="text-5xl font-extrabold text-gray-900 mb-8 text-center">{{ $property->title }}</h1>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Mostrar la imagen usando Storage::url() -->
            <img src="{{ $property->image_url ? Storage::url($property->image_url) : 'https://via.placeholder.com/800x500' }}" alt="Propiedad" class="w-full h-96 object-cover">
            <div class="p-6">
                <p class="text-lg font-semibold text-gray-800">€{{ number_format($property->price, 2) }}</p>
                <p class="text-sm text-gray-600 mt-2">Ubicación: {{ $property->location }}</p>
                <p class="text-sm text-gray-600 mt-2">Tipo: {{ ucfirst($property->type) }}</p>
                <p class="text-sm text-gray-600 mt-2">Estado: {{ ucfirst($property->status) }}</p>
                <p class="text-sm text-gray-600 mt-4">Descripción: {{ $property->description }}</p>

                <div class="mt-4">
                    <p class="text-sm text-gray-600">Habitaciones: {{ $property->bedrooms }}</p>
                    <p class="text-sm text-gray-600">Baños: {{ $property->bathrooms }}</p>
                    <p class="text-sm text-gray-600">Área: {{ number_format($property->area, 2) }} m²</p>
                </div>
                
                <!-- Botones de acción (solo para el propietario o admin) -->
                @if(auth()->user()->isAdmin() || auth()->user()->id === $property->user_id)
                    <div class="mt-6 flex space-x-4">
                        <!-- Botón para editar -->
                        <a href="{{ route('properties.edit', $property->id) }}" 
                           class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                            Editar propiedad
                        </a>

                        <!-- Botón para eliminar -->
                        <form action="{{ route('properties.destroy', $property->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta propiedad?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-200">
                                Eliminar propiedad
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
