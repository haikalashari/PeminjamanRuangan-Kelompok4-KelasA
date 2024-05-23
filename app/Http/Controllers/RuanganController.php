<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\StatusRuangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();
        // dd($ruangans->first()->status->last()->status);

        return view('ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('ruangan.form');
    }

    public function newStatusRuangan($ruangan_id, $status)
    {
        StatusRuangan::create([
            'ruangan_id' => $ruangan_id,
            'status' => $status,
        ]);
    }

    public function store(Request $request)
    {
        Ruangan::create([
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
        ]);

        $this->newStatusRuangan(Ruangan::latest()->first()->id, $request->status);

        return redirect()->route('ruangan.index');
    }

    public function show($id)
    {
        $ruangan = Ruangan::find($id);

        return view('ruangan.show', compact('ruangan'));
    }

    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.form', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'nama' => 'required',
            'kapasitas' => 'required|numeric',
        ]);

        $ruangan->update([
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
        ]);

        $this->newStatusRuangan($ruangan->id, $request->status);

        return redirect()->route('ruangan.index');
    }

    public function destroy($id)
    {
        Ruangan::destroy($id);

        return redirect()->route('ruangan.index');
    }
}
