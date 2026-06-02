<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\SlotTime; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function history()
    {
        $userId = auth()->id();

        // Ambil data reservasi berdasarkan status masing-masing
        // Menunggu Konfirmasi
        $pendingReservations = Reservation::where('id_user', $userId)
            ->where('status', 'pending')
            ->latest()
            ->get();

        // Dikonfirmasi & Datang (D-Day)
        $confirmedReservations = Reservation::where('id_user', $userId)
            ->whereIn('status', ['confirmed', 'arrived'])
            ->latest()
            ->get();

        // Selesai, Batal, & Absen (Riwayat Masa Lalu)
        $completedReservations = Reservation::where('id_user', $userId)
            ->whereIn('status', ['done', 'cancelled', 'absent'])
            ->latest()
            ->get();

        return view('booking.history', compact(
            'pendingReservations', 
            'confirmedReservations', 
            'completedReservations'
        ));
    }

    // FORM BOOKING CUSTOMER
    public function create($id, Request $request)
    {
        $service = Service::where('id_service', $id)->firstOrFail();
        $duration = $service->duration; 

        $dateParam = $request->get('date');
        $selectedDate = $dateParam ? Carbon::parse($dateParam)->format('Y-m-d') : Carbon::today()->format('Y-m-d');

        $operationalSlot = SlotTime::whereRaw("DATE(date) = ?", [$selectedDate])->first();

        $availableTimes = [];

        if ($operationalSlot) {
            
            // Cek jika status slot ditutup manual oleh admin
            if (isset($operationalSlot->status) && strtolower($operationalSlot->status) === 'closed') {
                return view('booking.create', compact('service', 'selectedDate', 'availableTimes'));
            }

            $startTime = Carbon::parse($operationalSlot->start_time);
            $endTime = Carbon::parse($operationalSlot->done_time);

            // Ambil semua reservasi aktif di tanggal ini agar tidak bentrok
            $existingReservations = Reservation::whereDate('date', $selectedDate)
                ->whereIn('status', ['pending', 'Confirmed', 'Arrived']) 
                ->get();

            // Loop generator opsi jam per 30 menit menyesuaikan durasi layanan
            while ($startTime->clone()->addMinutes($duration)->lte($endTime)) {
                $timeString = $startTime->format('H:i');
                $potentialEndTime = $startTime->clone()->addMinutes($duration);

                $isBentrok = false;
                foreach ($existingReservations as $res) {
                    $resStart = Carbon::parse($res->time);
                    
                    $resService = Service::find($res->id_service);
                    $resEnd = $resStart->clone()->addMinutes($resService->duration ?? 60);

                    // Rumus validasi overlap rentang waktu pengerjaan agar tidak tabrakan
                    if ($startTime->lt($resEnd) && $potentialEndTime->gt($resStart)) {
                        $isBentrok = true;
                        break;
                    }
                }

                if (!$isBentrok) {
                    $availableTimes[] = $timeString;
                }

                // Geser opsi pilihan waktu mulai booking berikutnya per 30 menit
                $startTime->addMinutes(30); 
            }
        }

        return view('booking.create', compact('service', 'selectedDate', 'availableTimes'));
    }

    // PROSES SIMPAN BOOKING KE DATABASE 
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required',
            'date'       => 'required|date|after_or_equal:today',
            'time'       => 'required'
        ]);

        // Ambil data service untuk menghitung durasi secara real-time
        $service = Service::where('id_service', $request->service_id)->firstOrFail();
        $duration = $service->duration;

        $bookingStartTime = Carbon::parse($request->time);
        $bookingEndTime = $bookingStartTime->clone()->addMinutes($duration);

        // Validasi Lapisan Kedua: Pastikan tidak diserobot oleh user lain di detik yang sama
        $existingReservations = Reservation::whereDate('date', $request->date)
            ->whereIn('status', ['pending', 'Confirmed', 'Arrived'])
            ->get();

        foreach ($existingReservations as $res) {
            $resStart = Carbon::parse($res->time);
            $resService = Service::find($res->id_service);
            $resEnd = $resStart->clone()->addMinutes($resService->duration ?? 60);

            if ($bookingStartTime->lt($resEnd) && $bookingEndTime->gt($resStart)) {
                return redirect()->back()->with('error', 'Maaf, jam tersebut baru saja di-booking oleh pelanggan lain. Silakan pilih jam atau hari lain!');
            }
        }

        // Jika kondisi aman dan tidak bentrok, buat data reservasi baru
        Reservation::create([
            'id_service' => $request->service_id,
            'id_user'    => Auth::id(),
            'date'       => $request->date,
            'time'       => $request->time,
            'status'     => 'pending'
        ]);

        return redirect('/appointments')->with('success', 'Booking berhasil dibuat! Menunggu konfirmasi admin.');
    }
}