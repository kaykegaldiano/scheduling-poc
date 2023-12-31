<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agendamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="" method="POST">
                        @csrf

                        <x-input-label for="date" value="Select date" />
                        <x-text-input id="date" name="date" />

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
