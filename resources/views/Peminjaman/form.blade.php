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

                            <!-- Informasi Peminjam (Readonly) -->
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Peminjam
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="nama" class="form-label">Nama</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control bg-light" id="nama" name="nama" value="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="nim" class="form-label">NIM</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                    <input type="text" class="form-control bg-light" id="nim" name="mahasiswa_nim" value="{{ Auth::user()->nim }}" readonly>
                                </div>
                            </div>

                            <!-- Informasi Ruangan (Readonly) -->
                            <div class="col-12 mt-4">
                                <div class="alert alert-info">
                                    <i class="bi bi-building me-2"></i>Informasi Ruangan
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="ruangan_id" class="form-label">Nama Ruangan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-door-open"></i></span>
                                    <input type="text" class="form-control bg-light" id="ruangan_id" value="{{ isset($peminjaman) ? $peminjaman->ruangan->nama : $ruangan->nama }}" readonly>
                                </div>
                            </div>
                            <input type="hidden" value="{{ isset($peminjaman) ? $peminjaman->ruangan_id : $ruangan->id }}" name="ruangan_id">

                            <div class="col-md-12">
                                <label for="kapasitas" class="form-label">Kapasitas</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-people"></i></span>
                                    <input type="text" class="form-control bg-light" id="kapasitas" value="{{ isset($peminjaman) ? $peminjaman->ruangan->kapasitas : $ruangan->kapasitas }}" readonly>
                                </div>
                            </div>

                            <!-- Informasi Jadwal -->
                            <div class="col-12 mt-4">
                                <div class="alert alert-info">
                                    <i class="bi bi-calendar-event me-2"></i>Informasi Jadwal
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required value="{{ isset($peminjaman) ? $peminjaman->tgl_mulai : '' }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Pilih Sesi</label>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sesi" id="sesiPagi" value="pagi" {{ isset($peminjaman) && $peminjaman->jam_mulai == '08:00' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sesiPagi">
                                                <i class="bi bi-sunrise me-1"></i>Pagi
                                                <br>
                                                <small class="text-muted">08:00 - 12:00</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sesi" id="sesiSiang" value="siang" {{ isset($peminjaman) && $peminjaman->jam_mulai == '13:00' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sesiSiang">
                                                <i class="bi bi-sun me-1"></i>Siang
                                                <br>
                                                <small class="text-muted">13:00 - 17:00</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sesi" id="sesiMalam" value="malam" {{ isset($peminjaman) && $peminjaman->jam_mulai == '18:00' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sesiMalam">
                                                <i class="bi bi-moon me-1"></i>Malam
                                                <br>
                                                <small class="text-muted">18:00 - 22:00</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="Tujuan" class="form-label">Tujuan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-pencil"></i></span>
                                    <textarea class="form-control" id="tujuan" name="tujuan" required>{{ isset($peminjaman) ? $peminjaman->tujuan : '' }}</textarea>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-send me-2"></i>{{ isset($peminjaman) ? 'Update' : 'Submit' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection