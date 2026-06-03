<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // Menampilkan halaman laporan keuangan salon
    public function index(Request $request): View
    {
        // Ambil filter tanggal dari input form
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

        // Ambil data transaksi berdasarkan rentang tanggal
        $transactions = Transaction::with(['reservation.user'])
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('status', 'paid') 
            ->orderBy('created_at', 'asc')
            ->get();

        // Hitung Jumlah transaksi dan total omzet pendapatan salon
        $totalTransactions = $transactions->count();
        $totalRevenue = $transactions->sum('total_price');

        // Hitung Tipe Transaksi
        $totalReservations = $transactions->whereNotNull('id_reservation')->count();
        $totalWalkIn = $transactions->whereNull('id_reservation')->count();

        //  Ambil 5 Layanan Terlaris
        $topServices = DB::table('transaction_details')
            ->join('transactions', 'transaction_details.id_transaction', '=', 'transactions.id_transaction')
            ->join('services', 'transaction_details.id_service', '=', 'services.id_service')
            ->select(
                'services.name', 
                DB::raw('COUNT(transaction_details.id_service) as total_sold'), 
                DB::raw('SUM(transaction_details.price_at_purchase) as revenue')
            )
            ->whereBetween('transactions.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('transactions.status', 'paid')
            ->groupBy('services.id_service', 'services.name')
            
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        return view('admin.report.index', compact(
            'transactions',
            'startDate',
            'endDate',
            'totalTransactions',
            'totalRevenue',
            'totalReservations',
            'totalWalkIn',
            'topServices'
        ));
    }
}