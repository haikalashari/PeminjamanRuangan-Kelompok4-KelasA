@extends('layouts.layout')

@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-start">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Data Peminjaman</h1>
        <a href="{{ route('home') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <section class="section">
        @if(Auth::user()->admin)
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    @foreach($data as $item)
                    <div class="col-xl-4 col-md-6">
                        <div class="card info-card {{ $item['icon'] == 'bi-cart' ? 'sales-card' : ($item['icon'] == 'bi-shop' ? 'revenue-card' : 'customers-card') }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item['title'] }}</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi {{ $item['icon'] }}"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $item['value'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div><!-- End Left side columns -->
        </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Peminjaman</h5>
                        <p>Data Peminjaman Ruang Sidang Informatika UNTAN</p>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Ruangan</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Tujuan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjamans as $peminjaman)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $peminjaman->mahasiswa->user->name }}</td>
                                    <td>{{ $peminjaman->mahasiswa->nim }}</td>
                                    <td>{{ $peminjaman->ruangan->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_mulai)->format('d F Y') }}</td>
                                    <td>{{ $peminjaman->jam_mulai }}</td>
                                    <td>{{ $peminjaman->jam_selesai }}</td>
                                    <td>{{ $peminjaman->tujuan }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $peminjaman->id }}">
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $peminjaman->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Peminjaman Ruangan {{ $peminjaman->ruangan->nama }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Nama Peminjam: {{ $peminjaman->mahasiswa->user->name }}</p>
                                        <p>Nama Ruangan: {{ $peminjaman->ruangan->nama }}</p>
                                        <p>Waktu Mulai: {{ $peminjaman->jam_mulai }}</p>
                                        <p>Waktu Selesai: {{ $peminjaman->jam_selesai }}</p>
                                        <p>Jam Mulai: {{ $peminjaman->jam_mulai }}</p>
                                        <p>Jam Selesai: {{ $peminjaman->jam_selesai }}</p>
                                        <p>Tujuan: {{ $peminjaman->tujuan }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="{{ route('peminjaman.edit', $peminjaman->id) }}"
                                            class="btn btn-warning">
                                            Edit
                                        </a>
                                        <form 
                                            action="{{ route('peminjaman.destroy', $peminjaman->id) }}" 
                                            method="post" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Batalkan</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection