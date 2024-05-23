<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::all();
        // dd($peminjamans);
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        return view('peminjaman.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruangan_id' => 'required',
            'mahasiswa_nim' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
        ]);

        Peminjaman::create($request->all());
        return redirect()->route('peminjaman.index');
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
        $peminjaman->delete();
        return redirect()->route('peminjaman.index');
    }

}
