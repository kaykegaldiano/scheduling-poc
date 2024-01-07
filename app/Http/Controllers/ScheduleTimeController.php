<?php

namespace App\Http\Controllers;

use App\Models\ScheduleTime;
use Illuminate\Http\RedirectResponse;

class ScheduleTimeController extends Controller
{
    public function index()
    {
        return view('scheduled_times.index', [
            'schedules' => ScheduleTime::with('user')
                ->oldest('schedule_date')
                ->get()
        ]);
    }

    public function destroy(ScheduleTime $schedule): RedirectResponse
    {
        $schedule->delete();

        return back()->with('success', 'Agendamento excluido com sucesso!');
    }
}
