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
    
    @if(isset($ruangan))
        <h1>Edit Ruangan {{ $ruangan->nama }}</h1>
    @else
        <h1>Tambah Ruangan</h1>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Penambahan Ruangan</h5>
            <form action="{{ isset($ruangan) ? route('ruangan.update', $ruangan->id) : route('ruangan.store') }}" 
                method="POST">
                @csrf
                @if(isset($ruangan))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Ruangan</label>
                    <input type="text" class="form-control" id="nama" name="nama" 
                            value="{{ isset($ruangan) ? $ruangan->nama : '' }}">
                </div>
                <div class="mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas Ruangan</label>
                    <input type="number" class="form-control" id="kapasitas" name="kapasitas" 
                            value="{{ isset($ruangan) ? $ruangan->kapasitas : '' }}">
                </div>

                {{-- status ruangan (tersedia, tidak tersedia, diperbaiki) --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Status Ruangan</label>
                    <select class="form-select" id="status" name="status">
                        <option value="Tersedia" 
                            {{ isset($ruangan) && $ruangan->status->last()->status == 'tersedia' ? 'selected' : '' }}>
                            Tersedia
                        </option>
                        <option value="Tidak Tersedia" 
                            {{ isset($ruangan) && $ruangan->status->last()->status == 'tidak tersedia' ? 'selected' : '' }}>
                            Tidak Tersedia
                        </option>
                        <option value="Diperbaiki" 
                            {{ isset($ruangan) && $ruangan->status->last()->status == 'diperbaiki' ? 'selected' : '' }}>
                            Diperbaiki
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


@endsection