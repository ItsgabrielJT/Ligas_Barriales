<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New teams') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('teams.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opadescripcionty-25 transition mb-4">
                {{ __('teams list') }}
            </a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <form class="grid gap-8 grid-cols-1"
                    @if ( $teams->id ) action="{{ route('teams.update', ['teams' => $ts->id]) }}" @else
                    action="{{ route('teams.store') }}" @endif
                    enctype="multipart/form-data" method="POST">
                    @if ($teams->id)
                        {{ method_field('PUT') }}
                    @endif

                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <div class="grid gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="nombre_equipo" class="block text-sm font-medium text-gray-700">
                                        Nombre
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="text" name="nombre_equipo" id="nombre_equipo"
                                            value="{{ old('nombre_equipo', $teams->nombre_equipo) }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                    </div>
                                    @error('nombre_equipo')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="descripcion" class="block text-sm font-medium text-gray-700">
                                        Descripcion
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="text" name="descripcion" id="descripcion"
                                            value="{{ old('descripcion', $teams->descripcion) }}"
                                            class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                    </div>
                                    @error('descripcion')
                                        <span class=" text-sm text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="grid gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <label for="user_id" class="block text-sm font-medium text-gray-700">
                                        Buyer
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <select name="user_id" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300">
                                            <option value="">Choose one</option>
                                            @foreach ($users as $buyer)
                                            <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('user_id')
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
                                Save
                            </button>
                        </div>
                    </div>
                </form>


            </div>
        </div>

    </div>
</x-app-layout>
