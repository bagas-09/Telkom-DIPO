@extends('layouts.admin-master')

@section('title')

@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan Procurement</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Forms</a></div>
            <div class="breadcrumb-item">Laporan Procurement</div>
        </div>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="px-5 pt-4" style="font-size: 140%"><b>Edit GDP Laporan</b></div>
                    <div class="px-5 pt-2 pb-0">Buat Laporan sesuai dengan ketentuan dan SOP yang berlaku di Telkom Akses. Anda dapat mengubah laporan ini nanti.</div>
                    @foreach ($procurement as $laporan)
                    <form id="storeForm" action="{{route('procurement.dashboard.update', [$id])}}" method="POST">
                        <div class="row">
                            @csrf
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pl-5 mb-0 pb-0">
                                    @if($laporan->PID_maintenance_id != "")
                                    <label for="PID_maintenance_id" class="col-form-label">PID maintenance: </label>
                                    <input type="text" id="PID_maintenance_id" name="PID_maintenance_id" class="form-control @error('PID_maintenance_id') is-invalid @enderror mb-2" value="{{ old('PID_maintenance_id', $laporan->PID_maintenance_id) }}" readonly>
                                    <span id="PID_maintenance_id_error" style="display: none; color: red;">Field PID Maintenance harus diisi!</span>
                                    @error('PID_maintenance_id')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    @endif
                                    @if($laporan->PID_konstruksi_id != "")
                                    <label for="PID_konstruksi_id" class="col-form-label">PID Konstruksi: </label>
                                    <input type="text" id="PID_konstruksi_id" name="PID_konstruksi_id" class="form-control @error('PID_konstruksi_id') is-invalid @enderror mb-2" value="{{ old('PID_konstruksi_id', $laporan->PID_konstruksi_id) }}" readonly>
                                    @error('PID_konstruksi_id')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    @endif
                                    <label for="lokasi" class="col-form-label">Lokasi: </label>
                                    <input type="text" id="lokasi" name="lokasi" class="form-control mb-2" value="{{ old('lokasi', $laporan->lokasi) }}" readonly>
                                    <span id="lokasi_error" style="display: none; color: red;">Field Lokasi harus diisi!</span>

                                    <label for="PR_SAP" class="col-form-label">Nomor PR: </label>
                                    <input type="text" id="PR_SAP" name="PR_SAP" class="form-control @error('PR_SAP') is-invalid @enderror mb-2" value="{{ old('PR_SAP', $laporan->PR_SAP) }}" readonly>
                                    @error('PR_SAP')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <label for="PO_SAP" class="col-form-label">Nomor PO SAP: </label>
                                    <input type="text" id="PO_SAP" name="PO_SAP" class="form-control @error('PO_SAP') is-invalid @enderror mb-2" value="{{ old('PO_SAP') }}">
                                    @error('PO_SAP')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <label for="tanggal_PO_SAP" class="col-form-label">Tanggal PO SAP: </label>
                                    <input type="date" id="tanggal_PO_SAP" name="tanggal_PO_SAP" class="form-control @error('tanggal_PO_SAP') is-invalid @enderror mb-2" value="{{ old('tanggal_PO_SAP') }}">
                                    @error('tanggal_PO_SAP')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <label for="material_DRM" class="col-form-label">Material DRM: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="material_DRM" name="material_DRM" class="form-control @error('material_DRM') is-invalid @enderror mb-2" onkeyup="totalDRM()" oninput="formatCurrency(this)" value="{{ old('material_DRM', $laporan->material_DRM) }}">
                                        <span id="material_DRM_error" style="display: none; color: red;">Field Material DRM harus diisi!</span>
                                        @error('material_DRM')
                                        <div class="invalid-feedback">
                                            Material DRM Wajib Diisi!!!
                                        </div>
                                        @enderror
                                    </div>
                                    

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pr-5 mb-0">
                                <label for="jasa_DRM" class="col-form-label">Jasa DRM: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="jasa_DRM" name="jasa_DRM" class="form-control @error('jasa_DRM') is-invalid @enderror mb-2" onkeyup="totalDRM()" oninput="formatCurrency(this)" value="{{ old('jasa_DRM', $laporan->jasa_DRM) }}">
                                        <span id="jasa_DRM_error" style="display: none; color: red;">Field Jasa DRM harus diisi!</span>
                                        @error('jasa_DRM')
                                        <div class="invalid-feedback">
                                            Jasa DRM Wajib Diisi!!!
                                        </div>
                                        @enderror
                                    </div>
                                    <label for="total_DRM" class="col-form-label">Total DRM: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="total_DRM" name="total_DRM" class="form-control @error('total_DRM') is-invalid @enderror mb-2" onkeyup="totalDRM()" oninput="formatCurrency(this)" value="{{ old('total_DRM', $laporan->total_DRM) }}" readonly>
                                        <span id="total_DRM_error" style="display: none; color: red;">Field Total DRM harus diisi!</span>
                                        @error('Total_DRM')
                                        <div class="invalid-feedback">
                                            total DRM Wajib Diisi!!!
                                        </div>
                                        @enderror
                                    </div>
                                    <label for="material_aktual" class="col-form-label">Material Aktual: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="material_aktual" name="material_aktual" class="form-control @error('material_aktual') is-invalid @enderror mb-2" onkeyup="totalAktual()" oninput="formatCurrency(this)" value="{{ old('material_aktual', $laporan->material_aktual) }}">
                                        <span id="material_aktual_error" style="display: none; color: red;">Field Material Aktual harus diisi!</span>
                                        @error('material_aktual')
                                        <div class="invalid-feedback">
                                            Material Aktual Wajib Diisi!!!
                                        </div>
                                        @enderror
                                    </div>
                                    <label for="jasa_aktual" class="col-form-label">Jasa Aktual: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="jasa_aktual" name="jasa_aktual" class="form-control @error('jasa_aktual') is-invalid @enderror mb-2" onkeyup="totalAktual()" oninput="formatCurrency(this)" value="{{ old('jasa_aktual', $laporan->jasa_aktual) }}">
                                        <span id="jasa_aktual_error" style="display: none; color: red;">Field Jasa Aktual harus diisi!</span>
                                        @error('jasa_aktual')
                                        <div class="invalid-feedback">
                                            Jasa Aktual Wajib Diisi!!!
                                        </div>
                                        @enderror
                                    </div>
                                    <label for="total_aktual" class="col-form-label">Total Aktual: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="total_aktual" name="total_aktual" class="form-control @error('total_aktual') is-invalid @enderror mb-2" onkeyup="totalAktual()" oninput="formatCurrency(this)" value="{{ old('total_aktual', $laporan->total_aktual) }}" readonly>
                                        <span id="total_aktual_error" style="display: none; color: red;">Field Total Aktual harus diisi!</span>
                                        @error('total_aktual')
                                        <div class="invalid-feedback">
                                            Total Aktual Wajib Diisi!!!
                                        </div>
                                        @enderror
                                    </div>
                                    <label for="status_tagihan_id" class="col-form-label">Status Tagihan: </label>
                                    <select class="form-control @error('status_tagihan_id') is-invalid @enderror mb-2" name="status_tagihan_id" id="status_tagihan_id" value="{{ old('status_tagihan_id', $laporan->status_tagihan_id) }}">
                                        <option value="" selected>-- Pilih Status Tagihan --</option>
                                        @foreach ($statustagihanmany as $status_tagihan)
                                        <option value="{{ $status_tagihan->id }}" {{ old('status_tagihan_id') == $status_tagihan->id ? 'selected' : '' }}>{{ $status_tagihan->nama_status_tagihan }}</option>
                                        @endforeach
                                    </select>
                                    <span id="status_tagihan_id_error" style="display: none; color: red;">status_tagihan harus "CASH & BANK" jika ingin menyimpan!</span>
                                    @error('status_tagihan_id')
                                    <div class="invalid-feedback">
                                        Status Tagihan Wajib Dipilih!!!
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end pr-5 mb-5">
                            <button type="submit" name="submit" class="btn btn-secondary mr-2" value="draft">Draft</button>
                            <button type="submit" name="submit" class="btn btn-primary" value="save" onclick="validateStatus()">Simpan</button>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<style>
    .is-invalid {
        border-color: red;
        /* Atau atur properti lainnya untuk mengubah tampilan field input menjadi merah */
    }
</style>
<script>
    function totalAktual() {
        let jasaAktual = document.getElementById('jasa_aktual').value.replace(/[^\d]/g, '');
        let materialAktual = document.getElementById('material_aktual').value.replace(/[^\d]/g, '');
        
        // Mengubah nilai mata uang dalam format teks menjadi angka
        let sumAktual = Number(jasaAktual.replace(/\./g, '')) + Number(materialAktual.replace(/\./g, ''));
        
        // Menampilkan hasil jumlah kembali dalam format mata uang dengan pemisah ribuan (.)
        let total_Aktual_input = document.getElementById('total_aktual');
        total_Aktual_input.value = sumAktual.toLocaleString('id-ID');
    }

    function formatCurrency(input) {
        // Menghilangkan semua karakter selain angka
        let rawValue = input.value.replace(/[^\d]/g, '');
        
        // Memastikan input tidak kosong
        if (rawValue) {
            // Mengubah angka menjadi format uang dengan pemisah ribuan (.)
            let formattedValue = Number(rawValue).toLocaleString('id-ID');
            
            // Menampilkan hasil format uang di input
            input.value = formattedValue;
        }
    }
    function validateStatusTagihan() {
    // Find the dropdown element
    var statustagihanDropdown = document.getElementById('status_tagihan_id');

    // Check if the "Simpan" button is clicked and if the status is not "CASH IN"
    var simpanButton = document.querySelector('button[value="save"]');
    if (simpanButton && statustagihanDropdown.value != 10) {
        // Add the 'is-invalid' class to the dropdown to show the error state
        statustagihanDropdown.classList.add('is-invalid');
        // Display the error message
        var errorMessage = document.getElementById('status_tagihan_id_error');
        errorMessage.style.display = 'block';

        // Prevent form submission
        event.preventDefault();
    }
}
</script>
@endsection