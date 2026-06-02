<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalReservations = Reservation::count();
        $totalServices = Service::count();
        $totalRevenue = Transaction::sum('total_price');

        return view('admin.dashboard', compact(
            'totalReservations',
            'totalServices',
            'totalRevenue'
        ));
    }
}