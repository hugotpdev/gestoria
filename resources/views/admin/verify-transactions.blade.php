<x-app-layout>
    <div class="container mx-auto mt-10">
        <h1 class="text-5xl font-extrabold text-gray-900 mb-8 text-center">Transacciones Pendientes</h1>

        @if($transactions->isEmpty())
            <p class="text-center text-gray-600">No hay transacciones pendientes.</p>
        @else
            <div class="space-y-6">
                @foreach($transactions as $transaction)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $transaction->property->title }}</h2>
                        <p class="text-sm text-gray-600">Transacción de: 
                            {{ $transaction->type === 'venta' ? 'Venta' : 'Alquiler' }}</p>
                        <p class="text-lg font-semibold text-gray-800">€{{ number_format($transaction->price, 2) }}</p>
                        <p class="text-sm text-gray-600">Fecha de transacción: 
                            {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y H:i') }}</p>
                        
                        <p class="text-sm text-gray-600">Comprador: {{ $transaction->buyer->name }}</p>
                        <p class="text-sm text-gray-600">Vendedor: {{ $transaction->seller->name }}</p>

                        <!-- Botones de acción -->
                        <div class="flex space-x-4 mt-6">
                            <!-- Aceptar transacción -->
                            <form action="{{ route('transactions.accept', $transaction->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200">
                                    Aceptar
                                </button>
                            </form>

                            <!-- Cancelar transacción -->
                            <form action="{{ route('transactions.cancel', $transaction->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-200">
                                    Cancelar
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
