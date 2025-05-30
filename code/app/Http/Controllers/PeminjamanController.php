<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Peminjaman;
use App\Models\PeminjamanView;
use Illuminate\Http\Request;
use App\Http\Requests\StorePeminjamanRequest;
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

    public function create(Request $request)
    {
        $sesi = $request->query('sesi');
        $tanggal = $request->query('tanggal', now()->toDateString());
        $ruangans = \App\Models\Ruangan::all();

        // Cek ketersediaan tiap ruangan
        foreach ($ruangans as $ruangan) {
            $isBooked = \App\Models\Peminjaman::where('ruangan_id', $ruangan->id)
                ->where('tgl_mulai', $tanggal)
                ->where('jam_mulai', $this->getSessionTime($sesi)[0])
                ->exists();
            $ruangan->tidak_tersedia = $isBooked;
        }

        // Ambil semua tanggal yang sudah penuh untuk sesi ini
        $bookedDates = \App\Models\Peminjaman::where('jam_mulai', $this->getSessionTime($sesi)[0])
            ->pluck('tgl_mulai')
            ->toArray();

        // dd($bookedDates);
        return view('peminjaman.form', compact('ruangans', 'sesi', 'tanggal', 'bookedDates'));
    }




    private function getSessionTime($sesi)
    {
        $sessionTimes = [
            'pagi' => ['08:00', '12:00'],
            'siang' => ['12:30', '14:30'],
            'sore' => ['15.00', '17.30']
        ];

        return $sessionTimes[$sesi] ?? null;
    }

    public function store(StorePeminjamanRequest $request)
    {
        try {
            DB::beginTransaction();

            $sessionTime = $this->getSessionTime($request->sesi);
            if (!$sessionTime) {
                return redirect()->back()->with('error', 'Sesi tidak valid');
            }

            // cek apakah sudah terdapat peminjaman pada waktu yang sama
            $peminjaman = Peminjaman::where('ruangan_id', $request->ruangan_id)
                ->where('tgl_mulai', $request->tanggal)
                ->where('tgl_selesai', $request->tanggal)
                ->where('jam_mulai', $sessionTime[0])
                ->where('jam_selesai', $sessionTime[1])
                ->first();

            if ($peminjaman) {
                return redirect()->route('home')->with('error', 'Ruangan sudah dipinjam pada sesi tersebut');
            }

            // Trigger akan otomatis berjalan setelah insert
            Peminjaman::create([
                'ruangan_id' => $request->ruangan_id,
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'tgl_mulai' => $request->tanggal,
                'tgl_selesai' => $request->tanggal,
                'jam_mulai' => $sessionTime[0],
                'jam_selesai' => $sessionTime[1],
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
        $ruangans = Ruangan::all();
        $jam = \Carbon\Carbon::createFromFormat('H:i:s', $peminjaman->jam_mulai)->format('H:i');
        if ($jam == '08:00') {
            $sesi = 'pagi';
        } elseif ($jam == '12:30') {
            $sesi = 'siang';
        } elseif ($jam == '15:00') {
            $sesi = 'sore'; // atau 'malam' jika memang jam 18:00 itu malam
        }

        $tanggal = $peminjaman->tgl_mulai;

        // Cek ketersediaan tiap ruangan untuk tanggal dan sesi ini
        foreach ($ruangans as $ruangan) {
            $isBooked = Peminjaman::where('ruangan_id', $ruangan->id)
                ->where('tgl_mulai', $tanggal)
                ->where('jam_mulai', $peminjaman->jam_mulai)
                ->where('id', '!=', $peminjaman->id)
                ->exists();
            $ruangan->tidak_tersedia = $isBooked;
        }

        return view('peminjaman.form', compact('peminjaman', 'ruangans', 'sesi', 'tanggal'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'ruangan_id' => 'required',
                'mahasiswa_nim' => 'required',
                'tanggal' => 'required|date',
                'sesi' => 'required|in:pagi,siang,sore',
                'tujuan' => 'required',
            ]);

            $sessionTime = $this->getSessionTime($request->sesi);
            if (!$sessionTime) {
                return redirect()->back()->with('error', 'Sesi tidak valid');
            }

            // cek apakah sudah terdapat peminjaman pada waktu yang sama (kecuali peminjaman yang sedang diedit)
            $existingPeminjaman = Peminjaman::where('ruangan_id', $request->ruangan_id)
                ->where('tgl_mulai', $request->tanggal)
                ->where('tgl_selesai', $request->tanggal)
                ->where('jam_mulai', $sessionTime[0])
                ->where('jam_selesai', $sessionTime[1])
                ->where('id', '!=', $peminjaman->id)
                ->first();


            if ($existingPeminjaman) {
                return redirect()->back()->with('error', 'Ruangan sudah dipinjam pada sesi tersebut');
            }

            $peminjaman->update([
                'ruangan_id' => $request->ruangan_id,
                'mahasiswa_nim' => $request->mahasiswa_nim,
                'tgl_mulai' => $request->tanggal,
                'tgl_selesai' => $request->tanggal,
                'jam_mulai' => $sessionTime[0],
                'jam_selesai' => $sessionTime[1],
                'tujuan' => $request->tujuan,
            ]);

            DB::commit();
            return redirect()->route('peminjaman.riwayat')->with('success', 'Peminjaman berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
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
            return redirect()->route('peminjaman.riwayat')->with('success', 'Peminjaman berhasil dihapus');
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
