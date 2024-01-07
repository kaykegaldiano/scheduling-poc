<?php

namespace App\Http\Controllers;

use App\Models\ScheduleTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('schedules.index', [
            'schedules' => ScheduleTime::with('user')
                ->oldest('schedule_date')
                ->get()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(ScheduleTime $schedule)
    {
        return view('schedules.edit', [
            'schedule' => $schedule
        ]);
    }

    public function update(Request $request, ScheduleTime $schedule)
    {
        //
    }

    public function destroy(ScheduleTime $schedule): RedirectResponse
    {
        $schedule->delete();

        return back()->with('success', 'Agendamento excluido com sucesso!');
    }
}
