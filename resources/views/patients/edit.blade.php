@extends('layouts.app')

@section('title', 'Edit Pasien')
@section('page-title', 'Edit Pasien')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-pencil"></i> Form Edit Pasien
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('patients.update', $patient) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nama_pasien" class="form-label">Nama Pasien <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nama_pasien') is-invalid @enderror" 
                                   id="nama_pasien" 
                                   name="nama_pasien" 
                                   value="{{ old('nama_pasien', $patient->nama_pasien) }}" 
                                   required>
                            @error('nama_pasien')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                      id="alamat" 
                                      name="alamat" 
                                      rows="3" 
                                      required>{{ old('alamat', $patient->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="no_telpon" class="form-label">No Telpon <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('no_telpon') is-invalid @enderror" 
                                   id="no_telpon" 
                                   name="no_telpon" 
                                   value="{{ old('no_telpon', $patient->no_telpon) }}" 
                                   required>
                            @error('no_telpon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hospital_id" class="form-label">Rumah Sakit <span class="text-danger">*</span></label>
                            <select class="form-select @error('hospital_id') is-invalid @enderror" 
                                    id="hospital_id" 
                                    name="hospital_id" 
                                    required>
                                <option value="">Pilih Rumah Sakit</option>
                                @foreach($hospitals as $hospital)
                                    <option value="{{ $hospital->id }}" 
                                            {{ old('hospital_id', $patient->hospital_id) == $hospital->id ? 'selected' : '' }}>
                                        {{ $hospital->nama_rumah_sakit }}
                                    </option>
                                @endforeach
                            </select>
                            @error('hospital_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
