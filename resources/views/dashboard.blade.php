@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $totalHospitals }}</h4>
                        <p class="card-text">Total Rumah Sakit</p>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-hospital fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">{{ $totalPatients }}</h4>
                        <p class="card-text">Total Pasien</p>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-person-heart fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-hospital"></i> Rumah Sakit Terbaru
                </h5>
            </div>
            <div class="card-body">
                @if($recentHospitals->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentHospitals as $hospital)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $hospital->nama_rumah_sakit }}</h6>
                                    <small class="text-muted">{{ $hospital->alamat }}</small>
                                </div>
                                <small class="text-muted">{{ $hospital->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Belum ada data rumah sakit.</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-heart"></i> Pasien Terbaru
                </h5>
            </div>
            <div class="card-body">
                @if($recentPatients->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentPatients as $patient)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">{{ $patient->nama_pasien }}</h6>
                                    <small class="text-muted">{{ $patient->hospital->nama_rumah_sakit }}</small>
                                </div>
                                <small class="text-muted">{{ $patient->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Belum ada data pasien.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Menu Cepat</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('hospitals.create') }}" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-plus-circle"></i> Tambah Rumah Sakit
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('patients.create') }}" class="btn btn-success btn-lg w-100">
                            <i class="bi bi-plus-circle"></i> Tambah Pasien
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
