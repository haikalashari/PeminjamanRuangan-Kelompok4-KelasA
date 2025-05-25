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

    {{-- icon back --}}
    <a href="{{ route('admin.index') }}">
        <div class="icon d-flex flex-row gap-1 text-secondary">
            <i class="bi bi-arrow-left-circle-fill"></i>
            <div class="label">Kembali</div>
        </div>
    </a>
    <h1 class="mt-3">Detail Data Admin</h1>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" 
                                            data-bs-toggle="tab" 
                                            data-bs-target="#profile-overview">
                                        Data Admin
                                    </button>
                                </li>

                                {{-- <li class="nav-item">
                                    <button class="nav-link" 
                                            data-bs-toggle="tab" 
                                            data-bs-target="#profile-edit">
                                        Riwayat Peminjaman
                                    </button>
                                </li> --}}
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Data Admin</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $admin->user->name }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">NIP</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ isset($admin->user->mahasiswa) ? $admin->user->mahasiswa->nim : '' }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $admin->user->email }}
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <h5 class="card-title">Data Riwayat Peminjaman</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $peminjaman->mahasiswa->user->email }}
                                        </div>
                                    </div>

                                </div>
                            </div><!-- End Bordered Tabs --> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection