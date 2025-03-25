<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-6 sm:px-10 bg-white shadow rounded-lg">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Usuarios no Administradores</h1>

        @if($users->isEmpty())
            <p class="text-lg text-center text-gray-600">No hay usuarios registrados que no sean administradores.</p>
        @else
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-600 shadow-md rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-medium text-gray-900">Nombre</th>
                        <th class="px-6 py-4 font-medium text-gray-900">Correo Electrónico</th>
                        <th class="px-6 py-4 font-medium text-gray-900">Fecha de Registro</th>
                        <th class="px-6 py-4 font-medium text-gray-900">Acciones</th> <!-- Nueva columna para acciones -->
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <!-- Botón para editar -->
                                <a href="{{ route('admin.edit', $user->id) }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                                    Editar
                                </a>

                                <!-- Formulario para eliminar el usuario con confirmación -->
                                <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        function confirmDelete() {
            return confirm('¿Estás seguro de que deseas eliminar este usuario?');
        }
    </script>
</x-app-layout>
