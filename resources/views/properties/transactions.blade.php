<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6 text-center">
        <h1 class="text-3xl font-bold text-gray-800">Historial de {{ $user->name }}</h1>
        <p class="text-lg text-gray-600">Resumen de tus compras y alquileres.</p>

        @if($transactions->isEmpty())
            <p class="text-gray-500 mt-4">No tienes transacciones registradas.</p>
        @else
            @foreach (['venta' => '🏡 Ventas', 'alquiler' => '🏢 Alquileres'] as $tipo => $titulo)
                @php $groupedTransactions = $transactions->where('type', $tipo); @endphp
                
                @if($groupedTransactions->isNotEmpty())
                    <div class="mt-6">
                        <h2 class="text-2xl font-semibold text-gray-700">{{ $titulo }}</h2>

                        <div class="grid md:grid-cols-2 gap-6 mt-4">
                            @foreach($groupedTransactions as $transaction)
                                <div class="p-6 bg-white rounded-2xl shadow-md border border-gray-200 text-center">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $transaction->property->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ $transaction->property->location }}</p>
                                    <p class="text-lg font-bold text-green-600 mt-2">${{ number_format($transaction->price, 2) }}</p>
                                    
                                    <p class="text-sm text-gray-500 mt-1">
                                        Estado: 
                                        <span class="font-medium {{ $transaction->status === 'completado' ? 'text-blue-600' : 'text-yellow-600' }}">
                                            {{ ucfirst($transaction->status) }}
                                        </span>
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Rol: 
                                        <span class="font-medium {{ $transaction->buyer_id === $user->id ? 'text-purple-600' : 'text-indigo-600' }}">
                                            {{ $transaction->buyer_id === $user->id ? 'Comprador' : 'Vendedor' }}
                                        </span>
                                    </p>

                                    <a href="{{ route('properties.show', $transaction->property->id) }}" 
                                       class="inline-block mt-4 px-5 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md transition">
                                        Ver propiedad
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</x-app-layout>
