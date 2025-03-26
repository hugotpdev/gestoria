<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-semibold mb-4">Hola, {{ auth()->user()->name }}.  👋</h3>
                    <p class="mb-6">Desde aquí puedes gestionar tus propiedades, comprar nuevas propiedades y más.</p>

                    <div class="space-y-6">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12h-6m0 0H7m0 0l4-4m-4 4l4 4" />
                            </svg>
                            <a href="{{ route('properties.index') }}" class="text-xl font-medium text-blue-500 hover:text-blue-700 hover:underline transition duration-300">Ver todas las propiedades</a>
                        </div>

                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <a href="{{ route('properties.create') }}" class="text-xl font-medium text-green-500 hover:text-green-700 hover:underline transition duration-300">Crear nueva propiedad</a>
                        </div>

                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12l5-5m0 0l5 5m-5-5v12" />
                            </svg>
                            <a href="{{ route('properties.active') }}" class="text-xl font-medium text-yellow-500 hover:text-yellow-700 hover:underline transition duration-300">Ver propiedades activas</a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
