@use('Illuminate\Support\Carbon')

<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Agendamentos') }}
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
                    @if ($schedules->count() > 0)
                        <table class="w-full text-sm text-left text-gray-500" x-data>
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Usuário</th>
                                    <th scope="col" class="px-6 py-3">Data</th>
                                    <th scope="col" class="px-6 py-3">Horário</th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Ações</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $schedule->user->name }}</th>
                                    <td class="px-6 py-4">{{ Carbon::parse($schedule->schedule_date)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4">{{ $schedule->schedule_hour }}</td>
                                    <td class="flex flex-row px-6 py-4 gap-x-2">
                                        <a href="{{ route('schedules.edit', $schedule->id) }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">Editar</a>
                                        <form
                                            @submit.prevent="() => {
                                                if (confirm('Tem certeza que deseja excluir este agendamento?')) {
                                                    $el.submit()
                                                }
                                            }"
                                                class="mb-0"
                                                action="{{ route('schedules.destroy', $schedule->id) }}" method="POST"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit">Excluir</x-danger-button>
                                            </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Nenhum agendamento encontrado.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
