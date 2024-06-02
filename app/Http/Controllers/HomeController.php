<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Ruangan;
use App\Models\Mahasiswa;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        

    }

    public function home()
    {
        if(Auth::user()->admin) {
            try {
                $ruangan = Ruangan::all();
                $peminjaman = Peminjaman::all();
                $mahasiswa = Mahasiswa::all();
                $admin = Admin::all();
                $user = User::all();
                
                $countRuangan = $ruangan->count();
                $countPeminjaman = $peminjaman->count();
                $countMahasiswa = $mahasiswa->count();
                $countAdmin = $admin->count();
                $countUser = $user->count();
                
                // Rata rata peminjaman per ruangan
                $rataPeminjamanRuangan = $countPeminjaman / $countRuangan;
                
                // Rata rata peminjaman per mahasiswa
                $rataPeminjamanMahasiswa = $countPeminjaman / $countMahasiswa;
                
                // Rata rata peminjaman per admin
                $rataPeminjamanAdmin = $countPeminjaman / $countAdmin;
                
                // Rata rata peminjaman per user
                $rataPeminjamanUser = $countPeminjaman / $countUser;
                
                // Rata rata peminjaman ruangan dalam 30 hari terakhir
                $rataPeminjaman30HariTerakhir = Peminjaman::where('created_at', '>=', now()->subDays(30))->count() / Ruangan::count();
                
                // Rata rata peminjaman dalam tahun ini
                $rataPeminjamanTahunIni = Peminjaman::where('created_at', '>=', now()->startOfYear())->count() / Ruangan::count();
                
                // Rata rata peminjaman dalam bulan ini
                $rataPeminjamanBulanIni = Peminjaman::where('created_at', '>=', now()->startOfMonth())->count() / Ruangan::count();
                
                $rataPeminjamanRuangan = number_format($rataPeminjamanRuangan, 2);
                $rataPeminjamanMahasiswa = number_format($rataPeminjamanMahasiswa, 2);
                $rataPeminjamanAdmin = number_format($rataPeminjamanAdmin, 2);
                $rataPeminjamanUser = number_format($rataPeminjamanUser, 2);
                $rataPeminjaman30HariTerakhir = number_format($rataPeminjaman30HariTerakhir, 2);
                $rataPeminjamanTahunIni = number_format($rataPeminjamanTahunIni, 2);
                $rataPeminjamanBulanIni = number_format($rataPeminjamanBulanIni, 2);
                
                $data = [
                    [
                        'title' => 'Jumlah Peminjaman',
                        'icon' => 'bi-cart',
                        'value' => $countPeminjaman,
                    ],
                    [
                        'title' => 'Jumlah Ruangan',
                        'icon' => 'bi-shop',
                        'value' => $countRuangan,
                    ],
                    [
                        'title' => 'Jumlah Mahasiswa',
                        'icon' => 'bi-people',
                        'value' => $countMahasiswa,
                    ],
                    [
                        'title' => 'Jumlah Admin',
                        'icon' => 'bi-people',
                        'value' => $countAdmin,
                    ],
                    [
                        'title' => 'Jumlah User',
                        'icon' => 'bi-people',
                        'value' => $countUser,
                    ],
                    [
                        'title' => 'Rata-rata Peminjaman Ruangan',
                        'icon' => 'bi-currency-dollar',
                        'value' => $rataPeminjamanRuangan,
                    ],
                    [
                        'title' => 'Rata-rata Peminjaman Mahasiswa',
                        'icon' => 'bi-currency-dollar',
                        'value' => $rataPeminjamanMahasiswa,
                    ],
                    [
                        'title' => 'Rata-rata Peminjaman Admin',
                        'icon' => 'bi-currency-dollar',
                        'value' => $rataPeminjamanAdmin,
                    ],
                    [
                        'title' => 'Rata-rata Peminjaman User',
                        'icon' => 'bi-currency-dollar',
                        'value' => $rataPeminjamanUser,
                    ],
                    [
                        'title' => 'Rata-rata Peminjaman 30 Hari Terakhir',
                        'icon' => 'bi-currency-dollar',
                        'value' => $rataPeminjaman30HariTerakhir,
                    ],
                    [
                        'title' => 'Rata-rata Peminjaman Tahun Ini',
                        'icon' => 'bi-currency-dollar',
                        'value' => $rataPeminjamanTahunIni,
                    ],
                    [
                        'title' => 'Rata-rata Peminjaman Bulan Ini',
                        'icon' => 'bi-currency-dollar',
                        'value' => $rataPeminjamanBulanIni,
                    ],
                ];
                
                $peminjamanLimaTerbaru = Peminjaman::latest()->take(5)->get();
                $ruanganLimaTerbaru = Ruangan::latest()->take(5)->get();
                $ruanganPalingBanyakDipinjam = Ruangan::withCount('peminjaman')->orderBy('peminjaman_count', 'desc')->take(5)->get();
                
                $countRuanganTersedia = Ruangan::whereHas('status', function($query) {
                    $query->where('status', 'Tersedia')
                    ->whereIn('id', function($subquery) {
                        $subquery->select(DB::raw('MAX(id)'))
                                                                    ->from('status_ruangan')
                                                                    ->groupBy('ruangan_id');
                                                        });
                                                })->count();
                $countRuanganDipinjam = Ruangan::whereHas('status', function($query) {
                                                    $query->where('status', 'Dipinjam')
                                                        ->whereIn('id', function($subquery) {
                                                            $subquery->select(DB::raw('MAX(id)'))
                                                                    ->from('status_ruangan')
                                                                    ->groupBy('ruangan_id');
                                                        });
                                                })->count();
                $countRuanganDiperbaikir = $countRuanganDiperbaiki = Ruangan::whereHas('status', function($query) {
                                                    $query->where('status', 'Diperbaiki')
                                                        ->whereIn('id', function($subquery) {
                                                            $subquery->select(DB::raw('MAX(id)'))
                                                                    ->from('status_ruangan')
                                                                    ->groupBy('ruangan_id');
                                                        });
                                                })->count();
                $arrayStatusRuangan = [
                    [
                        'title' => 'Ruangan Tersedia',
                        'value' => $countRuanganTersedia,
                    ],
                    [
                        'title' => 'Ruangan Dipinjam',
                        'value' => $countRuanganDipinjam,
                    ],
                    [
                        'title' => 'Ruangan Diperbaiki',
                        'value' => $countRuanganDiperbaikir,
                    ],
                ];

                $startOfMonth = Carbon::now()->startOfMonth();
                $endOfMonth = Carbon::now()->endOfMonth();
                $dates = [];
                $students = [];
                $admins = [];
                $rooms = [];
                $peminjamans = [];

                for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
                    $dates[] = $date->format('Y-m-d');

                    $students[] = Mahasiswa::whereDate('created_at', '<=', $date)->count();
                    $admins[] = Admin::whereDate('created_at', '<=', $date)->count();
                    $rooms[] = Ruangan::whereDate('created_at', '<=', $date)->count();
                    $peminjamans[] = Peminjaman::whereDate('created_at', '<=', $date)->count();
                }

                return view('dashboard', compact('data', 'peminjamanLimaTerbaru', 'ruanganPalingBanyakDipinjam', 'ruanganLimaTerbaru', 'arrayStatusRuangan', 'dates', 'students', 'admins', 'rooms', 'peminjamans'));
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {
            $ruangans = Ruangan::all();

            // Mendapatkan semua peminjaman 
            $peminjamans = DB::table('peminjaman')
                        ->select('*', DB::raw('
                            IF(
                                NOW() BETWEEN CONCAT(tgl_mulai, " ", jam_mulai) 
                                AND DATE_ADD(CONCAT(tgl_mulai, " ", jam_mulai), 
                                INTERVAL TIMESTAMPDIFF(MINUTE, jam_mulai, jam_selesai) MINUTE),
                                "Tidak Tersedia",
                                "Tersedia"
                            ) AS status
                        '))
                        ->get();

            foreach ($ruangans as $ruangan) {
                $status = $ruangan->status->last()->status ?? "Tidak Tersedia";
                if($status == "Diperbaiki") {
                    $ruangan->status = 'Diperbaiki';
                } else {
                    $ruangan->status = 'Tersedia'; // Default status
                    foreach ($peminjamans as $peminjaman) {
                        if ($peminjaman->ruangan_id == $ruangan->id && $peminjaman->status == 'Tidak Tersedia') {
                            $ruangan->status = 'Tidak Tersedia';
                            break;
                        }
                    }
                }
            }

            return view('home', compact('ruangans'));
        }
    }
}
