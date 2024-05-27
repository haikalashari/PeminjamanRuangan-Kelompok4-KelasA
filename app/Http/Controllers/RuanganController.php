<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Models\StatusRuangan;
use Illuminate\Support\Facades\DB;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();

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
        try {
            DB::beginTransaction();

            $request->validate([
                'nama' => 'required|unique:ruangan,nama',
                'kapasitas' => 'required|numeric',
            ]);
            
    
            Ruangan::create([
                'nama' => $request->nama,
                'kapasitas' => $request->kapasitas,
            ]);
    
            $this->newStatusRuangan(Ruangan::latest()->first()->id, $request->status);
    
            DB::commit();

            return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('ruangan.index')
                ->with('error', $th->getMessage());
        }
    }

    public function show(Ruangan $ruangan)
    {

        return view('ruangan.show', compact('ruangan'));
    }

    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.form', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'nama' => 'required|unique:ruangan,nama,' . $ruangan->id,
                'kapasitas' => 'required|numeric',
            ]);
    
            $ruangan->update([
                'nama' => $request->nama,
                'kapasitas' => $request->kapasitas,
            ]);
    
            $this->newStatusRuangan($ruangan->id, $request->status);

            DB::commit();
    
            return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('ruangan.index')
                ->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        Ruangan::destroy($id);

        return redirect()->route('ruangan.index');
    }
}
