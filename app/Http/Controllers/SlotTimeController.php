<?php

namespace App\Http\Controllers;

use App\Models\SlotTime;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class SlotTimeController extends Controller
{
    public function index(Request $request)
    {
        $searchDate = $request->get('search_date');
        $today = Carbon::today()->format('Y-m-d');

        $query = SlotTime::query();

        // Jika admin pakai fitur Search Tanggal
        if ($searchDate) {
            $query->whereRaw("DATE(date) = ?", [Carbon::parse($searchDate)->format('Y-m-d')]);
            $slots = $query->orderBy('start_time', 'asc')->paginate(10);
        } else {
            // Tampilan mengurutkan agar tanggal hari ini/mendatang muncul duluan (ASC), baru tanggal masa lalu di bawahnya
            $slots = $query->orderByRaw("
                CASE 
                    WHEN DATE(date) >= '{$today}' THEN 1 
                    ELSE 2 
                END ASC
            ")
            ->orderBy('date', 'asc') 
            ->orderBy('start_time', 'asc')
            ->paginate(10);
        }

        return view('admin.slot.index', compact('slots', 'searchDate'));
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

   public function destroy(SlotTime $slotTime): RedirectResponse
    {
        $slotTime->reservations()->detach();
        $slotTime->delete();
        
        return redirect('/admin/slot')->with('success', 'Time slot successfully deleted!');
    }

    public function generateSlots(Request $request): RedirectResponse
    {
        // Normalisasi input titik (.) menjadi titik dua (:) jika admin mengetik manual
        if ($request->has('start_time')) {
            $request->merge(['start_time' => str_replace('.', ':', $request->start_time)]);
        }
        if ($request->has('done_time')) {
            $request->merge(['done_time' => str_replace('.', ':', $request->done_time)]);
        }

        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|date_format:H:i',
            'done_time'  => 'required|date_format:H:i|after:start_time',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate   = Carbon::parse($request->end_date);
        
        $startTime = $request->start_time;
        $doneTime  = $request->done_time;

        $generatedCount = 0;
        $skippedCount = 0;

        // Looping hari demi hari dari rentang tanggal yang dipilih
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $currentDateStr = $date->format('Y-m-d');

            // Cek apakah tanggal ini sudah diatur jam operasionalnya di database
            $exists = SlotTime::where('date', $currentDateStr)->exists();

            if (!$exists) {
                // Buat SATU blok jam operasional utuh untuk hari tersebut
                SlotTime::create([
                    'date'       => $currentDateStr,
                    'start_time' => $startTime,
                    'done_time'  => $doneTime,
                    'status'     => 'available', // Tersedia untuk menerima booking komulatif
                ]);
                $generatedCount++;
            } else {
                $skippedCount++;
            }
        }

        $msg = "Berhasil membuat jam operasional untuk $generatedCount hari.";
        if ($skippedCount > 0) {
            $msg .= " ($skippedCount hari dilewati karena sudah memiliki pengaturan jadwal).";
        }

        return redirect('admin/slot')->with('success', $msg);
    }
}
