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
                    <div class="breadcrumb-item"><a href="{{ route('maintenance.laporanMaintenance.index') }}">Laporan Maintenance</a></div>
                    <div class="breadcrumb-item active">Buat Laporan Maintenance</div>
                </div>
                <div class="card-header" style="padding-bottom:0;">
                    <div class="col-12">
                        <h3>Maintenance Report</h3>
                    </div>
                </div>
        
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
                <form action="{{route('maintenance.storeLaporanMaintenance')}}" method="POST">
                
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
                    </div>
                </div>
                    <div class="col-lg-6">
                        <div class="form-group pt-4 pb-0 pr-5 mb-0">
                            <div class="form-group mb-2">
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
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row mb-lg-5">
                        <div class="col-lg-12" style="padding: 0 62px">
                            <div class="form-group pb-0 mb-0">
                                <label for="keterangan" class="col-form-label">Keterangan:</label>
                                <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" class="form-control mb-2">
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