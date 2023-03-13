<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @yield('title')
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-3">
            @yield('button-add')

            <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css" />

            <!-- This is an example component -->
            @yield('search')
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- component Table-->
                @yield('table')
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-3">
            <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css" />

            <!-- This is an example component -->
            @yield('search-2')
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- component Table-->
                @yield('table-2')
        </div>
    </div>


        
</x-app-layout>
