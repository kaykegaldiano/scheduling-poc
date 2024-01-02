<?php

use App\Http\Controllers\HolidayController;
use App\Http\Controllers\ProfileController;
use App\Models\Holiday;
use App\Models\Schedule;
use App\Models\ScheduleTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'holidays' => Holiday::all(),
        'schedules' => Schedule::all(),
        'scheduleTimes' => ScheduleTime::all()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/dashboard', function (Request $request): RedirectResponse {
    $request->validate([
        'schedule_date' => 'required',
        'schedule_hour' => 'required'
    ]);

    ScheduleTime::create([
        'user_id' => Auth::user()->id,
        'schedule_date' => $request->schedule_date,
        'schedule_hour' => $request->schedule_hour
    ]);

    return back()->with('success', 'Agendamento feito com sucesso!');
})->name('dashboard');

Route::get('/holidays', [HolidayController::class, 'index'])->name('holidays.index');
Route::get('/holidays/create', [HolidayController::class, 'create'])->name('holidays.create');
Route::post('/holidays', [HolidayController::class, 'store'])->name('holidays.store');
Route::get('/holidays/{holiday}/edit', [HolidayController::class, 'edit'])->name('holidays.edit');
Route::put('/holidays/{holiday}', [HolidayController::class, 'update'])->name('holidays.update');
Route::delete('/holidays/{holiday}', [HolidayController::class, 'destroy'])->name('holidays.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
