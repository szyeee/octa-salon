<?php

namespace App\Http\Controllers;

use App\Models\SlotTime;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SlotTimeController extends Controller
{
    public function index(): View
    {
        $slots = SlotTime::orderBy('date', 'asc')
                         ->orderBy('start_time', 'asc')
                         ->paginate(15);

        return view('admin.slot.index', compact('slots'));
    }

    public function create(): View
    {
        return view('admin.slot.create');
    }

    public function store(Request $request): RedirectResponse
    {
        if ($request->has('start_time') && $request->start_time) {
            $request->merge(['start_time' => str_replace('.', ':', $request->start_time)]);
        }
        if ($request->has('done_time') && $request->done_time) {
            $request->merge(['done_time' => str_replace('.', ':', $request->done_time)]);
        }

        $validatedData = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'done_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required',
        ]);

        SlotTime::create([
            'date' => $validatedData['date'],
            'start_time' => $validatedData['start_time'],
            'done_time' => $validatedData['done_time'],
            'status' => $validatedData['status'],
        ]);

        return redirect('admin/slot')->with('success', 'Time slot successfully created!');
    }

    public function edit(SlotTime $slotTime): View
    {
        return view('admin.slot.edit', compact('slotTime'));
    }

    public function update(Request $request, SlotTime $slotTime): RedirectResponse
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'done_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:available,booked',
        ]);

        $slotTime->update([
            'date' => $validatedData['date'],
            'start_time' => $validatedData['start_time'],
            'done_time' => $validatedData['done_time'],
            'status' => $validatedData['status'],
        ]);

        return redirect('admin/slot')->with('success', 'Time slot successfully updated!');
    }

    public function destroy($id)
    {
        // mencari data slot berdasarkan ID Primary Key-nya
        $slot = \App\Models\SlotTime::findOrFail($id);
        $slot->reservations()->detach();
        $slot->delete();
        
        return redirect('/admin/slot')->with('success', 'Time slot successfully deleted!');
    }
}
