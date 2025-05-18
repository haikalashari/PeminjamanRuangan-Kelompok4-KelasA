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
            <div class="row justify-content-center">
                <!-- Card Sesi Pagi -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <h5 class="card-title">Sesi Pagi</h5>
                            <p class="card-text">08:00 - 12:00</p>
                            <a href="{{ route('peminjaman.create', ['sesi' => 'pagi']) }}" class="btn btn-primary">Pinjam Sesi Pagi</a>
                        </div>
                    </div>
                </div>
                <!-- Card Sesi Siang -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <h5 class="card-title">Sesi Siang</h5>
                            <p class="card-text">13:00 - 17:00</p>
                            <a href="{{ route('peminjaman.create', ['sesi' => 'siang']) }}" class="btn btn-primary">Pinjam Sesi Siang</a>
                        </div>
                    </div>
                </div>
                <!-- Card Sesi Malam -->
                <div class="col-md-4 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <h5 class="card-title">Sesi Malam</h5>
                            <p class="card-text">18:00 - 22:00</p>
                            <a href="{{ route('peminjaman.create', ['sesi' => 'malam']) }}" class="btn btn-primary">Pinjam Sesi Malam</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection