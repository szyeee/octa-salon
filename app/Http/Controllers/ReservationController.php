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
    public function index(): View
    {
        // Mengambil data reservasi beserta relasi user dan service
        $reservations = Reservation::with(['user', 'service'])
                                    ->orderBy('date', 'desc')
                                    ->orderBy('time', 'asc')
                                    ->paginate(10);

        return view('reservations.index', compact('reservations'));
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

        return view('reservations.create', compact('services', 'availableSlots'));
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
        return view('reservations.show', compact('reservation'));
    }

    // Mengubah status reservasi (Oleh Admin, misal: Confirmed / Cancelled / Done)
    public function updateStatus(Request $request, Reservation $reservation): RedirectResponse
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,arrived,absent,done',
        ]);

        DB::transaction(function () use ($validatedData, $reservation) {
            $statusBaru = $validatedData['status'];

            // Jika batal (cancelled) atau customer tidak datang (absent), bebaskan lagi slot waktunya
            if ($statusBaru === 'cancelled' || $statusBaru === 'absent') {
                $reservation->slots()->update(['status' => 'available']);
            }
            // Jika statusnya pending, confirmed, arrived, atau done, slot tetap terkunci (booked)
            else {
                $reservation->slots()->update(['status' => 'booked']);
            }

            // Jika status diubah ke 'done', otomatis buat data transaksi keuangan
            if ($statusBaru === 'done') {
                // Ambil harga dari layanan yang dipilih pada reservasi
                $totalHarga = $reservation->service->price;

                // Cek dulu untuk memastikan data transaksi ini belum pernah dibuat sebelumnya untuk mencegah double input
                $cekTransaksi = Transaction::where('id_reservation', $reservation->id_reservation)->exists();

                if (!$cekTransaksi) {
                    Transaction::create([
                        'id_reservation' => $reservation->id_reservation,
                        'total_price'    => $totalHarga,
                        'payment_status' => 'paid', // Otomatis diset lunas setelah statusnya done
                    ]);
                }
            }

            // Update status reservasi
            $reservation->update(['status' => $statusBaru]);
        });

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
}
