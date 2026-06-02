<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\SlotTime;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;


class ReservationController extends Controller
{
    // Menampilkan daftar reservasi
    public function index()
    {
        $allReservations = \App\Models\Reservation::all();
        $allReservations = $allReservations->sortBy('date')->sortBy('time');

        // Tab 1: Khusus yang masih PENDING
        $pendingReservations = $allReservations->where('status', 'pending');

        // Tab 2: Khusus yang AKTIF HARI-H (CONFIRMED atau ARRIVED)
        $activeReservations = $allReservations->whereIn('status', ['confirmed', 'arrived']);

        // Tab 3: Khusus RIWAYAT ADMIN (DONE, CANCELLED, ABSENT)
        $historyReservations = $allReservations->whereIn('status', ['done', 'cancelled', 'absent']);

        return view('admin.reservations.index', compact('pendingReservations', 'activeReservations', 'historyReservations'));
    }

    // Menampilkan form booking baru untuk customer atau admin bisa buatkan untuk customer
    public function create(): View
    {
        $services = Service::all();

        // Hanya menampilkan slot waktu yang statusnya masih 'available' (belum dibooking)
        $availableSlots = SlotTime::where('status', 'available')
                                   ->where('date', '>=', now()->toDateString())
                                   ->orderBy('date', 'asc')
                                   ->orderBy('start_time', 'asc')
                                   ->get();

        return view('admin.reservations.create', compact('services', 'availableSlots'));
    }

    // Menyimpan data booking baru
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_service' => 'required|exists:services,id_service',
            'slots' => 'required|array|min:1',          // Menerima array ID slot yang dipilih (bisa lebih dari 1)
            'slots.*' => 'required|exists:slot_times,id_slot',
        ]);

        DB::transaction(function () use ($validatedData, $request) {

            // Gunakan data slot pertama yang dipilih sebagai acuan waktu reservasi
            $firstSlot = SlotTime::findOrFail($validatedData['slots'][0]);

            // insert ke tabel reservations
            $reservation = Reservation::create([
                'date' => $firstSlot->date,
                'time' => $firstSlot->start_time,
                'status' => 'pending', // Default status awal
                'id_user' => auth()->id() ?? $request->id_user, // Mengambil ID user yang login
                'id_service' => $validatedData['id_service'],
            ]);

            // Hubungkan data ke tabel jembatan 'reservation_slots'
            $reservation->slots()->attach($validatedData['slots']);

            // Ubah status slot_times yang sudah dipilih menjadi 'booked'
            SlotTime::whereIn('id_slot', $validatedData['slots'])->update([
                'status' => 'booked'
            ]);
        });

        return redirect()->route('reservations.index')
                         ->with('success', 'Reservasi Salon Octa berhasil dibuat! Menunggu konfirmasi admin.');
    }

    // Menampilkan detail reservasi berdasarkan ID
    public function show(Reservation $reservation): View
    {
        $reservation->load('slots');
        return view('admin.reservations.show', compact('reservation'));
    }

    // Mengubah status reservasi (Oleh Admin, misal: Confirmed / Cancelled / Done)
    public function updateStatus(Request $request, Reservation $reservation): RedirectResponse
    {
        $id_reservation = $request->route('id_reservation');

        $request->validate([
            'status_alur' => 'required|in:pending,confirmed,cancelled,arrived,absent,done'
        ]);

        $reservation = \App\Models\Reservation::where('id_reservation', $id_reservation)->first();

        if (!$reservation) {
            return redirect()->back()->with('error', 'Data reservasi dengan ID ' . $id_reservation . ' tidak ditemukan!');
        }

        $reservation->status = $request->status_alur;
        $reservation->save();

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui!');
    }

    // Menghapus data reservasi
    public function destroy(Reservation $reservation): RedirectResponse
    {
        DB::transaction(function () use ($reservation) {
            // Sebelum dihapus, kembalikan semua slot yang dipakai menjadi 'available' lagi
            $reservation->slots()->update(['status' => 'available']);
            $reservation->delete();
        });

        return redirect()->route('reservations.index')
                         ->with('success', 'Data reservasi berhasil dihapus!');
    }

    public function bookingHistory()
    {
        $userId = auth()->id();

        // Ambil data Reservasi Tunggu Konfirmasi admin (Pending)
        $pendingReservations = Reservation::where('id_user', $userId)
            ->where('status', 'pending')
            ->latest()
            ->get();

        // Ambil data Reservasi yang Sudah Dikonfirmasi (Confirmed )
        $confirmedReservations = Reservation::where('id_user', $userId)
            ->whereIn('status', ['confirmed', 'arrived'])
            ->latest()
            ->get();

        //  Ambil data Reservasi Selesai / Gagal (Done, Cancelled, Absent)
        $completedReservations = Reservation::where('id_user', $userId)
            ->whereIn('status', ['done', 'cancelled', 'absent'])
            ->latest()
            ->get();

        return view('customer.history', compact('pendingReservations', 'confirmedReservations', 'completedReservations'));
    }
}
