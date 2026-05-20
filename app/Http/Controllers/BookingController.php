<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function history()
    {
        $reservations = Reservation::where('id_user', Auth::id())
            ->latest()
            ->get();

        return view('booking.history', compact('reservations'));
    }

    public function create($id)
    {
        $service = Service::where('id_service', $id)->firstOrFail();

        return view('booking.create', compact('service'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required',
            'date' => 'required',
            'time' => 'required'
        ]);

        $alreadyBooked = Reservation::where('date', $request->date)
            ->where('time', $request->time)
            ->exists();

        if ($alreadyBooked) {

            return back()->withErrors([
                'time' => 'This schedule is already full.'
            ]);

        }

        Reservation::create([

            'id_service' => $request->service_id,

            'id_user' => Auth::id(),

            'date' => $request->date,

            'time' => $request->time,

            'status' => 'pending'

        ]);

        return redirect('/appointments')
            ->with(
                'success',
                'Booking berhasil dibuat'
            );
    }
}