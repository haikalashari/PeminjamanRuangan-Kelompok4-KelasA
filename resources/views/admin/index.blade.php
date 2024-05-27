@extends('layouts.layout')

@section('content')
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
    <h1>Data Admin</h1>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Data Admin</h5>
                            </div>

                            <div class="col">
                                <div class="d-flex justify-content-end my-4 mx-4">
                                    <button type="button" 
                                            class="btn btn-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#exampleModal">
                                        Tambah Admin
                                    </button>
                                </div>
                            </div>

                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        <b>Nama</b>
                                    </th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $admin->user->name }}</td>
                                    <td>{{ $admin->user->email }}</td>
                                    <td>
                                        <a href="{{ route('admin.show', $admin->id) }}"
                                            class="btn btn-info">
                                            Detail
                                        </a>
                                        {{-- <a href="{{ route('admin.edit', $admin->id) }}"
                                            class="btn btn-warning">
                                            Edit
                                        </a> --}}
                                        <form 
                                            action="{{ route('admin.destroy', $admin->id) }}" 
                                            method="post" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Admin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- Form Create admin --}}
                <form action="{{ route('admin.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Nama</label>
                        <select class="form-control" id="user_id" name="user_id">
                            <option value="">Select a user</option>
                            @foreach($users as $user)
                                @if(!in_array($user->id, $admins->pluck('user_id')->toArray()))
                                    <option value="{{ $user->id }}" data-email="{{ $user->email }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="" disabled>
                    </div>
                    <input type="hidden" value="{{ $user->id }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>

    <script>
        function updateEmail() {
            var select = document.getElementById('user_id');
            var emailField = document.getElementById('email');
            var selectedOption = select.options[select.selectedIndex];
            emailField.value = selectedOption.getAttribute('data-email') || '';
        }
        
        // Attach the updateEmail function to the change event
        document.getElementById('user_id').addEventListener('change', updateEmail);
    </script>
@endsection