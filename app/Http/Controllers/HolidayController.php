<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index(): View
    {
        return view('holidays.index', [
            'holidays' => Holiday::all()
        ]);
    }

    public function create(): View
    {
        return view('holidays.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'date' => ['required', 'date'],
        ]);

        Holiday::create($validated);

        return back()->with('success', 'Feriado criado com sucesso!');
    }

    public function edit(Holiday $holiday): View
    {
        return view('holidays.edit', [
            'holiday' => $holiday
        ]);
    }

    public function update(Request $request, Holiday $holiday): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'date' => ['required', 'date'],
        ]);

        $holiday->update($validated);

        return back()->with('success', 'Feriado atualizado com sucesso!');
    }

    public function destroy(Holiday $holiday): RedirectResponse
    {
        $holiday->delete();

        return back()->with('success', 'Feriado excluido com sucesso!');
    }
}
