<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(): View
    {
        return view('schedules.index', [
            'schedules' => Schedule::paginate(5)
        ]);
    }

    public function create(): View
    {
        return view('schedules.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'time' => ['required', 'string', 'min:5', 'max:5'],
        ]);

        Schedule::create($validated);

        return back()->with('success', 'Horário criado com sucesso!');
    }

    public function edit(Schedule $schedule): View
    {
        return view('schedules.edit', [
            'schedule' => $schedule
        ]);
    }

    public function update(Request $request, Schedule $schedule): RedirectResponse
    {
        $validated = $request->validate([
            'time' => ['required', 'string', 'min:5', 'max:5'],
        ]);

        $schedule->update($validated);

        return back()->with('success', 'Horário atualizado com sucesso!');
    }

    public function destroy(Schedule $schedule): RedirectResponse
    {
        $schedule->delete();

        return back()->with('success', 'Horário excluído com sucesso!');
    }
}
