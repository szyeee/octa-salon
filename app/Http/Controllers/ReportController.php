<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // filter dari input form
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());
        $type = $request->input('type', 'all'); 

        // Query dasar berdasarkan tanggal dan status paid
        $query = Transaction::with(['reservation.user', 'transactionDetails.service']) 
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->where('status', 'paid');

        //logika filter tipe transaksi terpisah pesanan Dosen
        if ($type === 'app') {
            $query->whereNotNull('id_reservation');
        } elseif ($type === 'walkin') {
            $query->whereNull('id_reservation');
        }

        $transactions = $query->orderBy('created_at', 'asc')->get();

        // Hitung statistik ringkasan
        $totalTransactions = $transactions->count();
        $totalRevenue = $transactions->sum('total_price');
        $totalReservations = $transactions->whereNotNull('id_reservation')->count();
        $totalWalkIn = $transactions->whereNull('id_reservation')->count();

        // Ambil 5 Layanan Terlaris
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

        // LOGIKA EXPORT EXCEL (Jika tombol export diklik)
        if ($request->has('export') && $request->input('export') == 'excel') {
            $filename = "Octa_Salon_Report_" . $startDate . "_to_" . $endDate . ".xls";
            
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Pragma: no-cache");
            header("Expires: 0");

            return view('admin.report.excel', compact('transactions', 'startDate', 'endDate', 'totalRevenue', 'totalTransactions', 'type'));
        }

        return view('admin.report.index', compact(
            'transactions',
            'startDate',
            'endDate',
            'type', 
            'totalTransactions',
            'totalRevenue',
            'totalReservations',
            'totalWalkIn',
            'topServices'
        ));
    }
}