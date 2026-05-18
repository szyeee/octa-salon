<?php

namespace App\Http\Controllers;

use App\Models\Service;

class CustomerController extends Controller
{
    public function catalog()
    {
        $services = Service::all();

        return view('customer.catalog', compact('services'));
    }
}