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
            

            <!-- Vista de partidos -->

            <div class="w-full">
                <div class="bg-white rounded my-2">
                    <div class="overflow-x-auto">
                        <h3 class="font-semibold text-xl text-gray-800 leading-tight px-5 py-5"> Lista de partidos
                        </h3>
                        <div
                            class="min-w-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
                            <div class="w-full">
                                <div class="bg-white shadow-md rounded my-6">
                                    <table class="min-w-max w-full table-auto">
                                        <thead>
                                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                                <th class="py-3 px-6 text-left">Local</th>
                                                <th class="py-3 px-6 text-center">Visitante</th>
                                                <th class="py-3 px-6 text-center">Fecha</th>
                                                <th class="py-3 px-6 text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 text-sm font-light">
                                            @foreach ($calendarios as $cale)
                                                <tr class="border-b border-gray-200 hover:bg-gray-100">

                                                    <td class="py-3 px-6 text-left">
                                                        <span>{{ $cale->local->nombre_equipo }}</span>
                                                    </td>

                                                    <td class="py-3 px-6 text-center">
                                                        <span>{{ $cale->visitante->nombre_equipo }}</span>
                                                    </td>

                                                    <td class="py-3 px-6 text-center">
                                                        <span>{{ $cale->fecha_partido }}</span>
                                                    </td>
                                                    <td class="py-3 px-6 text-center">
                                                        <div class="flex item-center justify-center">
                                                            <div
                                                                class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                                <a
                                                                    href="{{ route('estadistica-equipo.select', ['calendario' => $cale->id]) }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        viewBox="0 0 16 16">
                                                                        <path fill="currentColor"
                                                                            d="M2.5 1.75v11.5c0 .138.112.25.25.25h3.17a.75.75 0 0 1 0 1.5H2.75A1.75 1.75 0 0 1 1 13.25V1.75C1 .784 1.784 0 2.75 0h8.5C12.216 0 13 .784 13 1.75v7.736a.75.75 0 0 1-1.5 0V1.75a.25.25 0 0 0-.25-.25h-8.5a.25.25 0 0 0-.25.25Zm13.274 9.537v-.001l-4.557 4.45a.75.75 0 0 1-1.055-.008l-1.943-1.95a.75.75 0 0 1 1.062-1.058l1.419 1.425l4.026-3.932a.75.75 0 1 1 1.048 1.074ZM4.75 4h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1 0-1.5ZM4 7.75A.75.75 0 0 1 4.75 7h2a.75.75 0 0 1 0 1.5h-2A.75.75 0 0 1 4 7.75Z" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $calendarios->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fin Vista de partidos -->


            <!--  Vista de equipos -->
            @if ($select != false)

                <div class="grid gap-8 grid-cols-2">

                    <form class="grid gap-8 grid-cols-1 shadow-xl sm:rounded-lg"
                        @if ($estadisticaEq->id) action="{{ route('estadistica-equipo.update', ['estadistica' => $estadisticaEq->id]) }}" @else
                action="{{ route('estadistica-equipo.store') }}" @endif
                        enctype="multipart/form-data" method="POST">
                        @if ($estadisticaEq->id)
                            {{ method_field('PUT') }}
                        @endif

                        @php
                            $image = $calendario->local->url;
                        @endphp

                        @csrf
                        <input type="hidden" value="{{ $calendario->id }}" name="calendario_id">
                        <input type="hidden" value="{{ $calendario->local_id }}" name="equipo_id">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                <div class="mr-2">
                                    <img class="w-40" src="{{ $image }}" />
                                    <span class=" text-sm text-purple-500" role="alert">
                                        <strong>{{ $calendario->local->nombre_equipo }}</strong>
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="goles" class="block text-sm font-medium text-gray-700">
                                            Goles
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="number" name="goles" id="goles"
                                                value="{{ old('goles', $estadisticaEq->goles) }}"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                        </div>
                                        @error('goles')
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

                    <form class="grid gap-8 grid-cols-1 shadow-xl sm:rounded-lg"
                        @if ($estadisticaEq->id) action="{{ route('estadistica-equipo.update', ['estadistica' => $estadisticaEq->id]) }}" @else
                action="{{ route('estadistica-equipo.store') }}" @endif
                        enctype="multipart/form-data" method="POST">
                        @if ($estadisticaEq->id)
                            {{ method_field('PUT') }}
                        @endif
                        @php
                            $image = $calendario->visitante->url;
                        @endphp

                        @csrf
                        <input type="hidden" value="{{ $calendario->id }}" name="calendario_id">
                        <input type="hidden" value="{{ $calendario->visitante_id }}" name="equipo_id">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                <div class="mr-2">
                                    <img class="w-40" src="{{ $image }}" />
                                    <span class=" text-sm text-purple-500" role="alert">
                                        <strong>{{ $calendario->visitante->nombre_equipo }}</strong>
                                    </span>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="goles" class="block text-sm font-medium text-gray-700">
                                            Goles
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="number" name="goles" id="goles"
                                                value="{{ old('goles', $estadisticaEq->goles) }}"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300">
                                        </div>
                                        @error('goles')
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

                <!-- Vista de Jugadores -->

                <div class="grid gap-8 grid-cols-2 my-5">

                    <form class="grid gap-8 grid-cols-1"
                        @if ($estadisticaJd->id) action="{{ route('estadistica-jugador.update', ['estadistica' => $estadisticaJd->id]) }}" @else
                    action="{{ route('estadistica-jugador.store') }}" @endif
                        enctype="multipart/form-data" method="POST">
                        @if ($estadisticaJd->id)
                            {{ method_field('PUT') }}
                        @endif

                        @csrf
                        <input type="hidden" value="{{ $calendario->id }}" name="calendario_id">
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
                                                <option value="">Selecciona uno</option>
                                                @foreach ($plantillas as $buyer)
                                                    @if ($buyer->equipo_id == $calendario->local_id)
                                                        <option value="{{ $buyer->jugador_id }}">{{ $buyer->user->name }}</option>                                                    
                                                    @endif
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

                    <form class="grid gap-8 grid-cols-1"
                    @if ($estadisticaJd->id) action="{{ route('estadistica-jugador.update', ['estadistica' => $estadisticaJd->id]) }}" @else
                    action="{{ route('estadistica-jugador.store') }}" @endif
                    enctype="multipart/form-data" method="POST">
                    @if ($estadisticaJd->id)
                        {{ method_field('PUT') }}
                    @endif

                    @csrf
                    <input type="hidden" value="{{ $calendario->id }}" name="calendario_id">
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
                                            <option value="">Selecciona uno</option>
                                            @foreach ($plantillas as $buyer)
                                                @if ($buyer->equipo_id == $calendario->visitante_id)
                                                    <option value="{{ $buyer->jugador_id }}">{{ $buyer->user->name }}</option>                                                    
                                                @endif
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
            <!-- Fin Vista de Jugadores -->
                </div>
            @else
                <span class=" text-sm text-slate-500" role="alert">
                    <strong> No se ha seleccionado un partido </strong>
                </span>
            @endif        
        </div>
</x-app-layout>
