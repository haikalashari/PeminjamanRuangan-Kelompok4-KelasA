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
    <h1>Ruang Sidang Informatika</h1>

    <div class="d-flex justify-content-end my-4 mx-4">
        <a href="{{ route('ruangan.create') }}" class="btn btn-primary">Tambah Ruangan</a>
    </div>

    <div class="container">
        @foreach($ruangans->chunk(2) as $chunk)
            <div class="row">
                @foreach($chunk as $ruangan)
                    @php
                        $status = $ruangan->status->last()->status ?? 'Tidak ada status';
                    @endphp
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $ruangan->nama }}</h5>
                                <div class="row">
                                    <div class="col-md-6 d-flex flex-row gap-2">
                                        <p class="card-subtitle text-muted">Kapasitas :</p>
                                        <p class="card-subtitle text-muted">
                                            {{ $ruangan->kapasitas }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col d-flex flex-row gap-2">
                                        <p class="card-subtitle text-muted">Status Ruangan :</p>
                                        <p class="card-subtitle text-muted">
                                            {{ $status }}
                                        </p>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-start px-0 mt-3">
                                    <p class="card-text w-25">
                                        <a href="{{ route('ruangan.edit', $ruangan->id) }}" 
                                            class="btn btn-primary">Edit</a>
                                    </p>

                                    <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="POST" class="w-25 mx-0 px-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection