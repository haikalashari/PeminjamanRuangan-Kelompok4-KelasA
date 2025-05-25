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

                        {{-- Form pilih tanggal, reload halaman saat tanggal berubah --}}
                        <form method="GET" action="{{ route('peminjaman.create') }}" class="mb-3">
                            <input type="hidden" name="sesi" value="{{ $sesi }}">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                <input type="date" class="form-control" name="tanggal" value="{{ $tanggal ?? now()->toDateString() }}" onchange="this.form.submit()" required>
                            </div>
                        </form>

                        {{-- Form utama peminjaman --}}
                        <form class="row g-3" action="{{ isset($peminjaman) ? route('peminjaman.update', $peminjaman->id) : route('peminjaman.store') }}" method="POST">
                            @csrf
                            @if(isset($peminjaman))
                                @method('PUT')
                            @endif

                            <!-- Informasi Peminjam -->
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

                            <!-- Informasi Ruangan -->
                            <div class="col-12 mt-4">
                                <div class="alert alert-info">
                                    <i class="bi bi-building me-2"></i>Informasi Ruangan
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="ruangan_id" class="form-label">Pilih Ruangan</label>
                                <select name="ruangan_id" id="ruangan_id" class="form-select" required>
                                    <option value="">-- Pilih Ruangan --</option>
                                    @foreach($ruangans as $item)
                                        <option value="{{ $item->id }}" data-kapasitas="{{ $item->kapasitas }}"
                                            {{ (isset($peminjaman) && $peminjaman->ruangan_id == $item->id) ? 'selected' : '' }}
                                            {{ $item->tidak_tersedia && (!isset($peminjaman) || $peminjaman->ruangan_id != $item->id) ? 'disabled style=background:#eee;color:#aaa;' : '' }}>
                                            {{ $item->nama }} (Kapasitas: {{ $item->kapasitas }})
                                            @if($item->tidak_tersedia && (!isset($peminjaman) || $peminjaman->ruangan_id != $item->id)) - Tidak Tersedia @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="kapasitas" class="form-label">Kapasitas</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-people"></i></span>
                                    <input type="text" class="form-control bg-light" id="kapasitas" readonly>
                                </div>
                            </div>

                            <!-- Informasi Jadwal -->
                            <div class="col-12 mt-4">
                                <div class="alert alert-info">
                                    <i class="bi bi-calendar-event me-2"></i>Informasi Jadwal
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Sesi yang dipilih</label>
                                <input type="text" class="form-control bg-light" value="{{ ucfirst($sesi) }} 
                                    @if($sesi == 'pagi') (08:00-12:00)
                                    @elseif($sesi == 'siang') (12:30-14:30)
                                    @elseif($sesi == 'sore' || $sesi == 'malam') (15:00-17:30)
                                    @endif" readonly>
                                <input type="hidden" name="sesi" value="{{ $sesi }}">
                                <input type="hidden" name="tanggal" value="{{ $tanggal }}">
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
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const ruanganSelect = document.getElementById('ruangan_id');
                            const kapasitasInput = document.getElementById('kapasitas');
                            function updateKapasitas() {
                                const selected = ruanganSelect.options[ruanganSelect.selectedIndex];
                                kapasitasInput.value = selected.getAttribute('data-kapasitas') || '';
                            }
                            ruanganSelect.addEventListener('change', updateKapasitas);
                            // Set kapasitas saat halaman pertama kali dibuka jika ada yang terpilih
                            updateKapasitas();
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection