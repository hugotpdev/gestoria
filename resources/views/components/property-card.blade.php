<div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-xl duration-300">
    <!-- Mostrar la imagen usando Storage::url() -->
    <img src="{{ $property->image_url ? Storage::url($property->image_url) : 'https://via.placeholder.com/400x250' }}" alt="Propiedad" class="w-full h-56 object-cover rounded-t-lg">
    <div class="p-6 space-y-4">
        <h2 class="text-2xl font-semibold text-gray-800">{{ $property->title }}</h2>
        <p class="text-lg font-semibold text-gray-800">€{{ number_format($property->price, 2) }}</p>
        <p class="text-sm text-gray-600">Ubicación: {{ $property->location }}</p>
        <span class="inline-block bg-blue-500 text-white text-xs px-2 py-1 rounded-full">{{ ucfirst($property->status) }}</span>

        <div class="space-y-3">
            <a href="{{ route('properties.show', $property->id) }}" class="inline-block bg-indigo-600 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                Ver Detalles
            </a>

            <!-- Solo mostrar el botón de comprar si el usuario no es el propietario -->
            @if(auth()->id() !== $property->user_id && $property->status === 'disponible')
                <!-- Formulario de compra dentro del div de la tarjeta -->
                <form action="{{ route('properties.buy', ['id' => $property->id]) }}" method="POST" id="buyForm{{ $property->id }}">
                    @csrf
                    <div class="flex justify-end mt-4"> <!-- Añadido para alinear el botón a la derecha -->
                        <button type="button" class="bg-blue-500 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200" onclick="confirmPurchase({{ $property->id }})">
                            Comprar
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

<script>
    function confirmPurchase(propertyId) {
        // Mostrar el cuadro de confirmación
        if (confirm("¿Estás seguro de que quieres comprar esta propiedad?")) {
            // Si el usuario confirma, enviar el formulario
            document.getElementById('buyForm' + propertyId).submit();
        }
    }
</script>
