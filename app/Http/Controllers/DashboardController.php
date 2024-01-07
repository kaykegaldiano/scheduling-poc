<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Schedule;
use App\Models\ScheduleTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'holidays' => Holiday::all(),
            'schedules' => Schedule::all(),
            'scheduleTimes' => ScheduleTime::all()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'schedule_date' => 'required',
            'schedule_hour' => 'required'
        ]);

        $scheduleTime = ScheduleTime::where('schedule_date', $request->schedule_date)
            ->where('schedule_hour', $request->schedule_hour)
            ->exists();

        if ($scheduleTime) {
            return back()->with('error', 'Já existe um agendamento para esta data e hora! Tente um dia ou uma hora diferente!');
        }

        ScheduleTime::create([
            'user_id' => Auth::user()->id,
            'schedule_date' => $request->schedule_date,
            'schedule_hour' => $request->schedule_hour
        ]);

        return back()->with('success', 'Agendamento feito com sucesso!');
    }
}
