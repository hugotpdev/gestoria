<x-app-layout>
    <div class="container mx-auto mt-10 px-6">
        <h1 class="text-5xl font-extrabold text-gray-900 mb-8 text-center">Propiedades Disponibles</h1>

        @if($properties->isEmpty())
            <p class="text-xl text-center text-gray-500">No hay propiedades disponibles en este momento.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($properties as $property)
                    <x-property-card :property="$property" />
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
