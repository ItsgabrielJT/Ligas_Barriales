<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Registro') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('estadistica-equipo.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mb-4">
                {{ __('Lista de Estadisticas') }}
            </a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">                    
                <!-- Vista de Jugadores -->
                <div class="grid gap-8 grid-cols-1 my-5">

                    <form class="grid gap-8 grid-cols-1"
                        @if ($jugador->id) action="{{ route('estadistica-jugador.update', ['jugador' => $jugador->id]) }}" @else
                    action="{{ route('estadistica-jugador.store') }}" @endif
                        enctype="multipart/form-data" method="POST">
                        @if ($jugador->id)
                            {{ method_field('PUT') }}
                        @endif

                        @csrf
                        <input type="hidden" value="{{ $jugador->calendario_id }}" name="calendario_id">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                                <div class="grid grid-cols-3 gap-4">
                                    
                                    <div>
                                        <label for="jugador_id" class="block text-sm font-medium text-gray-700">
                                            Jugador
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <select name="jugador_id"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                                <option value="{{ old('jugador_id', $jugador->jugador_id) }}"> {{ $jugador->jugador->name }} </option>                                                
                                            </select>
                                        </div>
                                        @error('jugador_id')
                                            <span class=" text-sm text-red-600" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="goles" class="block text-sm font-medium text-gray-700">
                                            Goles
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="number" name="goles" id="goles"
                                                value="{{ old('goles', $jugador->goles) }}"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                        </div>
                                        @error('goles')
                                            <span class=" text-sm text-red-600" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="remates" class="block text-sm font-medium text-gray-700">
                                            Remates
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="number" name="remates" id="remates"
                                                value="{{ old('remates', $jugador->remates) }}"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                        </div>
                                        @error('remates')
                                            <span class=" text-sm text-red-600" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="asistencias" class="block text-sm font-medium text-gray-700">
                                            Asistencias
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" name="asistencias" id="asistencias"
                                                value="{{ old('asistencias', $jugador->asistencias) }}"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                        </div>
                                        @error('asistencias')
                                            <span class=" text-sm text-red-600" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="sanciones_id" class="block text-sm font-medium text-gray-700">
                                            Sanciones
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <select name="sanciones_id"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                                <option value="{{ old('sanciones_id', $jugador->sanciones_id) }}"> {{ $jugador->sanciones->tipo }} </option>
                                                @foreach ($sanciones as $usr)
                                                    <option value="{{ $usr->id }}">{{ $usr->tipo }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('sanciones_id')
                                            <span class=" text-sm text-red-600" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Aceptar
                                </button>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>     
        </div>
</x-app-layout>
