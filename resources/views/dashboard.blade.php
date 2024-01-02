@dd($scheduleTimes[0]->schedule_date)

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Agendamento') }}
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

                    <form action="{{ route('dashboard') }}" method="POST" x-data="{ visible: false }">
                        @csrf

                        <div class="flex flex-col gap-1">
                            <x-input-label for="schedule_date" value="Selecione a data" />
                            <x-text-input
                                @change="$el.value !== '' ? visible = true : visible = false"
                                id="schedule_date"
                                name="schedule_date"
                            />
                            <x-input-error :messages="$errors->get('schedule_date')" />
                        </div>

                        <div class="flex flex-col gap-1 pt-4" x-show="visible" x-transition>
                            <x-input-label for="schedule_time" value="Selecione o horário" />
                            <select class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="schedule_hour" id="schedule_hour">
                                <option value="" selected>-</option>
                                    @foreach ($schedules as $schedule)
                                        <option value="{{ $schedule->time }}">{{ $schedule->time }}</option>
                                    @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('schedule_hour')" />
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
                    altInput: true,
                    altFormat: 'd/m/Y',
                    dateFormat: 'Y-m-d',
                    minDate: 'today',
                });
            })
        </script>
    @endpush

</x-app-layout>

