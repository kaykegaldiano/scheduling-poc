<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Agendamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="" method="POST">
                        @csrf

                        <div class="flex flex-col gap-1">
                            <x-input-label for="schedule_date" value="Selecione a data" />
                            <x-text-input id="schedule_date" name="schedule_date" />
                        </div>

                        <x-primary-button class="mt-4">Agendar</x-primary-button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('pickr')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr('#schedule_date', {
                    disable: [
                        {!! $holidays->count() > 0 ? "'" . implode("', '", $holidays->pluck('date')->all()) . "'" : '' !!},
                        function(date) {
                            return (date.getDay() === 0);
                        }
                    ],
                    dateFormat: 'd/m/Y',
                    minDate: 'today',
                });
            })
        </script>
    @endpush

</x-app-layout>

