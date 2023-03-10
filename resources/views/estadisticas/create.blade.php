<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo Registro') }}
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
            @if (session('status'))
                <div class="relative py-3 pl-4 pr-10 leading-normal text-{{ session('color') }}-700 bg-{{ session('color') }}-100 rounded-lg mb-4"
                    role="alert">
                    <p>{{ session('message') }}</p>
                    
                </div>
            @endif

            <!-- Equipos -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <form class="grid gap-8 grid-cols-1"
                    @if ($estadisticaEq->id) action="{{ route('estadistica-equipo.update', ['estadistica' => $estadisticaEq->id]) }}" @else
                    action="{{ route('estadistica-equipo.store') }}" @endif
                    enctype="multipart/form-data" method="POST">
                    @if ($estadisticaEq->id)
                        {{ method_field('PUT') }}
                    @endif

                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                            <div class="grid grid-cols-4 gap-4">

                                <div>
                                    <label for="calendario_id" class="block text-sm font-medium text-gray-700">
                                        Partido
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <select name="calendario_id"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                            <option value=""> Selecciona el partido </option>
                                            @foreach ($calendarios as $cld)
                                                <option value="{{ $cld->id }}"> {{ $cld->local->nombre_equipo }} VS
                                                    {{ $cld->visitante->nombre_equipo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('calendario_id')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="total_disparos" class="block text-sm font-medium text-gray-700">
                                        Total de tiros
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="number" name="total_disparos" id="total_disparos"
                                            value="{{ old('total_disparos', $estadisticaEq->total_disparos) }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                    </div>
                                    @error('total_disparos')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="total_pases" class="block text-sm font-medium text-gray-700">
                                        Total de pases
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="number" name="total_pases" id="total_pases"
                                            value="{{ old('total_pases', $estadisticaEq->total_pases) }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                    </div>
                                    @error('total_pases')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="posesion" class="block text-sm font-medium text-gray-700">
                                        Posesion
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="text" name="posesion" id="posesion"
                                            value="{{ old('posesion', $estadisticaEq->posesion) }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                    </div>
                                    @error('posesion')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tiros_esquina" class="block text-sm font-medium text-gray-700">
                                        Tiros de Esquina
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="number" name="tiros_esquina" id="tiros_esquina"
                                            value="{{ old('tiros_esquina', $estadisticaEq->tiros_esquina) }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                    </div>
                                    @error('tiros_esquina')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="pases_fallidos" class="block text-sm font-medium text-gray-700">
                                        Pases fallidos
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="number" name="pases_fallidos" id="pases_fallidos"
                                            value="{{ old('pases_fallidos', $estadisticaEq->pases_fallidos) }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                    </div>
                                    @error('pases_fallidos')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tiros_fallidos" class="block text-sm font-medium text-gray-700">
                                        Tiros Fallidos
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="number" name="tiros_fallidos" id="tiros_fallidos"
                                            value="{{ old('tiros_fallidos', $estadisticaEq->tiros_fallidos) }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                    </div>
                                    @error('tiros_fallidos')
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

            <!-- Jugadores -->

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-10">

                <form class="grid gap-8 grid-cols-1"
                    @if ($estadisticaJd->id) action="{{ route('estadistica-jugador.update', ['estadistica' => $estadisticaJd->id]) }}" @else
                    action="{{ route('estadistica-jugador.store') }}" @endif
                    enctype="multipart/form-data" method="POST">
                    @if ($estadisticaJd->id)
                        {{ method_field('PUT') }}
                    @endif

                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                            <div class="grid grid-cols-4 gap-4">

                                <div>
                                    <label for="calendario_id" class="block text-sm font-medium text-gray-700">
                                        Partido
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <select name="calendario_id"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                            <option value=""> Selecciona el Partido </option>
                                            @foreach ($calendarios as $cld)
                                                <option value="{{ $cld->id }}"> {{ $cld->local->nombre_equipo }} VS
                                                    {{ $cld->visitante->nombre_equipo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('calendario_id')
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
                                            value="{{ old('goles', $estadisticaJd->goles) }}"
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
                                            value="{{ old('remates', $estadisticaJd->remates) }}"
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
                                            value="{{ old('asistencias', $estadisticaJd->asistencias) }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                    </div>
                                    @error('asistencias')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>                                

                                <div>
                                    <label for="jugador_id" class="block text-sm font-medium text-gray-700">
                                        Jugador   
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <select name="jugador_id"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                            <option value="">Selecciona uno</option>
                                            @foreach ($users as $buyer)
                                                <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('jugador_id')
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
                                            <option value="">Selecciona una</option>
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
