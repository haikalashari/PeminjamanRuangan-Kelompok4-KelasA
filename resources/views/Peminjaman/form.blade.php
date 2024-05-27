@extends('layouts.layout')

@section('content')
<section class="section d-flex justify-content-center">
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Peminjaman Ruang Sidang</h5>

                        <!-- Multi Columns Form -->
                        <form class="row g-3" action="{{ route('peminjaman.store') }}" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <label for="inputName5" class="form-label">Nama Ruangan</label>
                                <input type="text" class="form-control" id="inputName5" value="{{ $ruangan->nama }}" readonly>
                            </div>
                            <input type="hidden" value="{{ $ruangan->id }}" name="ruangan_id">
                            <div class="col-md-12">
                                <label for="kapasitas" class="form-label">Kapasitas</label>
                                <input type="text" class="form-control" id="kapasitas" value="{{ $ruangan->kapasitas }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="nim" name="mahasiswa_nim" value="{{ Auth::user()->nim }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tgl_mulai" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tgl_selesai" required>
                            </div>
                            <div class="col-md-6">
                                <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                            </div>
                            <div class="col-md-6">
                                <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                            </div>
                            <div class="col-12">
                                <label for="tujuan" class="form-label">Tujuan</label>
                                <textarea type="text" class="form-control" id="tujuan" placeholder="Seminar Proposal" name="tujuan" required></textarea>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- End Multi Columns Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection