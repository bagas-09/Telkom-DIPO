@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
<div class="section-body">
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
                        <input type="text" id="PID_maintenance" name="PID_maintenance" class="form-control mb-2" >
                        <span id="PID_maintenance_error" style="display: none; color: red;">Field PID Maintenance harus diisi!</span>

                        <label for="ID_SAP_maintenance" class="col-form-label">ID SAP Maintenance: </label>
                        <input type="text" id="ID_SAP_maintenance" name="ID_SAP_maintenance" class="form-control mb-2" >
                        <span id="ID_SAP_maintenance_error" style="display: none; color: red;">Field ID SAP Maintenance harus diisi!</span>

                        <label for="NO_PR_maintenance" class="col-form-label">No PR Maintenance: </label>
                        <input type="text" id="NO_PR_maintenance" name="NO_PR_maintenance" class="form-control mb-2" >
                        <span id="NO_PR_maintenance_error" style="display: none; color: red;">Field No PR Maintenance harus diisi!</span>
                        
                        <label for="tanggal_PR" class="col-form-label">Tanggal PR: </label>
                        <input type="date" id="tanggal_PR" name="tanggal_PR" class="form-control mb-2" >
                        <span id="tanggal_PR_error" style="display: none; color: red;">Field Tanggal PR harus diisi!</span>

                        <label for="status_pekerjaan_id" class="col-form-label">Status Pekerjaan: </label>
                        <select class="status_pekerjaan_id form-control mb-2" name="status_pekerjaan_id">
                            <option  selected>-- Pilih Status Pekerjaan --</option>
                            @foreach ($addsp as $status_pekerjaan)
                                <option value=<?= $status_pekerjaan->id ?>>{{ $status_pekerjaan->nama_status_pekerjaan }}</option>
                            @endforeach
                        </select>
                        <span id="status_pekerjaan_id_error" style="display: none; color: red;">Field Status Pekerjaan harus diisi!</span>

                        <label for="mitra_id" class="col-form-label">Mitra: </label>
                        <select class="mitra_id form-control mb-2" name="mitra_id">
                            <option selected>-- Pilih Mitra --</option>
                            @foreach ($mitrass as $mitra)
                                <option value=<?= $mitra->id ?>>{{ $mitra->nama_mitra }}</option>
                            @endforeach
                        </select>
                        <span id="mitra_id_error" style="display: none; color: red;">Field Mitra harus diisi!</span>

                        <label for="tipe_kemitraan_id" class="col-form-label">Tipe Kemitraan: </label>
                        <select class="tipe_kemitraan_id form-control mb-2" name="tipe_kemitraan_id">
                            <option  selected>-- Pilih Tipe Kemitraan --</option>
                            @foreach ($tipek as $tipe_kemitraan)
                                <option value=<?= $tipe_kemitraan->id ?>>{{ $tipe_kemitraan->nama_tipe_kemitraan }}</option>
                            @endforeach
                        </select>
                        <span id="tipe_kemitraan_id_error" style="display: none; color: red;">Field Tipe Kemitraan harus diisi!</span>

                        <label for="jenis_program_id" class="col-form-label">Jenis Program: </label>
                            <select class="jenis_program_id form-control mb-2" name="jenis_program_id">
                                <option  selected>-- Pilih Jenis Program --</option>
                                @foreach ($jenisp as $jenis_program)
                                    <option value=<?= $jenis_program->id ?>>{{ $jenis_program->nama_jenis_program }}</option>
                                @endforeach
                            </select>
                        <span id="jenis_program_id_error" style="display: none; color: red;">Field Jenis Program harus diisi!</span>

                        <label for="tipe_provisioning_id" class="col-form-label">Tipe Provisioning: </label>
                            <select class="tipe_provisioning_id form-control mb-2" name="tipe_provisioning_id" id="inputTipeProv" onchange="autoGeneratedLokasi()">
                                <option value="" selected>-- Pilih Tipe Provisioning --</option>
                                @foreach ($tipeprov as $tipe_provisioning)
                                    <option value=<?= $tipe_provisioning->id ?>>{{ $tipe_provisioning->nama_tipe_provisioning }}</option>
                                @endforeach
                            </select>
                        <span id="tipe_provisioning_id_error" style="display: none; color: red;">Field Tipe Provisioning harus diisi!</span>


                        {{-- <label for="keterangan" class="col-form-label">Keterangan: </label>
                        <input type="text" id="keterangan" name="keterangan" class="form-control mb-2" > --}}
                        {{-- <textarea id="keterangan" name="keterangan" class="form-control" rows="10" cols="500"></textarea> --}}
                        {{-- <span id="keterangan_error" style="display: none; color: red;">Field Keterangan harus diisi!</span> --}}
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
                                    <input type="text" class="form-control lokasi" id="lokasi" name="lokasi">
                                </div>
                            </div>
                            <span id="lokasi_error" style="display: none; color: red;">Field Lokasi harus diisi!</span>

                            <label for="periode_pekerjaan" class="col-form-label">Periode Pekerjaan: </label>
                            <input type="text" id="periode_pekerjaan" name="periode_pekerjaan" class="form-control mb-2" >
                            <span id="periode_pekerjaan_error" style="display: none; color: red;">Field No PR Maintenance harus diisi!</span>
                            
                            <label for="material_DRM" class="col-form-label">Material DRM: </label>
                            <input type="number" id="material_DRM" name="material_DRM" class="form-control mb-2" onkeyup="totalDRM()">
                            <span id="material_DRM_error" style="display: none; color: red;">Field Material DRM harus diisi!</span>

                            <label for="jasa_DRM" class="col-form-label">Jasa DRM: </label>
                            <input type="number" id="jasa_DRM" name="jasa_DRM" class="form-control mb-2" onkeyup="totalDRM()">
                            <span id="jasa_DRM_error" style="display: none; color: red;">Field Jasa DRM harus diisi!</span>

                            <label for="total_DRM" class="col-form-label">Total DRM: </label>
                            <input type="number" id="total_DRM" name="total_DRM" class="form-control mb-2" onkeyup="totalDRM()" disabled>
                            <span id="total_DRM_error" style="display: none; color: red;">Field Total DRM harus diisi!</span>

                            <label for="material_aktual" class="col-form-label">Material Aktual: </label>
                            <input type="number" id="material_aktual" name="material_aktual" class="form-control mb-2" onkeyup="totalAktual()">
                            <span id="material_aktual_error" style="display: none; color: red;">Field Material Aktual harus diisi!</span>

                            <label for="jasa_aktual" class="col-form-label">Jasa Aktual: </label>
                            <input type="number" id="jasa_aktual" name="jasa_aktual" class="form-control mb-2" onkeyup="totalAktual()">
                            <span id="jasa_aktual_error" style="display: none; color: red;">Field Jasa Aktual harus diisi!</span>

                            <label for="total_aktual" class="col-form-label">Total Aktual: </label>
                            <input type="number" id="total_aktual" name="total_aktual" class="form-control mb-2" onkeyup="totalAktual()" disabled>
                            <span id="total_aktual_error" style="display: none; color: red;">Field Total Aktual harus diisi!</span>

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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
    
    if(jenisProgram.options[jenisProgram.selectedIndex].text === "QE RECOVERY-DISTRIBUSI" || jenisProgram.value === "QE RECOVERY-FEEDER" || jenisProgram.value === "QE RECOVERY-ODC" || jenisProgram.value === "QE RECOVERY-ODP" || jenisProgram.value === "QE RELOKASI UTILITAS" || jenisProgram.value === "QE HEM" || jenisProgram.value === "QE ACCESS"){
        autoGenerated.innerText = jenisProgram.options[jenisProgram.selectedIndex].text + " - " + tipeProv.options[tipeProv.selectedIndex].text + " - "
    } else {
        autoGenerated.innerText = " "
    }  
  }

  // TOTAL AKTUAL DAN TOTAL DRM
  function totalAktual(){
    let jasaAktual = document.getElementById('jasa_aktual').value;
    let materialAktual = document.getElementById('material_aktual').value;
    let sumAktual = Number(jasaAktual) + Number(materialAktual);
    let totalAktual = document.getElementById('total_aktual').value = sumAktual;
  }

  function totalDRM(){
    let jasaDRM = document.getElementById('jasa_DRM').value;
    let materialDRM = document.getElementById('material_DRM').value;
    let sumDRM = Number(jasaDRM) + Number(materialDRM);
    let totalDRM = document.getElementById('total_DRM').value = sumDRM;
  }

  // FORMAT RUPIAH
  
//   console.log(autoGeneratedLokasi()); 
</script>
@endsection