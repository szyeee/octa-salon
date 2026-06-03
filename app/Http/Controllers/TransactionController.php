<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // 1. Tampilkan Halaman Utama POS Kasir
    public function index(): View
    {
        $queue = Reservation::with(['user', 'service'])
            ->where('status', 'arrived')
            ->whereDoesntHave('transaction')
            ->latest()
            ->get();

        $history = Transaction::with(['details.service', 'reservation.user'])
            ->orderBy('created_at', 'desc')
            ->get(); 

        return view('admin.pos.index', compact('queue', 'history'));
    }

    public function create(): View
    {
        $services = Service::all();
        return view('admin.pos.create', compact('services'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'services'      => 'required|array|min:1',
            'services.*'    => 'required|exists:services,id_service',
        ]);

        DB::transaction(function () use ($request) {
            $transaction = Transaction::create([
                'id_reservation' => null,
                'customer_name'  => $request->customer_name,
                'total_price'    => 0,
                'status'         => 'paid',
            ]);

            $grandTotal = 0;

            foreach ($request->services as $idService) {
                $service = Service::findOrFail($idService);
                $grandTotal += $service->price;

                TransactionDetail::create([
                    'id_transaction'    => $transaction->id_transaction,
                    'id_service'        => $service->id_service,
                    'quantity'          => 1,
                    'price_at_purchase' => $service->price,
                ]);
            }

            $transaction->update(['total_price' => $grandTotal]);
        });

        return redirect()->route('admin.pos.index')
                         ->with('success', 'Transaksi kasir salon berhasil disimpan!');
    }

    public function show(Transaction $transaction): View
    {
        $transaction->load(['reservation.user', 'details.service']);
        return view('transactions.show', compact('transaction'));
    }

    // 2. Memproses Pembayaran dari Antrean Reservasi
    public function processReservationPayment(Request $request, $id_reservation): RedirectResponse
    {
        $reservation = Reservation::with('user')->findOrFail($id_reservation);
        $service = $reservation->service; 

        $request->validate([
            'amount_paid' => 'required|numeric|min:' . $service->price,
        ]);

        DB::transaction(function () use ($reservation, $service) {
            $fixName = $reservation->user->nama ?? ($reservation->customer_name ?? 'Pelanggan Reservasi');

            // Buat nota transaksi
            $transaction = Transaction::create([
                'id_reservation' => $reservation->id_reservation,
                'customer_name'  => $fixName,
                'total_price'    => $service->price,
                'status'         => 'paid',
            ]);

            // Simpan item layanannya
            TransactionDetail::create([
                'id_transaction'    => $transaction->id_transaction, 
                'id_service'        => $service->id_service,
                'quantity'          => 1,
                'price_at_purchase' => $service->price,
            ]);

            $reservation->update([
                'status' => 'done'
            ]);
        });

        return redirect()->route('admin.pos.index')
                         ->with('success', 'Pembayaran booking berhasil! Status reservasi kini DONE.');
    }
}