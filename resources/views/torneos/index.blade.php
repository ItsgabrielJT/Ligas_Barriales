@extends('templates.index')

@section('title', 'Torneos')

@section('button-add')
    @can('torneo.create')
    <a href="{{ route('torneo.create') }}"
    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition mb-4">
    {{ __('Agregar Torneo') }}
</a>
    @endcan
@endsection

@section('search')
<div class="max-w-2xl mx-auto">

    @if (session('status'))
                <div class="relative py-3 pl-4 pr-10 leading-normal text-{{ session('color') }}-700 bg-{{ session('color') }}-100 rounded-lg mb-4"
                    role="alert">
                    <p>{{ session('message') }}</p>
                    
                </div>
     @endif

    <form class="flex items-center" action="{{ route('torneo.index') }}" method="get">
        @csrf
        @method('GET')
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" name="texto"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search" required
                value="{{ $texto }}">
                
        </div>
        <button type="submit"
            class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg
                class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg></button>
    </form>                
</div>
@endsection

@section('table')
<div class="overflow-x-auto">
    <div
        class="min-w-screen bg-gray-100 flex items-center justify-center font-sans overflow-hidden">
        <div class="w-full">
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">#Id</th>
                            <th class="py-3 px-6 text-center">Nombre</th>
                            <th class="py-3 px-6 text-center">Estatus</th>
                            <th class="py-3 px-6 text-center">Created el</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @if(count($torneos)<=0)
                                <tr>
                                    <td colspan="5" class="py-3 px-6 text-left whitespace-nowrap font-medium"> No hay Resultados </td>
                                </tr>
                            @else
                        @foreach ($torneos as $trn)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img class="w-20    " src="{{ $trn->url }}" />
                                    </div>
                                    <span class="font-medium">{{ str_pad($trn->id, 4, 0, STR_PAD_LEFT) }}</span>
                                </div>
                            </td>

                            <td class="py-3 px-6 text-center">
                                <span>{{ $trn->titulo }}</span>
                            </td>

                            <td class="py-3 px-6 text-center">
                                <span>{{ $trn->estado_torneo }}</span>
                            </td>

                            <td class="py-3 px-6 text-center">
                                <span>{{ $trn->created_at }}</span>
                            </td>

                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    @can('calendario.index')
                                    <div
                                    class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <a
                                        href={{ route('calendario.index', ['torneo'=> $trn->id]) }}>                                            
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M17 22v-3h-3v-2h3v-3h2v3h3v2h-3v3ZM5 20q-.825 0-1.413-.587Q3 18.825 3 18V6q0-.825.587-1.412Q4.175 4 5 4h1V2h2v2h6V2h2v2h1q.825 0 1.413.588Q19 5.175 19 6v6.1q-.5-.075-1-.075t-1 .075V10H5v8h7q0 .5.075 1t.275 1ZM5 8h12V6H5Zm0 0V6v2Z"/></svg>
                                    </a>
                                </div>
                                    @endcan


                                    {{-- Edit --}}
                                    @can('torneo.update')
                                    <div
                                    class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">

                                    <a
                                        href={{ route('torneo.edit', ['torneo'=> $trn->id]) }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                </div>
                                    @endcan

                                    @can('torneo.destroy')
                                    <div
                                    class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                    <form method="POST"
                                        action="{{ route('torneo.destroy', ['torneo'=> $trn->id]) }}">
                                        @csrf
                                        {{  method_field("DELETE") }}

                                        <a href="{{ route('torneo.destroy', ['torneo'=> $trn->id]) }}"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    </form>

                                </div>
                                    @endcan
                                </div>
                            </td>
                        </tr>

                        @endforeach
                        @endif

                    </tbody>
                </table>
                {{ $torneos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection