<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

// Controller untuk manajemen data pengguna oleh Admin
class UserController extends Controller
{
    // Menampilkan daftar semua pengguna
    public function index(): View
    {
        $users = User::latest()->paginate(15);
        return view('users.index', compact('users'));
    }

    // Menampilkan form tambah pengguna baru
    public function create(): View
    {
        return view('users.create');
    }

    // Menyimpan pengguna baru ke database
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
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

        return redirect()->route('users.index')
                         ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    // Menampilkan detail pengguna tertentu
    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    // Menampilkan form edit pengguna
    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    // Memperbarui informasi pengguna
    public function update(Request $request, User $user): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                Rule::unique('users')->ignore($user->id), // Mengabaikan email milik user ini sendiri saat update
            ],
            'nomor_telepon' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
        ]);

        $updateData = [
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'nomor_telepon' => $validatedData['nomor_telepon'],
            'is_admin' => $validatedData['is_admin'],
        ];

        // Update password hanya jika form password diisi oleh admin
        if (!empty($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($updateData);

        return redirect()->route('users.index')
                         ->with('success', 'Profil pengguna berhasil diperbarui!');
    }

    // Menghapus pengguna dari database
    public function destroy(User $user): RedirectResponse
    {
        // Fitur pengaman untuk cek relasi ke tabel reservations
        if ($user->reservations()->exists()) {
            return redirect()->route('users.index')
                ->with('error', 'Pengguna tidak dapat dihapus karena memiliki riwayat reservasi di Salon Octa.');
        }

        // Jika tidak punya riwayat reservasi, aman untuk dihapus
        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'Pengguna berhasil dihapus!');
    }
}
