<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Peminjaman;
use App\Models\PeminjamanView;
use Illuminate\Http\Request;
use App\Models\StatusRuangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = PeminjamanView::all();

        // Memanggil fungsi MySQL hitungTotalPeminjamanBulanIni PROCEDURE
        $totalPeminjamanBulanIniQuery = DB::select('CALL hitungTotalPeminjamanBulanIni()');
        $totalPeminjamanBulanIni = $totalPeminjamanBulanIniQuery[0]->hasil;

        // Memanggil fungsi MySQL avg_peminjaman_bulan_ini_function
        $rataPeminjamanBulanIniQuery = DB::select('SELECT avg_peminjaman_bulan_ini_function() AS rata_rata');
        // Mengambil nilai rata-rata dari hasil query
        $rataPeminjamanBulanIni = $rataPeminjamanBulanIniQuery[0]->rata_rata;

        $data = [
            [
                'title' => 'Jumlah Peminjaman Bulan Ini',
                'icon' => 'bi-cart',
                'value' => $totalPeminjamanBulanIni
            ],
            [
                'title' => 'Rata-rata Peminjaman Bulan Ini',
                'icon' => 'bi-cart',
                'value' => $rataPeminjamanBulanIni
            ]
        ];
        // dd($peminjamans);
        return view('peminjaman.index', compact('peminjamans', 'data'));
    }

    public function create(Ruangan $ruangan)
    {
        $status = $ruangan->status->last()->status ?? 'Tidak ada status';


        if ($status !== 'Diperbaiki') {
            return view('peminjaman.form', compact('ruangan'));
        }

        return redirect()->route('home')->with('error', 'Ruangan Sedang Tidak Tersedia');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'ruangan_id' => 'required',
                'mahasiswa_nim' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
                'tujuan' => 'required',
            ]);

            // cek apakah sudah terdapat peminjaman pada waktu yang sama
            $peminjaman = Peminjaman::where('ruangan_id', $request->ruangan_id)
                ->where('tgl_mulai', $request->tgl_mulai)
                ->where('tgl_selesai', $request->tgl_selesai)
                ->where('jam_mulai', $request->jam_mulai)
                ->where('jam_selesai', $request->jam_selesai)
                ->first();

            if ($peminjaman) {
                return redirect()->route('home')->with('error', 'Ruangan sudah dipinjam pada waktu tersebut');
            }

            // Trigger akan otomatis berjalan setelah insert
            Peminjaman::create([
                'ruangan_id' => $request->ruangan_id,
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'tujuan' => $request->tujuan,
            ]);

            StatusRuangan::create([
                'ruangan_id' => $request->ruangan_id,
                'status' => 'Dipinjam',
            ]);

            DB::commit();

            if(!Auth::user()->admin) {
                return redirect()->route('home')->with('success', 'Peminjaman berhasil ditambahkan');
            }
            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show(Peminjaman $peminjaman)
    {
        return view('peminjaman.detail', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        return view('peminjaman.form', compact('peminjaman'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        /*

        UPDATE PEMINJAMAN BELUM

        */


        $request->validate([
            'ruangan_id' => 'required',
            'mahasiswa_nim' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
        ]);

        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        try {
            DB::beginTransaction();

            StatusRuangan::create([
                'ruangan_id' => $peminjaman->ruangan_id,
                'status' => 'Tersedia',
            ]);
            $peminjaman->delete();

            DB::commit();
            return redirect()->route('peminjaman.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function riwayat()
    {
        $peminjamans = Peminjaman::where('mahasiswa_nim', auth()->user()->nim)->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

}
