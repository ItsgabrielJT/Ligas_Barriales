<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-gray-300 h-screen flex items-center justify-center">
        @foreach ($calendario as $calen)
            <card class="w-1/4 grid grid-col bg-white text-center gap-4 p-4 rounded-lg">
                <div class="text-gray-500 text-xs">
                    {{ $calen->torneo_id }}
                </div>
                <div class="flex flex-row justify-center gap-3">
                    <img src="https://picsum.photos/100/100" class="rounded-full w-20 h-20 m-5" />
                    <img src="https://picsum.photos/200/200" class="w-20 h-20 " />
                    <img src="https://picsum.photos/100/100" class="rounded-full w-20 h-20 m-5" />
                </div>
                <div>
                    <div class="text-gray-700 flex flex-row justify-center gap-3">
                        <p class=" relative right-20  bottom-5">E. Local</p>

                        <p class="relative left-20  bottom-5">E. Visitante</p>
                    </div>
                </div>
                <div>
                    Fecha de Partido: {{ $calen->fecha_partido }}
                </div>
            </card>
        @endforeach
    </div>
</x-app-layout>
