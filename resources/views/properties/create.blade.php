<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6 sm:px-10 bg-white shadow rounded-lg">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Crear Nueva Propiedad</h1>

        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @csrf

            <!-- Título -->
            <div class="sm:col-span-2">
                <label for="title" class="block text-sm font-semibold text-gray-700">Título</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Descripción -->
            <div class="sm:col-span-2">
                <label for="description" class="block text-sm font-semibold text-gray-700">Descripción</label>
                <textarea id="description" name="description" required rows="4" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Ubicación -->
            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700">Ubicación</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Precio -->
            <div>
                <label for="price" class="block text-sm font-semibold text-gray-700">Precio</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Tipo -->
            <div>
                <label for="type" class="block text-sm font-semibold text-gray-700">Tipo</label>
                <select id="type" name="type" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="venta" {{ old('type') == 'venta' ? 'selected' : '' }}>Venta</option>
                    <option value="alquiler" {{ old('type') == 'alquiler' ? 'selected' : '' }}>Alquiler</option>
                </select>
                @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- El campo status no será mostrado ni editable -->

            <!-- Habitaciones -->
            <div>
                <label for="bedrooms" class="block text-sm font-semibold text-gray-700">Habitaciones</label>
                <input type="number" id="bedrooms" name="bedrooms" value="{{ old('bedrooms') }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('bedrooms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Baños -->
            <div>
                <label for="bathrooms" class="block text-sm font-semibold text-gray-700">Baños</label>
                <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('bathrooms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Área -->
            <div class="sm:col-span-2">
                <label for="area" class="block text-sm font-semibold text-gray-700">Área (m²)</label>
                <input type="number" id="area" name="area" value="{{ old('area') }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('area') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="sm:col-span-2">
                <label for="image_url" class="block text-sm font-semibold text-gray-700">Imagen de la propiedad</label>
                <input type="file" id="image_url" name="image_url" accept="image/*" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('image_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Botón de Enviar -->
            <div class="sm:col-span-2 flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                    Crear Propiedad
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
