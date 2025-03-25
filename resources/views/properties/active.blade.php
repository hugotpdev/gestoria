<x-app-layout>
    <div class="container mx-auto mt-10">
        <h1 class="text-5xl font-extrabold text-gray-900 mb-8 text-center">Mis Propiedades Activas</h1>

        @if($properties->isEmpty())
            <p class="text-xl text-center text-gray-500">No tienes propiedades activas en este momento.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($properties as $property)
                    <!-- Usamos el componente para cada propiedad -->
                    <x-property-card :property="$property" />
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
