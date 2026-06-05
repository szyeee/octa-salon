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
    // Tampilkan Halaman Utama POS Kasir
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
    
    // Proses Pembayaran Walk-In / Transaksi Langsung di Kasir
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'services'      => 'required|array|min:1',
            'services.*'    => 'required|exists:services,id_service',
            'amount_paid'   => 'required|numeric|min:0', 
        ]);

        // Hitung total harga asli berdasarkan database
        $grandTotal = 0;
        foreach ($request->services as $idService) {
            $service = Service::findOrFail($idService);
            $grandTotal += $service->price;
        }

        // Ambil nominal bayar dan konversi ke Integer murni untuk PostgreSQL
        $cleanAmountPaid = (int) $request->amount_paid;
        $cleanGrandTotal = (int) $grandTotal;

        // JIKA UANG KURANG: Tolak balik ke halaman form dengan pesan error
        if ($cleanAmountPaid < $cleanGrandTotal) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['amount_paid' => 'Uang tunai yang dimasukkan kurang! Total tagihan yang harus dibayar adalah Rp ' . number_format($cleanGrandTotal, 0, ',', '.')]);
        }

        $transactionId = null;

        DB::transaction(function () use ($request, $cleanGrandTotal, $cleanAmountPaid, &$transactionId) {
            $transaction = Transaction::create([
                'id_reservation' => null,
                'customer_name'  => $request->customer_name,
                'total_price'    => $cleanGrandTotal, 
                'status'         => 'paid',
                'amount_paid'    => $cleanAmountPaid, // Disimpan sebagai integer bulat bersih
            ]);

            $transactionId = $transaction->id_transaction;

            foreach ($request->services as $idService) {
                $service = Service::findOrFail($idService);

                TransactionDetail::create([
                    'id_transaction'    => $transaction->id_transaction,
                    'id_service'        => $service->id_service,
                    'quantity'          => 1,
                    'price_at_purchase' => (int) $service->price,
                ]);
            }
        });

        return redirect()->route('admin.pos.print', $transactionId)
                         ->with('success', 'Transaksi Walk-In berhasil disimpan!');
    }

    public function show(Transaction $transaction): View
    {
        $transaction->load(['reservation.user', 'details.service']);
        return view('transactions.show', compact('transaction'));
    }

    // Memproses Pembayaran dari Reservasi
    public function processReservationPayment(Request $request, $id_reservation): RedirectResponse
    {
        $reservation = Reservation::with('user')->findOrFail($id_reservation);
        $service = $reservation->service; 

        $request->validate([
            'amount_paid' => 'required|numeric|min:' . $service->price,
        ]);

        // Konversi paksa input uang tunai ke integer murni agar PostgreSQL tidak crash
        $inputUangTunai = (int) $request->input('amount_paid');
        $totalHarga     = (int) $service->price;
        $change         = $inputUangTunai - $totalHarga;

        DB::transaction(function () use ($reservation, $service, $inputUangTunai, $totalHarga) {
            $fixName = $reservation->user->name ?? ($reservation->customer_name ?? 'Pelanggan Reservasi');

            $transaction = Transaction::create([
                'id_reservation' => $reservation->id_reservation,
                'customer_name'  => $fixName,
                'total_price'    => $totalHarga,
                'status'         => 'paid',
                'amount_paid'    => $inputUangTunai, // Disimpan sebagai integer bulat 
            ]);

            TransactionDetail::create([
                'id_transaction'    => $transaction->id_transaction, 
                'id_service'        => $service->id_service,
                'quantity'          => 1,
                'price_at_purchase' => $totalHarga,
            ]);

            $reservation->update([
                'status' => 'done'
            ]);
        });

        $pesanSukses = 'Pembayaran booking berhasil! Status reservasi kini DONE.';
        if ($change > 0) {
            $pesanSukses .= ' Uang Kembalian Pelanggan: Rp ' . number_format($change, 0, ',', '.');
        }

        // Diarahkan langsung ke halaman cetak struk agar kasir bisa mencetak nota reservasi tersebut
        $latestTransaction = Transaction::where('id_reservation', $reservation->id_reservation)->latest()->first();
        if ($latestTransaction) {
            return redirect()->route('admin.pos.print', $latestTransaction->id_transaction)->with('success', $pesanSukses);
        }

        return redirect()->route('admin.pos.index')->with('success', $pesanSukses);
    }

    // Fungsi Cetak Struk Admin POS
    public function print($id_transaction)
    {
        $transaction = Transaction::with(['reservation.user', 'details.service'])->findOrFail($id_transaction);

        // Bungkus kalkulasi data ke format integer agar tampil presisi di struk cetak
        $uangBayar     = (int) ($transaction->amount_paid ?? $transaction->total_price);
        $totalTagihan  = (int) $transaction->total_price;
        $uangKembalian = $uangBayar - $totalTagihan;

        return view('admin.pos.print', compact('transaction', 'uangBayar', 'totalTagihan', 'uangKembalian'));
    }

    // Halaman Preview Struk Customer (Tanpa Tombol Print)
    public function preview($id_transaction)
    {
        $transaction = Transaction::with(['details.service'])->findOrFail($id_transaction);

        // Ambil nominal bayar dari database. Jika kosong, pakai total_price sebagai fallback
        $uangBayar = ($transaction->amount_paid && $transaction->amount_paid > 0) 
                    ? (int) $transaction->amount_paid 
                    : (int) $transaction->total_price;

        $totalTagihan  = (int) $transaction->total_price;
        $uangKembalian = $uangBayar - $totalTagihan;

        return view('booking.preview', compact('transaction', 'uangBayar', 'totalTagihan', 'uangKembalian'));
    }
}