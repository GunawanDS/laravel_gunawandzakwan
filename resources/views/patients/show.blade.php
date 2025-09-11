@extends('layouts.app')

@section('title', 'Detail Pasien')
@section('page-title', 'Detail Pasien')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-heart"></i> Detail Pasien
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Nama Pasien</label>
                        <p class="form-control-plaintext">{{ $patient->nama_pasien }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <p class="form-control-plaintext">{{ $patient->alamat }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">No Telpon</label>
                        <p class="form-control-plaintext">{{ $patient->no_telpon }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Rumah Sakit</label>
                        <p class="form-control-plaintext">{{ $patient->hospital->nama_rumah_sakit }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Dibuat</label>
                        <p class="form-control-plaintext">{{ $patient->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Diperbarui</label>
                        <p class="form-control-plaintext">{{ $patient->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <div>
                        <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger delete-patient" 
                                data-id="{{ $patient->id }}" 
                                data-name="{{ $patient->nama_pasien }}">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
                        // Show success message
                        showAlert('success', response.message);
                        
                        // Close modal
                        $('#deleteModal').modal('hide');
                        
                        // Redirect to patients index
                        setTimeout(function() {
                            window.location.href = '/patients';
                        }, 1500);
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
