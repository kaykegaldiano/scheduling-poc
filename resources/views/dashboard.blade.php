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

    @session('error')
        <div class="px-4 py-3 text-red-800 bg-red-400 border border-red-400 rounded" role="alert">
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

            document.querySelector('#schedule_date').addEventListener('change', async evt => {
                if (evt.target.value !== '') {
                    const schedulesArray = []
                    const schedules = await fetch('/api/schedules')
                    const schedulesData = await schedules.json()

                    const scheduleTimes = await fetch('/api/schedule-times')
                    const scheduleTimesData = await scheduleTimes.json()

                    schedulesData.forEach(schedule => {
                        scheduleTimesData.forEach(scheduleTimeData => {
                            if (scheduleTimeData.schedule_date === evt.target.value && scheduleTimeData.schedule_hour === schedule.time) {
                                schedulesArray.push(schedule.time)
                            }
                        })
                    })

                    const sel = document.querySelector('#schedule_hour')

                    while (sel.options.length > 1) {
                        sel.remove(1)
                    }

                    schedulesData.forEach(schedule => {
                        if (schedulesArray.includes(schedule.time)) {
                            return
                        }

                        const opt = document.createElement('option')
                        opt.value = schedule.time
                        opt.text = schedule.time
                        sel.add(opt, null)
                    })
                }
            })
        </script>
    @endpush

</x-app-layout>
