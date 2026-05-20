<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Transaction;

// Controller untuk manajemen data pengguna oleh Admin
class UserController extends Controller
{
    // Menampilkan daftar semua pengguna
    public function dashboard()
    {
        $users = User::all();

        // Hitung total reservasi dan services
        $totalReservations = Reservation::count();
        $totalServices = Service::count();

        // Hitung total transaksi
        $totalRevenue = Transaction::sum('amount');

        return view('admin.dashboard', compact('users', 'totalReservations', 'totalServices', 'totalRevenue'));
    }

    public function index():View
    {
        $customers = User::where('is_admin', false)->latest()->get();

        return view('admin.customers', compact('customers'));
    }

    // Menampilkan form tambah pengguna baru
    public function create(): View
    {
        return view('admin.customers.create');
    }

    // Menyimpan pengguna baru ke database
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'nomor_telepon' => 'nullable|string|max:20',
            'is_admin' => 'required|boolean',
        ]);

        User::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'nomor_telepon' => $validatedData['nomor_telepon'],
            'is_admin' => $validatedData['is_admin'],
        ]);

        return redirect()->route('admin.customers.index')
                         ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // Menampilkan detail pengguna tertentu
    public function show(User $user): View
    {
        return view('admin.customers', compact('user'));
    }

    // Menampilkan form edit pengguna
    public function edit($id): View
    {
        $customer = User::findOrFail($id);
        return view('admin.editCustomers', compact('customer'));
    }

    // Memperbarui informasi pengguna
    public function update(Request $request, $id): RedirectResponse
    {
        $customer = User::findOrFail($id);

        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                Rule::unique('users')->ignore($customer->id),
            ],
            'nomor_telepon' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $updateData = [
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'nomor_telepon' => $validatedData['nomor_telepon'],
        ];

        // Update password hanya jika form password diisi oleh admin
        if (!empty($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        $customer->update($updateData);

        return redirect('/admin/customers')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    // Menghapus pengguna dari database
    public function destroy($id): RedirectResponse
    {
        $customer = User::findOrFail($id);

        // Fitur pengaman untuk cek relasi ke tabel reservations
        if ($customer->reservations()->exists()) {
            return redirect('/admin/customers')->with('error', 'Pengguna tidak dapat dihapus karena memiliki riwayat reservasi di Salon Octa.');
        }

        // Jika tidak punya riwayat reservasi, aman untuk dihapus
        $customer->delete();

        return redirect('/admin/customers')->with('success', 'Pengguna berhasil dihapus!');
    }
}
