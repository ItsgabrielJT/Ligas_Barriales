<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Torneo') }} {{ $torneo->titulo }}
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
                <div class="relative py-3 pl-4 pr-10 leading-normal text-{{ session('color') }}-700 bg-{{ session('color') }}-100 rounded-lg mb-4"
                    role="alert">
                    <p>{{ session('message') }}</p>
                    
                </div>
            @endif

            <div class="overflow-hidden sm:rounded-lg">
                
                <form class="grid gap-8 grid-cols-1" action="{{ route('calendario.store', ['torneo'=>$torneo]) }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $torneo->id }}" name="torneo_id">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">

                            <div class="grid grid-cols-3 gap-4">
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
                                Agregar
                            </button>
                        </div>
                    </div>
                </form>

                <div class="w-full">                    
                    <div class=" text-right">
                        <form method="POST" action="{{ route('torneo.complete', ['calendario'=> $calendario->id, 'torneo'=> $torneo->id]) }}">
                            @csrf
                            <a href="{{ route('torneo.complete', ['calendario'=> $calendario->id, 'torneo'=> $torneo->id]) }}" onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mb-4">
                                {{ __('Complete and send') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>