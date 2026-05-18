<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // Tampilkan semua riwayat transaksi beserta detailnya
    public function index(): View
    {
        $transactions = Transaction::with(['reservation.user', 'details.service'])
                                    ->orderBy('payment_at', 'desc')
                                    ->paginate(15);

        return view('transactions.index', compact('transactions'));
    }

    // Tampilkan form kasir untuk transaksi langsung/walk-in
    public function create(): View
    {
        $services = Service::all();
        return view('transactions.create', compact('services'));
    }

    // Simpan transaksi baru dari form kasir (walk-in) ke database
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'services'      => 'required|array|min:1',
            'services.*'    => 'required|exists:services,id_service',
        ]);

        DB::transaction(function () use ($request) {
            // Buat kepala nota transaksi baru
            $transaction = Transaction::create([
                'id_reservation' => null,
                'customer_name'  => $request->customer_name,
                'total_price'    => 0,
                'status'         => 'paid',
            ]);

            $grandTotal = 0;

            // Simpan setiap layanan yang dipilih ke detail nota
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

            // Update total harga riil setelah kalkulasi selesai
            $transaction->update(['total_price' => $grandTotal]);
        });

        return redirect()->route('transactions.index')
                         ->with('success', 'Transaksi kasir salon berhasil disimpan!');
    }

    // Tampilkan detail isi nota/struk belanja berdasarkan ID transaksi
    public function show(Transaction $transaction): View
    {
        $transaction->load(['reservation.user', 'details.service']);
        return view('transactions.show', compact('transaction'));
    }
}
