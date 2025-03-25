<div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
    <img src="{{ $property->image_url ?? 'https://via.placeholder.com/400x250' }}" alt="Propiedad" class="w-full h-56 object-cover rounded-t-lg">
    <div class="p-6 space-y-4">
        <h2 class="text-2xl font-semibold text-gray-800">{{ $property->title }}</h2>
        <p class="text-lg font-semibold text-gray-800">€{{ number_format($property->price, 2) }}</p>
        <p class="text-sm text-gray-600">Ubicación: {{ $property->location }}</p>
        <span class="inline-block bg-blue-500 text-white text-xs px-2 py-1 rounded-full">{{ ucfirst($property->status) }}</span>

        <div class="space-x-3">
            <a href="{{ route('properties.show', $property->id) }}" class="inline-block bg-indigo-600 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                Ver Detalles
            </a>
        </div>
    </div>
</div>