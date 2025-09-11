@extends('layouts.app')

@section('title', 'Detail Rumah Sakit')
@section('page-title', 'Detail Rumah Sakit')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-hospital"></i> Detail Rumah Sakit
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Nama Rumah Sakit</label>
                        <p class="form-control-plaintext">{{ $hospital->nama_rumah_sakit }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <p class="form-control-plaintext">{{ $hospital->alamat }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p class="form-control-plaintext">{{ $hospital->email }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Telepon</label>
                        <p class="form-control-plaintext">{{ $hospital->telepon }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Dibuat</label>
                        <p class="form-control-plaintext">{{ $hospital->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Diperbarui</label>
                        <p class="form-control-plaintext">{{ $hospital->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('hospitals.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <div>
                        <a href="{{ route('hospitals.edit', $hospital) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('hospitals.destroy', $hospital) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus rumah sakit ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
