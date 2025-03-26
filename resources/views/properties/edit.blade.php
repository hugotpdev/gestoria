<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6 sm:px-10 bg-white shadow rounded-lg">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Editar Propiedad</h1>

        <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            <div class="sm:col-span-2">
                <label for="title" class="block text-sm font-semibold text-gray-700">Título</label>
                <input type="text" id="title" name="title" value="{{ old('title', $property->title) }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="description" class="block text-sm font-semibold text-gray-700">Descripción</label>
                <textarea id="description" name="description" required rows="4" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $property->description) }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700">Ubicación</label>
                <input type="text" id="location" name="location" value="{{ old('location', $property->location) }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-semibold text-gray-700">Precio</label>
                <input type="number" id="price" name="price" value="{{ old('price', $property->price) }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="type" class="block text-sm font-semibold text-gray-700">Tipo</label>
                <input type="text" id="type" name="type" value="{{ old('type', $property->type) }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="bedrooms" class="block text-sm font-semibold text-gray-700">Habitaciones</label>
                <input type="number" id="bedrooms" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('bedrooms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="bathrooms" class="block text-sm font-semibold text-gray-700">Baños</label>
                <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('bathrooms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="area" class="block text-sm font-semibold text-gray-700">Área (m²)</label>
                <input type="number" id="area" name="area" value="{{ old('area', $property->area) }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('area') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="image" class="block text-sm font-semibold text-gray-700">Subir Nueva Imagen</label>
                <input type="file" id="image_url" name="image_url" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="sm:col-span-2 flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                    Actualizar Propiedad
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
