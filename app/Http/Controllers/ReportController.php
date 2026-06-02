<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    // Menampilkan halaman laporan keuangan salon
    public function index(Request $request): View
    {
        // Ambil filter tanggal dari input form
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        // Ambil data transaksi berdasarkan rentang tanggal yang dipilih
        $transactions = Transaction::whereBetween('payment_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                                    ->where('status', 'paid')
                                    ->orderBy('payment_at', 'asc')
                                    ->get();

        // Hitung Jumlah transaksi dan total omzet pendapatan salon
        $totalTransactions = $transactions->count();
        $totalRevenue = $transactions->sum('total_price');

        return view('reports.index', compact(
            'transactions',
            'startDate',
            'endDate',
            'totalTransactions',
            'totalRevenue'
        ));
    }
}
