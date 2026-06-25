<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Participant;
use App\Models\QurbanCategory;
use App\Models\ParticipantTarget;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Hash;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Users
        $admin = User::create([
            'name' => 'Administrator Masjid',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $pimpinan = User::create([
            'name' => 'H. Muhammad Dahlan (Ketua Masjid)',
            'email' => 'pimpinan@gmail.com',
            'username' => 'pimpinan',
            'password' => Hash::make('password'),
            'role' => 'pimpinan',
        ]);

        // 2. Kategori Qurban
        $kambing = QurbanCategory::create([
            'kode_kategori' => 'KMB',
            'nama_kategori' => 'Kambing',
            'target_dana' => 3500000.00,
            'keterangan' => 'Tabungan qurban untuk 1 ekor kambing.',
        ]);

        $sapi_idv = QurbanCategory::create([
            'kode_kategori' => 'SP-IND',
            'nama_kategori' => 'Sapi Perorangan',
            'target_dana' => 25000000.00,
            'keterangan' => 'Tabungan qurban untuk 1 ekor sapi secara individu/mandiri.',
        ]);

        $sapi_grp = QurbanCategory::create([
            'kode_kategori' => 'SP-KEL',
            'nama_kategori' => 'Sapi Kelompok (1/7)',
            'target_dana' => 3500000.00,
            'keterangan' => 'Tabungan qurban patungan sapi kelompok (1 dari 7 bagian).',
        ]);

        // 3. Peserta (Participants)
        $p1 = Participant::create([
            'nik' => '1401010101700001',
            'nama' => 'Ahmad Yani',
            'alamat' => 'Jl. Sungai Perupuk No. 12, Kel. Sungai Perupuk',
            'no_hp' => '081234567890',
            'jenis_kelamin' => 'L',
            'tanggal_daftar' => '2026-01-15',
            'status' => 'aktif',
        ]);

        $p2 = Participant::create([
            'nik' => '1401010101700002',
            'nama' => 'Siti Aminah',
            'alamat' => 'Jl. Merdeka No. 45, Kel. Sungai Perupuk',
            'no_hp' => '082187654321',
            'jenis_kelamin' => 'P',
            'tanggal_daftar' => '2026-01-20',
            'status' => 'aktif',
        ]);

        $p3 = Participant::create([
            'nik' => '1401010101700003',
            'nama' => 'Hendra Wijaya',
            'alamat' => 'Perumahan Indah Permai Blok C3, Kel. Sungai Perupuk',
            'no_hp' => '085299887766',
            'jenis_kelamin' => 'L',
            'tanggal_daftar' => '2026-02-05',
            'status' => 'aktif',
        ]);

        $p4 = Participant::create([
            'nik' => '1401010101700004',
            'nama' => 'Rahmat Hidayat',
            'alamat' => 'Kawasan Pasar Pagi, Kel. Sungai Perupuk',
            'no_hp' => '081344556677',
            'jenis_kelamin' => 'L',
            'tanggal_daftar' => '2026-02-10',
            'status' => 'aktif',
        ]);

        $p5 = Participant::create([
            'nik' => '1401010101700005',
            'nama' => 'Dewi Lestari',
            'alamat' => 'Jl. Melati RT 04 RW 02, Kel. Sungai Perupuk',
            'no_hp' => '082266778899',
            'jenis_kelamin' => 'P',
            'tanggal_daftar' => '2026-02-15',
            'status' => 'nonaktif',
        ]);

        // 4. Target Qurban Peserta (Participant Targets)
        ParticipantTarget::create([
            'participant_id' => $p1->id,
            'category_id' => $sapi_grp->id,
            'target_dana' => 3500000.00,
            'tahun_qurban' => 2026,
        ]);

        ParticipantTarget::create([
            'participant_id' => $p2->id,
            'category_id' => $kambing->id,
            'target_dana' => 3500000.00,
            'tahun_qurban' => 2026,
        ]);

        ParticipantTarget::create([
            'participant_id' => $p3->id,
            'category_id' => $sapi_idv->id,
            'target_dana' => 25000000.00,
            'tahun_qurban' => 2026,
        ]);

        ParticipantTarget::create([
            'participant_id' => $p4->id,
            'category_id' => $sapi_grp->id,
            'target_dana' => 3500000.00,
            'tahun_qurban' => 2026,
        ]);

        // 5. Setoran Tabungan (Deposits)
        // Ahmad Yani deposits
        Deposit::create([
            'participant_id' => $p1->id,
            'tanggal' => '2026-02-01',
            'jumlah' => 1000000.00,
            'keterangan' => 'Setoran awal tabungan qurban sapi kelompok',
            'user_id' => $admin->id,
        ]);
        Deposit::create([
            'participant_id' => $p1->id,
            'tanggal' => '2026-03-01',
            'jumlah' => 500000.00,
            'keterangan' => 'Setoran bulanan Maret',
            'user_id' => $admin->id,
        ]);
        Deposit::create([
            'participant_id' => $p1->id,
            'tanggal' => '2026-04-01',
            'jumlah' => 500000.00,
            'keterangan' => 'Setoran bulanan April',
            'user_id' => $admin->id,
        ]);

        // Siti Aminah deposits
        Deposit::create([
            'participant_id' => $p2->id,
            'tanggal' => '2026-02-10',
            'jumlah' => 1500000.00,
            'keterangan' => 'Setoran pertama qurban kambing',
            'user_id' => $admin->id,
        ]);
        Deposit::create([
            'participant_id' => $p2->id,
            'tanggal' => '2026-03-15',
            'jumlah' => 1000000.00,
            'keterangan' => 'Setoran kedua',
            'user_id' => $admin->id,
        ]);

        // Hendra Wijaya deposits
        Deposit::create([
            'participant_id' => $p3->id,
            'tanggal' => '2026-02-15',
            'jumlah' => 5000000.00,
            'keterangan' => 'Setoran awal qurban sapi individu',
            'user_id' => $admin->id,
        ]);

        // Rahmat Hidayat deposits
        Deposit::create([
            'participant_id' => $p4->id,
            'tanggal' => '2026-03-01',
            'jumlah' => 3500000.00,
            'keterangan' => 'Setoran lunas qurban sapi kelompok',
            'user_id' => $admin->id,
        ]);

        // 6. Penarikan Dana (Withdrawals)
        // Siti Aminah pulls some money
        Withdrawal::create([
            'participant_id' => $p2->id,
            'tanggal' => '2026-04-10',
            'jumlah' => 500000.00,
            'alasan' => 'Keperluan mendesak keluarga',
            'user_id' => $admin->id,
        ]);
    }
}