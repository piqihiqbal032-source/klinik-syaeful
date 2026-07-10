<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ProfilKlinik;
use App\Models\LayananMedis;
use App\Models\JadwalDokter;
use App\Models\KontakKlinik;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
       // 1. Admin
       User::create([
           'name' => 'Administrator Klinik',  // ← ini kolom 'name', bukan 'username'
           'email' => 'admin@klinik.com',
           'password' => Hash::make('password123'),
]);

        // 2. Profil Klinik
        ProfilKlinik::create([
            'sejarah_singkat' => 'Klinik Syaeful Majid Medika didirikan pada tahun 2017 dengan tujuan memberikan pelayanan kesehatan yang dekat dan terjangkau bagi masyarakat Kecamatan Cimanggu dan sekitarnya.',
            'visi_misi' => 'Visi: Menjadi klinik kesehatan terpercaya yang memberikan pelayanan prima bagi masyarakat.\n\nMisi:\n1) Menyediakan pelayanan kesehatan yang berkualitas\n2) Meningkatkan akses layanan kesehatan\n3) Memberikan edukasi kesehatan kepada masyarakat',
            'struktur_organisasi' => 'Ketua Yayasan: KH. Syaeful Majid Darkino\nKepala Klinik: Dr. [Nama Dokter]\nKoordinator Admin: Amelia Kusniawati',
            'nomor_izin' => 'SK-1234/Dinkes/Cilacap/2026',
        ]);

        // 3. Layanan Medis (11 layanan)
        $layanan = [
            ['nama_layanan' => 'IGD 24 Jam', 'deskripsi' => 'Pelayanan gawat darurat 24 jam setiap hari.', 'status_aktif' => 'aktif'],
            ['nama_layanan' => 'Rawat Jalan', 'deskripsi' => 'Pelayanan rawat jalan untuk berbagai keluhan kesehatan.', 'status_aktif' => 'aktif'],
            ['nama_layanan' => 'Rawat Inap', 'deskripsi' => 'Fasilitas rawat inap dengan kamar yang nyaman.', 'status_aktif' => 'aktif'],
            ['nama_layanan' => 'Laboratorium', 'deskripsi' => 'Pemeriksaan laboratorium klinik lengkap.', 'status_aktif' => 'aktif'],
            ['nama_layanan' => 'EKG', 'deskripsi' => 'Pemeriksaan rekam jantung (Elektrokardiogram).', 'status_aktif' => 'aktif'],
            ['nama_layanan' => 'KB Suntik & Implan', 'deskripsi' => 'Layanan keluarga berencana dengan metode suntik dan implan.', 'status_aktif' => 'aktif'],
            ['nama_layanan' => 'Bedah Minor', 'deskripsi' => 'Tindakan bedah kecil untuk penanganan luka dan tumor kecil.', 'status_aktif' => 'aktif'],
            ['nama_layanan' => 'Khitan', 'deskripsi' => 'Pelayanan sunat/sirkumsisi dengan metode modern.', 'status_aktif' => 'aktif'],
            ['nama_layanan' => 'Swab Antigen', 'deskripsi' => 'Tes cepat Covid-19 dengan metode swab antigen.', 'status_aktif' => 'aktif'],
            ['nama_layanan' => 'Home Care', 'deskripsi' => 'Pelayanan kesehatan di rumah pasien.', 'status_aktif' => 'aktif'],
            ['nama_layanan' => 'Antar Jemput Pasien', 'deskripsi' => 'Layanan antar jemput pasien untuk kemudahan akses.', 'status_aktif' => 'aktif'],
        ];

        foreach ($layanan as $item) {
            LayananMedis::create($item);
        }

        // 4. Jadwal Dokter
        $jadwal = [
            ['nama_dokter' => 'Dr. Ahmad Farid, Sp.PD', 'hari_praktik' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'status' => 'aktif'],
            ['nama_dokter' => 'Dr. Ahmad Farid, Sp.PD', 'hari_praktik' => 'Rabu', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00', 'status' => 'aktif'],
            ['nama_dokter' => 'Dr. Siti Rahma, Sp.A', 'hari_praktik' => 'Selasa', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'status' => 'aktif'],
            ['nama_dokter' => 'Dr. Siti Rahma, Sp.A', 'hari_praktik' => 'Kamis', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00', 'status' => 'aktif'],
            ['nama_dokter' => 'Dr. Budi Santoso', 'hari_praktik' => 'Jumat', 'jam_mulai' => '08:00', 'jam_selesai' => '14:00', 'status' => 'aktif'],
        ];

        foreach ($jadwal as $item) {
            JadwalDokter::create($item);
        }

        // 5. Kontak Klinik
        KontakKlinik::create([
            'alamat_lengkap' => 'RT.03/RW.01, Pesahangan, Kecamatan Cimanggu, Kabupaten Cilacap, Jawa Tengah',
            'nomor_telepon' => '0812-3456-7890',
            'email' => 'info@klinik-syaeful.com',
            'media_sosial' => 'https://instagram.com/kliniksyaeful',
            'link_peta' => 'https://maps.google.com/?q=RT.03/RW.01+Pesahangan+Cimanggu+Cilacap',
        ]);
    }
}