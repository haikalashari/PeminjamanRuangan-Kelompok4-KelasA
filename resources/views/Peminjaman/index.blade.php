@extends('layouts.layout')

@section('content')
    <h1>Data Peminjaman</h1>

    <section class="section">
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
                                    <th>
                                        <b>Nama Peminjam</b>
                                    </th>
                                    <th>Nama Ruangan</th>
                                    <th data-type="date" data-format="YYYY/DD/MM HH:mm:ss">
                                        Waktu Mulai
                                    </th>
                                    <th data-type="date" data-format="YYYY/DD/MM HH:mm:ss">
                                        Waktu Selesai
                                    </th>
                                    <th>Tujuan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjamans as $peminjaman)
                                <tr>
                                    <td>{{ $peminjaman->mahasiswa->user->name }}</td>
                                    <td>{{ $peminjaman->ruangan->nama }}</td>
                                    <td>{{ $peminjaman->jam_mulai }}</td>
                                    <td>{{ $peminjaman->jam_selesai }}</td>
                                    <td>{{ $peminjaman->tujuan }}</td>
                                    <td>
                                        <a href="{{ route('peminjaman.show', $peminjaman->id) }}"
                                            class="btn btn-info">
                                            Detail
                                        </a>
                                        {{-- <a href="{{ route('peminjaman.edit', $peminjaman->id) }}"
                                            class="btn btn-warning">
                                            Edit
                                        </a>
                                        <form 
                                            action="{{ route('peminjaman.destroy', $peminjaman->id) }}" 
                                            method="post" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form> --}}
                                    </td>
                                </tr>
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