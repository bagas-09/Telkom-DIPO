@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
    <div class="section-header">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- ADD LAPORAN MAINTENANCE -->
                <div class="card-body d-flex justify-content-start" style="padding-bottom:0; margin-bottom:0;">
                    <div class="breadcrumb-item"><a href="/laporanmaintenance">Laporan Maintenance</a></div>
                    <div class="breadcrumb-item active">Buat Laporan Maintenance</div>
                </div>
                <div class="card-header" style="padding-bottom:0;">
                    <div class="col-12">
                        <h3>Laporan Maintenance</h3>
                    </div>
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
                
                <p style="padding-left: 43px; padding-bottom:10px">Buat Laporan sesuai dengan ketentuan dan SOP yang berlaku di Telkom Akses. Anda dapat mengubah laporan ini nanti.</p>
            </div>
        </div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="px-5 pt-4" style="font-size: 140%"><b>Buat Laporan</b></div>
                <div class="px-5 pt-2 pb-0">Sesuaikan data yang dibutuhkan dalam membuat laporan</div>
                <form id="laporanmaintenanceForm" action="{{route('maintenance.storeLaporanMaintenance')}}" method="POST">
                
                @csrf    
                <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group pt-4 pb-0 pl-5 mb-0 pb-0">
                        <label for="PID_maintenance" class="col-form-label">PID Maintenance: </label>
                        <input type="text" id="PID_maintenance" name="PID_maintenance" class="form-control @error('PID_maintenance') is-invalid @enderror mb-2" value="{{ old('PID_maintenance') }}" >
                        <span id="PID_maintenance_error" style="display: none; color: red;">Field PID Maintenance harus diisi!</span>
                        @error('PID_maintenance')
                        <div class="invalid-feedback">
                            PID Wajib Diisi!
                        </div>
                        @enderror

                        <label for="ID_SAP_maintenance" class="col-form-label">ID SAP Maintenance: </label>
                        <input type="text" id="ID_SAP_maintenance" name="ID_SAP_maintenance" class="form-control @error('ID_SAP_maintenance') is-invalid @enderror mb-2" value="{{ old('ID_SAP_maintenance') }}" >
                        <span id="ID_SAP_maintenance_error" style="display: none; color: red;">Field ID SAP Maintenance harus diisi!</span>
                        @error('ID_SAP_maintenance')
                        <div class="invalid-feedback">
                            ID SAP Wajib Diisi!
                        </div>
                        @enderror

                        <label for="NO_PR_maintenance" class="col-form-label">No PR Maintenance: </label>
                        <input type="text" id="NO_PR_maintenance" name="NO_PR_maintenance" class="form-control @error('NO_PR_maintenance') is-invalid @enderror mb-2" value="{{ old('NO_PR_maintenance') }}" >
                        <span id="NO_PR_maintenance_error" style="display: none; color: red;">Field No PR Maintenance harus diisi!</span>
                        @error('NO_PR_maintenance')
                        <div class="invalid-feedback">
                            NO PR Wajib Diisi!
                        </div>
                        @enderror

                        <label for="tanggal_PR" class="col-form-label">Tanggal PR: </label>
                        <input type="date" id="tanggal_PR" name="tanggal_PR" class="form-control @error('tanggal_PR') is-invalid @enderror mb-2" value="{{ old('tanggal_PR') }}" >
                        <span id="tanggal_PR_error" style="display: none; color: red;">Field Tanggal PR harus diisi!</span>
                        @error('tanggal_PR')
                        <div class="invalid-feedback">
                            Tanggal PR Wajib Diisi!
                        </div>
                        @enderror

                        <label for="status_pekerjaan_id" class="col-form-label">Status Pekerjaan: </label>
                        <select name="status_pekerjaan_id" id="status_pekerjaan_id" class="form-control @error('status_pekerjaan_id') is-invalid @enderror mb-2" value="{{ old('status_pekerjaan_id') }}" >
                            <option value="" selected>-- Pilih Status Pekerjaan --</option>
                            @foreach ($addsp as $status_pekerjaan)
                                <option value=<?= $status_pekerjaan->id ?>>{{ $status_pekerjaan->nama_status_pekerjaan }}</option>
                            @endforeach
                        </select>
                        <span id="status_pekerjaan_id_error" style="display: none; color: red;">Field Status Pekerjaan harus diisi!</span>
                        @error('status_pekerjaan_id')
                            <div class="invalid-feedback">
                                Status Pekerjaan Wajib Dipilih!!!
                            </div>
                        @enderror

                        <label for="mitra_id" class="col-form-label">Mitra: </label>
                        <select class="form-control @error('mitra_id') is-invalid @enderror mb-2" name="mitra_id" id="mitra_id" value="{{ old('mitra_id') }}" >
                            <option value="" selected>-- Pilih Mitra --</option>
                            @foreach ($mitrass as $mitra)
                                <option value=<?= $mitra->id ?>>{{ $mitra->nama_mitra }}</option>
                            @endforeach
                        </select>
                        <span id="mitra_id_error" style="display: none; color: red;">Field Mitra harus diisi!</span>
                        @error('mitra_id')
                                    <div class="invalid-feedback">
                                        Mitra Wajib Dipilih!!!
                                    </div>
                                    @enderror

                        <label for="tipe_kemitraan_id" class="col-form-label">Tipe Kemitraan: </label>
                        <select class="form-control @error('tipe_kemitraan_id') is-invalid @enderror mb-2" name="tipe_kemitraan_id" id="tipe_kemitraan_id" value="{{ old('tipe_kemitraan_id') }}" >
                            <option value="" selected>-- Pilih Tipe Kemitraan --</option>
                            @foreach ($tipek as $tipe_kemitraan)
                                <option value=<?= $tipe_kemitraan->id ?>>{{ $tipe_kemitraan->nama_tipe_kemitraan }}</option>
                            @endforeach
                        </select>
                        <span id="tipe_kemitraan_id_error" style="display: none; color: red;">Field Tipe Kemitraan harus diisi!</span>
                        @error('tipe_kemitraan_id')
                                    <div class="invalid-feedback">
                                        Tipe Kemitraan Wajib Dipilih!!!
                                    </div>
                                    @enderror

                        <label for="jenis_program_id" class="col-form-label">Jenis Program: </label>
                            <select class="form-control @error('jenis_program_id') is-invalid @enderror mb-2" name="jenis_program_id" id="inputJenisProgram" value="{{ old('jenis_program_id') }}"  onchange="autoGeneratedLokasi()">
                                <option value="" selected>-- Pilih Jenis Program --</option>
                                @foreach ($jenisp as $jenis_program)
                                    <option value=<?= $jenis_program->id ?>>{{ $jenis_program->nama_jenis_program }}</option>
                                @endforeach
                            </select>
                        <span id="jenis_program_id_error" style="display: none; color: red;">Field Jenis Program harus diisi!</span>
                        @error('jenis_program_id')
                            <div class="invalid-feedback">
                                Jenis Program Wajib Dipilih!!!
                            </div>
                        @enderror

                        <label for="tipe_provisioning_id" class="col-form-label">Tipe Provisioning: </label>
                            <select class="form-control @error('tipe_provisioning_id') is-invalid @enderror mb-2" name="tipe_provisioning_id" id="inputTipeProv" value="{{ old('tipe_provisioning_id') }}"  onchange="autoGeneratedLokasi()">
                                <option value="" selected>-- Pilih Tipe Provisioning --</option>
                                @foreach ($tipeprov as $tipe_provisioning)
                                    <option value=<?= $tipe_provisioning->id ?>>{{ $tipe_provisioning->nama_tipe_provisioning }}</option>
                                @endforeach
                            </select>
                        @error('tipe_provisioning_id')
                                    <div class="invalid-feedback">
                                        Tipe Provisioning Wajib Dipilih!!!
                                    </div>
                                    @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group pt-4 pb-0 pr-5 mb-0">
                            <div class="form-group mb-2">
                                <label>Lokasi</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <p id="autoFill" style="padding-top: 15px"></p>
                                        </div>
                                    </div>
                                    <input type="text" id="lokasi" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror mb-2" value="{{ old('lokasi') }}" >
                                </div>
                            </div>
                            <span id="lokasi_error" style="display: none; color: red;">Field Lokasi harus diisi!</span>
                            @error('lokasi')
                                <div class="invalid-feedback">
                                    Lokasi Wajib Diisi!!!
                                </div>
                            @enderror

                            <label for="periode_pekerjaan" class="col-form-label">Periode Pekerjaan: </label>
                            <input type="text" id="periode_pekerjaan" name="periode_pekerjaan" class="form-control @error('periode_pekerjaan') is-invalid @enderror mb-2" value="{{ old('periode_pekerjaan') }}"  >
                            <span id="periode_pekerjaan_error" style="display: none; color: red;">Field No PR Maintenance harus diisi!</span>
                            @error('periode_pekerjaan')
                            <div class="invalid-feedback">
                                Periode Pekerjaan Wajib Diisi!!!
                            </div>
                            @enderror

                            <label for="material_DRM" class="col-form-label">Material DRM: </label>
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" id="material_DRM" name="material_DRM" value="{{ old('material_DRM') }}" class="form-control @error('material_DRM') is-invalid @enderror mb-2" onkeyup="totalDRM();" oninput="formatCurrency(this)">  
                                </div>
                            <span id="material_DRM_error" style="display: none; color: red;">Field Material DRM harus diisi!</span>
                            @error('material_DRM')
                                        <div class="invalid-feedback">
                                            Material DRM Wajib Diisi!!!
                                        </div>
                                        @enderror

                            <label for="jasa_DRM" class="col-form-label">Jasa DRM: </label>
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" id="jasa_DRM" name="jasa_DRM" value="{{ old('jasa_DRM') }}" class="form-control @error('jasa_DRM') is-invalid @enderror mb-2" onkeyup="totalDRM()" oninput="formatCurrency(this)">
                                </div>
                            <span id="jasa_DRM_error" style="display: none; color: red;">Field Jasa DRM harus diisi!</span>
                            @error('material_DRM')
                                        <div class="invalid-feedback">
                                            Jasa DRM Wajib Diisi!!!
                                        </div>
                                        @enderror

                            <label for="total_DRM" class="col-form-label">Total DRM: </label>
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" id="total_DRM" name="total_DRM" value="{{ old('total_DRM') }}" class="form-control @error('total_DRM') is-invalid @enderror mb-2" onkeyup="totalDRM()" readonly>
                                </div>
                            <span id="total_DRM_error" style="display: none; color: red;">Field Total DRM harus diisi!</span>
                            @error('total_DRM')
                                        <div class="invalid-feedback">
                                            Total DRM Wajib Diisi!!!
                                        </div>
                                        @enderror

                            <label for="material_aktual" class="col-form-label">Material Aktual: </label>
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" id="material_aktual" name="material_aktual" value="{{ old('material_aktual') }}" class="form-control @error('material_aktual') is-invalid @enderror mb-2" onkeyup="totalAktual()" oninput="formatCurrency(this)">
                                </div>
                            @error('material_aktual')
                                        <div class="invalid-feedback">
                                            Material Aktual Wajib Diisi!!!
                                        </div>
                                        @enderror

                            <label for="jasa_aktual" class="col-form-label">Jasa Aktual: </label>
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" id="jasa_aktual" name="jasa_aktual" value="{{ old('jasa_aktual') }}" class="form-control @error('jasa_aktual') is-invalid @enderror mb-2" onkeyup="totalAktual()" oninput="formatCurrency(this)">
                                </div>
                            @error('jasa_aktual')
                                <div class="invalid-feedback">
                                    Jasa Aktual Wajib Diisi!!!
                                </div>
                            @enderror

                            <label for="total_aktual" class="col-form-label">Total Aktual: </label>
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" id="total_aktual" name="total_aktual" value="{{ old('total_aktual') }}" class="form-control @error('total_aktual') is-invalid @enderror mb-2" onkeyup="totalAktual()" oninput="formatCurrency(this)" readonly>
                                </div>
                            @error('total_aktual')
                                <div class="invalid-feedback">
                                    Jasa Aktual Wajib Diisi!!!
                                </div>
                            @enderror

                        </div>
                    </div>
                    </div>
                    <div class="row mb-lg-5">
                        <div class="col-lg-12" style="padding: 0 62px">
                            <div class="form-group pb-0 mb-0">
                                <label for="keterangan" class="col-form-label">Keterangan:</label>
                                <input type="text" id="keterangan" name="keterangan" class="form-control mb-2">
                                {{-- <textarea id="keterangan" name="keterangan" class="form-control" rows="10" cols="500"></textarea> --}}
                                <span id="keterangan_error" style="display: none; color: red;">Field Keterangan harus diisi!</span>
                            </div>
                        </div>
                            
                    </div>
                    <div class="d-flex justify-content-end pr-5 mb-5">
                        <button class="btn btn-primary" value="Simpan Data" type="submit">Buat Laporan</button>
                    </div>

                    
                </div>
            </form>
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
    // AUTO GENERATED LOKASI
    function autoGeneratedLokasi() {
    var jenisProgram = document.getElementById('inputJenisProgram');
    var tipeProv = document.getElementById('inputTipeProv');
    var autoGenerated = document.getElementById('autoFill');
    var inputLokasi = document.getElementById('lokasi');

    // console.log(autoGenerated.innerText, "<----- INI AUTO GENERATED")
    console.log(jenisProgram.options[jenisProgram.selectedIndex].text)
    
    if(jenisProgram.options[jenisProgram.selectedIndex].text === "QE RECOVERY-DISTRIBUSI" || jenisProgram.options[jenisProgram.selectedIndex].text === "QE RECOVERY-FEEDER" || jenisProgram.options[jenisProgram.selectedIndex].text === "QE RECOVERY-ODC" || jenisProgram.options[jenisProgram.selectedIndex].text === "QE RECOVERY-ODP" || jenisProgram.options[jenisProgram.selectedIndex].text === "QE RELOKASI UTILITAS" || jenisProgram.options[jenisProgram.selectedIndex].text === "QE HEM" || jenisProgram.options[jenisProgram.selectedIndex].text === "QE ACCESS"){
        autoGenerated.innerText = jenisProgram.options[jenisProgram.selectedIndex].text + " - " + tipeProv.options[tipeProv.selectedIndex].text + " - "
        // console.log(autoGenerated.innerText = jenisProgram.options[jenisProgram.selectedIndex].text, "<----- INI AUTO GENERATED")
    } else {
        autoGenerated.innerText = " "
    }  
  }

  // TOTAL AKTUAL DAN TOTAL DRM
  function totalAktual() {
        let jasaAktual = document.getElementById('jasa_aktual').value.replace(/[^\d]/g, '');
        let materialAktual = document.getElementById('material_aktual').value.replace(/[^\d]/g, '');
        
        // Mengubah nilai mata uang dalam format teks menjadi angka
        let sumAktual = Number(jasaAktual.replace(/\./g, '')) + Number(materialAktual.replace(/\./g, ''));
        
        // Menampilkan hasil jumlah kembali dalam format mata uang dengan pemisah ribuan (.)
        let total_Aktual_input = document.getElementById('total_aktual');
        total_Aktual_input.value = sumAktual.toLocaleString('id-ID');
    }

    function totalDRM() {
        let jasaDRM = document.getElementById('jasa_DRM').value.replace(/[^\d]/g, '');
        let materialDRM = document.getElementById('material_DRM').value.replace(/[^\d]/g, '');
        
        // Mengubah nilai mata uang dalam format teks menjadi angka
        let sumDRM = Number(jasaDRM.replace(/\./g, '')) + Number(materialDRM.replace(/\./g, ''));
        
        // Menampilkan hasil jumlah kembali dalam format mata uang dengan pemisah ribuan (.)
        let total_DRM_input = document.getElementById('total_DRM');
        total_DRM_input.value = sumDRM.toLocaleString('id-ID');
    }

    // FORMAT RUPIAH
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
  
//   console.log(autoGeneratedLokasi()); 
</script>
@endsection