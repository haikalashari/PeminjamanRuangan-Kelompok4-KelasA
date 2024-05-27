<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('peminjaman')->insert([
            [
                'ruangan_id' => 1,
                'mahasiswa_nim' => 'D1041221001',
                'tgl_mulai' => '2024-05-15',
                'tgl_selesai' => '2024-05-15',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:00:00',
                'tujuan' => 'Rapat Himpunan Mahasiswa',
            ],
            [
                'ruangan_id' => 2,
                'mahasiswa_nim' => 'D1041221002',
                'tgl_mulai' => '2024-05-16',
                'tgl_selesai' => '2024-05-16',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '13:00:00',
                'tujuan' => 'Kegiatan Pelatihan Gemastik',
            ],
            [
                'ruangan_id' => 3,
                'mahasiswa_nim' => 'D1041221003',
                'tgl_mulai' => '2024-05-17',
                'tgl_selesai' => '2024-05-17',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '14:00:00',
                'tujuan' => 'Seminar Proposal',
            ],
            [
                'ruangan_id' => 1,
                'mahasiswa_nim' => 'D1041221004',
                'tgl_mulai' => '2024-05-18',
                'tgl_selesai' => '2024-05-18',
                'jam_mulai' => '11:00:00',
                'jam_selesai' => '15:00:00',
                'tujuan' => 'Kelas Tambahan MBD',
            ],
            [
                'ruangan_id' => 2,
                'mahasiswa_nim' => 'D1041221005',
                'tgl_mulai' => '2024-05-19',
                'tgl_selesai' => '2024-05-19',
                'jam_mulai' => '12:00:00',
                'jam_selesai' => '17:00:00',
                'tujuan' => 'Rapat Himpunan Mahasiswa',
            ],
            [
                'ruangan_id' => 1,
                'mahasiswa_nim' => 'D1041221006',
                'tgl_mulai' => '2024-05-20',
                'tgl_selesai' => '2024-05-20',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '15:00:00',
                'tujuan' => 'Sidang Tugas Akhir',
            ],
            [
                'ruangan_id' => 2,
                'mahasiswa_nim' => 'D1041221007',
                'tgl_mulai' => '2024-05-21',
                'tgl_selesai' => '2024-05-21',
                'jam_mulai' => '14:00:00',
                'jam_selesai' => '18:00:00',
                'tujuan' => 'Kelas Pemrograman Lanjut',
            ],
            [
                'ruangan_id' => 3,
                'mahasiswa_nim' => 'D1041221008',
                'tgl_mulai' => '2024-05-22',
                'tgl_selesai' => '2024-05-22',
                'jam_mulai' => '15:00:00',
                'jam_selesai' => '17:00:00',
                'tujuan' => 'Sidang Tugas Akhir',
            ],
            [
                'ruangan_id' => 1,
                'mahasiswa_nim' => 'D1041221009',
                'tgl_mulai' => '2024-05-23',
                'tgl_selesai' => '2024-05-23',
                'jam_mulai' => '16:00:00',
                'jam_selesai' => '18:00:00',
                'tujuan' => 'Sidang Tugas Akhir',
            ],
            [
                'ruangan_id' => 2,
                'mahasiswa_nim' => 'D1041221010',
                'tgl_mulai' => '2024-05-24',
                'tgl_selesai' => '2024-05-24',
                'jam_mulai' => '17:00:00',
                'jam_selesai' => '20:00:00',
                'tujuan' => 'Kegiatan Pelatihan Gemastik',
            ],
        ]);
    }
}
