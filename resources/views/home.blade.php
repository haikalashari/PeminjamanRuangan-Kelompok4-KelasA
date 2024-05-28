@extends('layouts.layout')

@section('content')
    <header class="bg-dark py-5 mb-5">   
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Peminjaman Ruang Sidang</h1>
                <p class="lead fw-normal text-white-50 mb-0">Informatika Fakultas Tenik UNTAN</p>
            </div>
        </div>
    </header>

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

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($ruangans as $ruangan)
                    @php
                        $status = $ruangan->status;
                    @endphp
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="https://source.unsplash.com/450x300?room" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $ruangan->nama }}</h5>
                                <h6>Kapasitas</h6>
                                <!-- Product price-->
                                {{ $ruangan->kapasitas }} Orang

                                {{-- status  --}}
                                <div class="text-center">
                                    @if($status == 'Tersedia')
                                        <span class="badge bg-success">{{ $status }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $status }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            {{-- buat kondisi tombol tidak bisa ditekan ketika status tidak == tersedia --}}
                            @if($status == 'Tersedia')
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="{{ route('peminjaman.create', $ruangan->id) }}">Pinjam</a>
                                </div>
                            @else
                                <div class="text-center">
                                    <p class="btn btn-outline-dark mt-auto" disabled>Pinjam</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection