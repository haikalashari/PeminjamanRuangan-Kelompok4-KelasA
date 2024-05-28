@extends('layouts.layout')

@section('content')
<section class="section d-flex justify-content-center">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="col">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-start">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        

        <div class="row d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form Peminjaman Ruang Sidang</h5>
                            <form class="row g-3" action="{{ isset($peminjaman) ? route('peminjaman.update', $peminjaman->id) : route('peminjaman.store') }}"
                                method="POST">
                                @csrf
                                @if(isset($peminjaman))
                                    @method('PUT')
                                @endif
                                <div class="col-md-12">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="mahasiswa_nim" value="{{ Auth::user()->nim }}" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label for="ruangan_id" class="form-label">Nama Ruangan</label>
                                    <input type="text" class="form-control" id="ruangan_id" value="{{ isset($peminjaman) ? $peminjaman->ruangan->nama : $ruangan->nama }}" readonly>
                                </div>
                                <input type="hidden" value="{{ isset($peminjaman) ? $peminjaman->ruangan_id : $ruangan->id }}" name="ruangan_id">
                                <div class="col-md-12">
                                    <label for="kapasitas" class="form-label">Kapasitas</label>
                                    <input type="text" class="form-control" id="kapasitas" value="{{ isset($peminjaman) ? $peminjaman->ruangan->kapasitas : $ruangan->kapasitas }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" required value="{{ isset($peminjaman) ? $peminjaman->tgl_mulai : '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                                    <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" required value="{{ isset($peminjaman) ? $peminjaman->tgl_selesai : '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required value="{{ isset($peminjaman) ? $peminjaman->jam_mulai : '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                    <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required value="{{ isset($peminjaman) ? $peminjaman->jam_selesai : '' }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="Tujuan" class="form-label">Tujuan</label>
                                    <textarea class="form-control" id="tujuan" name="tujuan" required>{{ isset($peminjaman) ? $peminjaman->tujuan : '' }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ isset($peminjaman) ? 'Update' : 'Submit' }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection