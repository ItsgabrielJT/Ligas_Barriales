<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo plantilla') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('plantilla.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mb-4">
                {{ __('Lista de plantillas') }}
            </a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form class="grid gap-8 grid-cols-1"
                @if ($plantilla->id) action="{{ route('plantilla.update', ['plantilla' => $plantilla->id]) }}" @else
                    action="{{ route('plantilla.store') }}" @endif
                enctype="multipart/form-data" method="POST">
                @if ($plantilla->id)
                    {{ method_field('PUT') }}
                @endif

                @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="equipo_id" class="block text-sm font-medium text-gray-700">
                                    DT {{ Auth::user()->name }}
                                    @foreach ($equipo as $eqp)
                                        @if ($eqp->user_id == Auth::user()->id)
                                            <label for="equipo_id" class="block text-sm font-medium text-gray-700">
                                                {{ $eqp->nombre_equipo }}
                                            </label>
                                        @endif
                                    @endforeach
                                </label>
                                @foreach ($equipo as $eqp)
                                    @if ($eqp->user_id == Auth::user()->id)
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="hidden" name="equipo_id" id="equipo_id"
                                                value="{{ $eqp->id }}"
                                                class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                        </div>
                                    @endif
                                @endforeach
                                @error('equipo_id')
                                    <span class=" text-sm text-red-600" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="jugador_id" class="block text-sm font-medium text-gray-700">
                                    Jugadores
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <select name="jugador_id"
                                        class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                        <option value="">Escoge uno</option>
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
                        </div>

                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Agregar Jugador
                        </button>
                    </div>
                </div>
            </form>

            <div class="w-full">
                <div class="bg-white rounded my-2">
                    <div class="overflow-x-auto">
                        <h3 class="font-semibold text-xl text-gray-800 leading-tight px-5 py-5"> Jugadores Agregados
                        </h3>
                        <div
                            class="min-w-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
                            <div class="w-full">
                                <div class="bg-white shadow-md rounded my-6">
                                    <table class="min-w-max w-full table-auto">
                                        <thead>
                                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                                <th class="py-3 px-6 text-left">#ID</th>
                                                <th class="py-3 px-6 text-center">Jugador</th>
                                                <th class="py-3 px-6 text-center">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 text-sm font-light">
                                            @foreach ($plantillas as $usr)
                                                <tr class="border-b border-gray-200 hover:bg-gray-100">

                                                    <td class="py-3 px-6 text-left">
                                                        <span>{{ $usr->id }}</span>
                                                    </td>

                                                    <td class="py-3 px-6 text-center">
                                                        <span>{{ $usr->user->name }}</span>
                                                    </td>

                                                    <td class="py-3 px-6 text-center">
                                                        <span>{{ $usr->user->email }}</span>
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

                    <form method="POST" action="{{ route('plantilla.complete') }}">
                        @csrf
                        <a href="{{ route('plantilla.complete') }}"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mb-4">
                            {{ __('Aceptar Fechas') }}

                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
