<?php

namespace App\Http\Controllers;

use App\Models\ScheduleTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ScheduleTimeController extends Controller
{
    public function index(): View
    {
        return view('scheduled_times.index', [
            'schedules' => ScheduleTime::with('user')
                ->oldest('schedule_date')
                ->orderBy('schedule_hour', 'asc')
                ->get()
        ]);
    }

    public function destroy(ScheduleTime $scheduledTime): RedirectResponse
    {
        $scheduledTime->delete();

        return back()->with('success', 'Agendamento excluido com sucesso!');
    }
}
