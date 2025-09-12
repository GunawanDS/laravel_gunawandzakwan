@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-6 mb-4">
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
    
    <div class="col-md-6 mb-4">
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
                    <i class="bi bi-hospital"></i> Rumah Sakit
                </h5>
            </div>
            <div class="card-body">
                @if($recentHospitals->count() > 0)
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="hospitalChart"></canvas>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-hospital fs-1 text-muted"></i>
                        <p class="text-muted mt-3">Belum ada data untuk ditampilkan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-bar-chart"></i> Pasien Rumah Sakit
                </h5>
            </div>
            <div class="card-body">
                @if($hospitalsWithPatientCount->count() > 0)
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="patientChart"></canvas>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-bar-chart fs-1 text-muted"></i>
                        <p class="text-muted mt-3">Belum ada data untuk ditampilkan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data untuk chart pasien
    const hospitalData = @json($hospitalsWithPatientCount);
    
    if (hospitalData.length > 0) {
        const ctx = document.getElementById('patientChart').getContext('2d');
        
        const patientChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: hospitalData.map(hospital => hospital.nama_rumah_sakit),
                datasets: [{
                    label: 'Jumlah Pasien',
                    data: hospitalData.map(hospital => hospital.patients_count),
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    title: {
                        display: true,
                        text: 'Distribusi Pasien per Rumah Sakit',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // Data untuk chart rumah sakit terbaru
    const recentHospitalsData = @json($recentHospitals);
    
    if (recentHospitalsData.length > 0) {
        const ctx2 = document.getElementById('hospitalChart').getContext('2d');
        
        const hospitalChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: recentHospitalsData.map(hospital => hospital.nama_rumah_sakit),
                datasets: [{
                    label: 'Rumah Sakit Terbaru',
                    data: recentHospitalsData.map((hospital, index) => recentHospitalsData.length - index),
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 15
                        }
                    },
                    title: {
                        display: true,
                        text: 'Rumah Sakit Terbaru',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection
