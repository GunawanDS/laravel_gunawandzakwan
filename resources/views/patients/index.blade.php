@extends('layouts.app')

@section('title', 'Data Pasien')
@section('page-title', 'Data Pasien')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Daftar Pasien</h2>
    <a href="{{ route('patients.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Pasien
    </a>
</div>

<!-- Filter Section -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('patients.index') }}" class="row g-3">
            <div class="col-md-6">
                <label for="hospital_id" class="form-label">Filter Berdasarkan Rumah Sakit</label>
                <select class="form-select" id="hospital_id" name="hospital_id">
                    <option value="">Semua Rumah Sakit</option>
                    @foreach($hospitals as $hospital)
                        <option value="{{ $hospital->id }}" 
                                {{ request('hospital_id') == $hospital->id ? 'selected' : '' }}>
                            {{ $hospital->nama_rumah_sakit }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 d-flex align-items-end">
                <button type="submit" class="btn btn-outline-primary me-2">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($patients->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Alamat</th>
                            <th>No Telpon</th>
                            <th>Rumah Sakit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $index => $patient)
                            <tr id="patient-row-{{ $patient->id }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $patient->nama_pasien }}</td>
                                <td>{{ Str::limit($patient->alamat, 50) }}</td>
                                <td>{{ $patient->no_telpon }}</td>
                                <td>{{ $patient->hospital->nama_rumah_sakit }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('patients.show', $patient) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('patients.edit', $patient) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger delete-patient" 
                                                data-id="{{ $patient->id }}" 
                                                data-name="{{ $patient->nama_pasien }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-person-heart fs-1 text-muted"></i>
                <h5 class="text-muted mt-3">Belum ada data pasien</h5>
                <p class="text-muted">Klik tombol "Tambah Pasien" untuk menambahkan data pertama.</p>
                <a href="{{ route('patients.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Pasien
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus pasien <strong id="patient-name"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirm-delete">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    let patientIdToDelete = null;

    // Handle delete button click
    $('.delete-patient').click(function() {
        patientIdToDelete = $(this).data('id');
        const patientName = $(this).data('name');
        $('#patient-name').text(patientName);
        $('#deleteModal').modal('show');
    });

    // Handle confirm delete
    $('#confirm-delete').click(function() {
        if (patientIdToDelete) {
            $.ajax({
                url: '/patients/' + patientIdToDelete,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Remove the row from table
                        $('#patient-row-' + patientIdToDelete).fadeOut(300, function() {
                            $(this).remove();
                        });
                        
                        // Show success message
                        showAlert('success', response.message);
                        
                        // Close modal
                        $('#deleteModal').modal('hide');
                    }
                },
                error: function(xhr) {
                    showAlert('danger', 'Terjadi kesalahan saat menghapus data.');
                }
            });
        }
    });

    // Function to show alert
    function showAlert(type, message) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        $('.main-content').prepend(alertHtml);
        
        // Auto hide after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);
    }
});
</script>
@endsection
