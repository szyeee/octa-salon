<?php

namespace App\Http\Controllers;

use App\Models\SlotTime;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SlotTimeController extends Controller
{
    // Menampilkan semua daftar slot waktu
    public function index(): View
    {
        // Menampilkan slot dari tanggal paling baru, 15 data per halaman
        $slots = SlotTime::orderBy('date', 'desc')
                         ->orderBy('start_time', 'asc')
                         ->paginate(15);

        return view('slot_times.index', compact('slots'));
    }

    // Menampilkan form tambah slot waktu baru (Oleh Admin)
    public function create(): View
    {
        return view('slot_times.create');
    }

    // Menyimpan slot waktu baru ke database
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'date' => 'required|date|after_or_equal:today', // Slot tidak boleh dibuat untuk tanggal kemarin
            'start_time' => 'required|date_format:H:i',
            'done_time' => 'required|date_format:H:i|after:start_time', // Jam selesai harus setelah jam mulai
            'status' => 'required|in:available,booked',
        ]);

        SlotTime::create([
            'date' => $validatedData['date'],
            'start_time' => $validatedData['start_time'],
            'done_time' => $validatedData['done_time'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('slot-times.index')
                         ->with('success', 'Slot waktu baru berhasil ditambahkan!');
    }

    // Menampilkan form edit status/jam slot
    public function edit(SlotTime $slotTime): View
    {
        return view('slot_times.edit', compact('slotTime'));
    }

    // Memperbarui data slot waktu
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

        return redirect()->route('slot-times.index')
                         ->with('success', 'Slot waktu berhasil diperbarui!');
    }

    // Menghapus slot waktu
    public function destroy(SlotTime $slotTime): RedirectResponse
    {
        // Cek relasi Many-to-Many ke tabel reservations()
        if ($slotTime->reservations()->exists()) {
            return redirect()->route('slot-times.index')
                ->with('error', 'Slot tidak bisa dihapus karena sudah dibooking oleh customer dalam transaksi reservasi.');
        }

        $slotTime->delete();

        return redirect()->route('slot-times.index')
                         ->with('success', 'Slot waktu berhasil dihapus!');
    }
}
