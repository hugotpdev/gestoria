<x-app-layout>
    <div class="space-y-6">
        <h1 class="text-3xl font-bold text-gray-800">Alquileres y compras</h1>
        <p class="text-lg text-gray-600">Historial de transacciones, solicitudes pendientes y contratos activos.</p>

        @if($transactions->isEmpty())
            <p class="text-gray-500 mt-4">No tienes transacciones registradas.</p>
        @else
            <div class="mt-6 space-y-4">
                @foreach($transactions as $transaction)
                    <div class="p-6 bg-white rounded-lg shadow-lg border border-gray-200">
                        <p class="text-sm text-gray-600">Precio: <span class="font-semibold text-green-600">${{ number_format($transaction->price, 2) }}</span></p>
                        <p class="text-sm text-gray-600">Estado: <span class="font-semibold text-blue-600">{{ ucfirst($transaction->status) }}</span></p>
                        <p class="text-sm text-gray-600">Tipo: <span class="font-semibold text-yellow-600">{{ ucfirst($transaction->type) }}</span></p>

                        <!-- Botón para ver propiedad -->
                        <a href="{{ route('properties.show', $transaction->property->id) }}" 
                           class="inline-block mt-4 px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-md transition duration-200">
                            Ver propiedad
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
