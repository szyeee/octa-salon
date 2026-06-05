<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class AutoAbsentReservation extends Command
{
    /**
     * Nama perintah yang akan dipanggil di terminal / scheduler task.
     *
     * @var string
     */
    protected $signature = 'reservation:auto-absent';

    /**
     * Deskripsi singkat kegunaan perintah ini.
     *
     * @var string
     */
    protected $description = 'Mengubah otomatis status pending jadi cancelled dan confirmed jadi absent jika melewati batas waktu';

    /**
     * Eksekusi logika utama perintah otomatisasi.
     */
    public function handle()
    {
        // Ambil waktu sekarang (WIB / sesuai timezone config aplikasi )
        $now = Carbon::now();

        // CARI RESERVASI YANG TELAT (Hari-hari sebelum ini, atau hari ini tapi jamnya sudah lewat)
        $expiredReservations = Reservation::where(function($query) use ($now) {
                $query->where('date', '<', $now->toDateString()) // Menjaring hari-hari sebelumnya yang terlewat
                      ->orWhere(function($q) use ($now) {
                          $q->where('date', $now->toDateString())
                            ->where('time', '<', $now->toTimeString()); // Menjaring hari ini yang jamnya sudah lewat
                      });
            })
            ->whereIn('status', ['pending', 'confirmed']) // Hanya memproses status target
            ->get();

        $countCancel = 0;
        $countAbsent = 0;

        // Memilih LOGIKA BERDASARKAN STATUS RESERVASI
        foreach ($expiredReservations as $reservation) {
            if ($reservation->status == 'pending') {
                // Jika waktu habis dan status masih pending, otomatis digagalkan (Cancelled)
                $reservation->update(['status' => 'cancelled']);
                $countCancel++;
            } elseif ($reservation->status == 'confirmed') {
                // Jika sudah dikonfirmasi admin tapi tidak datang pada jamnya, dianggap Absent
                $reservation->update(['status' => 'absent']);
                $countAbsent++;
            }
        }

        // CETAK LAPORAN HASIL DI TERMINAL (Sangat berguna saat demo presentasi sidang/UAS)
        $this->info("Otomatisasi Sukses: {$countCancel} Data Pending di-Cancel & {$countAbsent} Data Confirmed di-Absent.");

        return Command::SUCCESS;
    }
}