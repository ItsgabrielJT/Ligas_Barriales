<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-10 bg-gray-200">
        <div class="flex items-center justify-center">
            <h1 class="text-black-500 text-2xl font-bold text-black-600  ">PARTIDOS PROGRAMADOS</h1>
        </div>

        @foreach ($calendario as $calen)
            <div
                class=" transition ease-in-out delay-200  hover:scale-110  duration-300 flex items-center justify-center py-10">

                <card class="shadow-2xl w-3/4 bg-white text-center rounded-lg py-10">
                    <div class="relative text-blue-500 text-2xl bottom-10 m-5">
                        {{ $calen->torneo->titulo }}
                    </div>

                    <div class="relative flex justify-center bottom-10">
                        <img src="https://picsum.photos/200/200" class="w-20 h-20" />
                    </div>

                    <div class="justify-center relative py-2">
                        <img src="https://picsum.photos/100/100"
                            class="absolute left-40 rounded-full w-20 h-20 bottom-2" />

                        <img src="https://picsum.photos/100/300"
                            class="absolute right-40 rounded-full w-20 h-20 bottom-2" />

                    </div>

                    <div class=" relative text-gray-500 py-2 ">
                        <p class="absolute left-40 top-2 ">E. Local</p>

                        <p class="absolute  right-20 mx-20 "> E. Visitante</p>

                    </div>

                    <div class=" relative text-black-500 ">
                        <p class="absolute left-40 top-5 ">{{ $calen->local->nombre_equipo }}</p>

                        <p class="absolute  right-20 mx-20 top-4"> {{ $calen->visitante->nombre_equipo }}</p>

                    </div>
                    <div class="relative top-10">

                        <hr class=" m-2 mx-20">
                        <p class="font-mono">Fecha del Partido:</p>
                        <div class="font-mono text-green-500 text-2x3">
                            {{ $calen->fecha_partido }}
                        </div>
                    </div>


                </card>
            </div>
        @endforeach
        <button id="fin"
            class="fixed bottom-0 right-0 mb-4 mr-4 py-2 px-4 text-white rounded-lg focus:outline-none">
            <div class="animate-bounce ">
                <img src="{{ asset('images/flecha.png') }}" style="width: 50px; height: 50px;">
            </div>
        </button>

    </div>

    //script para un scroll del boton que contiene un png que hace la accion de bajar la pagina
    <script>
        var scrollToBottomButton = document.getElementById("fin");

        scrollToBottomButton.addEventListener("click", function() {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: "smooth"
            });
        });
    </script>
</x-app-layout>
