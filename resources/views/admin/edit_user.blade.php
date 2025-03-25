<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6 sm:px-10 bg-white shadow rounded-lg">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Editar Usuario</h1>

        <form action="{{ route('admin.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="mt-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <label for="password" class="block text-sm font-semibold text-gray-700">Contraseña (dejar vacía si no deseas cambiarla)</label>
                <input type="password" id="password" name="password" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div class="mt-4">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Botón de Enviar -->
            <div class="mt-6">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
