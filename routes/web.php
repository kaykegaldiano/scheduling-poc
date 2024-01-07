<?php

use App\Models\Holiday;
use App\Models\Schedule;
use App\Models\ScheduleTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'holidays' => Holiday::all(),
        'schedules' => Schedule::all(),
        'scheduleTimes' => ScheduleTime::all()
    ]);
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/dashboard', function (Request $request): RedirectResponse {
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
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('schedules', ScheduleController::class)->only(['index', 'destroy']);
Route::resource('/holidays', HolidayController::class)->except('show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
