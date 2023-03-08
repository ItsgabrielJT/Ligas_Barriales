<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Torneo') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('calendario.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mb-4">
                {{ __('Lista de Fechas') }}
            </a>
        </div>
        
       

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">      
            
            @if (session('status'))
            <div class="relative py-3 pl-4 pr-10 leading-normal text-{{ session('color') }}-700 bg-{{ session('color') }}-100 rounded-lg"
                role="alert">
                <p>{{ session('message') }}</p>
                <span class="absolute inset-y-0 right-0 flex items-center mr-4">
                    <svg class="w-4 h-4 fill-current" role="button" viewBox="0 0 20 20">
                        <path
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                </span>
            </div>
            @endif            

            <div class="overflow-hidden sm:rounded-lg">
                <form class="grid gap-8 grid-cols-1" action="{{ route('calendario.store') }}" method="POST">
                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                            <div class="grid grid-cols-3 gap-4">

                                <div>
                                    <label for="torneo_id" class="block text-sm font-medium text-gray-700">
                                        Torneo
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <select name="torneo_id"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                            <option value="">Escoge un torneo</option>
                                            @foreach ($torneos as $tr)
                                            <option value="{{ $tr->id }}">{{ $tr->titulo }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('torneo_id')
                                    <span class=" text-sm text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div>
                                   <label for="local_id" class="block text-sm font-medium text-gray-700">
                                        Equipo Local
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <select name="local_id"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                            <option value="">Escoge un equipo</option>
                                            @foreach ($equipos as $eqp)
                                            <option value="{{ $eqp->id }}">{{ $eqp->nombre_equipo }}
                                                ({{ $eqp->image }}) </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('local_id')
                                    <span class=" text-sm text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="visitante_id" class="block text-sm font-medium text-gray-700">
                                        Equipo Visitante
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <select name="visitante_id"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                            <option value="">Escoge un equipo</option>
                                            @foreach ($equipos as $eqp)
                                            <option value="{{ $eqp->id }}">{{ $eqp->nombre_equipo }}
                                                ({{ $eqp->image }}) </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('visitante_id')
                                    <span class=" text-sm text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="fecha_partido" class="block text-sm font-medium text-gray-700">
                                        Fecha Partido
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="datetime-local" name="fecha_partido" id="fecha_partido" value="{{ old('fecha_partido') }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                    </div>
                                    @error('fecha_partido')
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

                <div class="w-full">
                    <div class="bg-white rounded my-2">
                        <div class="overflow-x-auto">
                            <h3 class="font-semibold text-xl text-gray-800 leading-tight px-5 py-5"> Calendarios Creados
                            </h3>
                            <div
                                class="min-w-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                                <div class="w-full">
                                    <div class="bg-white shadow-md rounded my-6">
                                        <table class="min-w-max w-full table-auto">
                                            <thead>
                                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                                    <th class="py-3 px-6 text-left">Torneo</th>
                                                    <th class="py-3 px-6 text-left">Local</th>
                                                    <th class="py-3 px-6 text-center">Visitante</th>
                                                    <th class="py-3 px-6 text-center">Fecha</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 text-sm font-light">                                                
                                                @foreach ($calendarios as $cale)
                                                <tr class="border-b border-gray-200 hover:bg-gray-100">                            
                                                    <td class="py-3 px-6 text-left">
                                                        <div class="flex items-center">
                                                            <span>{{ $cale->torneo_id }}</span>
                                                        </div>
                                                    </td>

                                                    <td class="py-3 px-6 text-center">
                                                        <span>{{ $cale->local_id }}</span>
                                                    </td>

                                                    <td class="py-3 px-6 text-center">
                                                        <span>{{ $cale->visitante_id }}</span>
                                                    </td>

                                                    <td class="py-3 px-6 text-center">
                                                        <span>{{ $cale->fecha_partido }}</span>
                                                    </td>

                                                </tr>                                               
                                                @endforeach                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" text-right">

                        <form method="POST" action="{{ route('torneo.complete') }}">
                            @csrf
                            <a href="{{ route('torneo.complete') }}" onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mb-4">
                                {{ __('Aceptar Fechas') }}

                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
