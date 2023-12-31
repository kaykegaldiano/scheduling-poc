<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Editar feriado') }}
        </h2>
    </x-slot>

    @session('success')
        <div class="px-4 py-3 text-green-800 bg-green-400 border border-green-400 rounded" role="alert">
            {{ $value }}
        </div>
    @endsession

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('holidays.update', $holiday->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-col gap-1">
                            <x-input-label for="name" :value="__('Nome do feriado')" />
                            <x-text-input id="name" name="name" :value="$holiday->name" />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>

                        <div class="flex flex-col gap-1 pt-4" x-data>
                            <x-input-label for="date" :value="__('Data do feriado')" />
                            <x-text-input class="date" id="date" name="date" placeholder="dd/mm/aaaa" :value="$holiday->date" />
                            <x-input-error :messages="$errors->get('date')" />
                        </div>

                        <x-primary-button class="mt-4">Atualizar</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
