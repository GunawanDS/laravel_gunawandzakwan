@extends('layouts.app')

@section('title', 'Data Rumah Sakit')
@section('page-title', 'Data Rumah Sakit')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Daftar Rumah Sakit</h2>
    <a href="{{ route('hospitals.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Rumah Sakit
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($hospitals->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Rumah Sakit</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hospitals as $index => $hospital)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $hospital->nama_rumah_sakit }}</td>
                                <td>{{ Str::limit($hospital->alamat, 50) }}</td>
                                <td>{{ $hospital->email }}</td>
                                <td>{{ $hospital->telepon }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('hospitals.show', $hospital) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('hospitals.edit', $hospital) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('hospitals.destroy', $hospital) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus rumah sakit ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-hospital fs-1 text-muted"></i>
                <h5 class="text-muted mt-3">Belum ada data rumah sakit</h5>
                <p class="text-muted">Klik tombol "Tambah Rumah Sakit" untuk menambahkan data pertama.</p>
                <a href="{{ route('hospitals.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Rumah Sakit
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
