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
                {{-- ADD LAPORAN KONSTRUKSI --}}
                <div class="card-body d-flex justify-content-start" style="padding-bottom:0; margin-bottom:0;">
                    <div class="breadcrumb-item"><a href="/laporankonstruksi">Laporan Konstruksi</a></div>
                    <div class="breadcrumb-item active">Buat Laporan Konstruksi</div>
                </div>
                <div class="card-header" style="padding-bottom:0;">
                    <div class="col-12">
                        <h3>Construction Report</h3>
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
                @foreach ($konstruksi as $laporan)
                <form action="{{route('konstruksi.updateLaporanKonstruksi', [$id])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group pt-4 pb-0 pl-5 mb-0 pb-0">
                                <label for="PID_konstruksi" class="col-form-label">PID Konstruksi: </label>
                                <input type="text" id="PID_konstruksi" name="PID_konstruksi" class="form-control @error('PID_konstruksi') is-invalid @enderror mb-2" value="{{ old('PID_konstruksi', $laporan->PID_konstruksi) }}" >
                                <span id="PID_konstruksi_error" style="display: none; color: red;">Field PID Kontruksi harus diisi!</span>
                                @error('PID_konstruksi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <label for="ID_SAP_konstruksi" class="col-form-label">ID SAP Konstruksi: </label>
                                <input type="text" id="ID_SAP_konstruksi" name="ID_SAP_konstruksi" value="{{ old('ID_SAP_konstruksi', $laporan->slugk) }}" class="form-control @error('ID_SAP_konstruksi') is-invalid @enderror mb-2" readonly>
                                <span id="ID_SAP_konstruksi_error" style="display: none; color: red;">Field ID SAP Konstruksi harus diisi!</span>
                                @error('ID_SAP_konstruksi')
                                <div class="invalid-feedback">
                                    Field ID SAP Konstruksi harus diisi!
                                </div>
                                @enderror

                                <label for="NO_PR_konstruksi" class="col-form-label">No PR Konstruksi: </label>
                                <input type="text" id="NO_PR_konstruksi" name="NO_PR_konstruksi" value="{{ old('NO_PR_konstruksi', $laporan->NO_PR_konstruksi) }}" class="form-control @error('NO_PR_konstruksi') is-invalid @enderror mb-2">
                                <span id="NO_PR_Konstruksi_error" style="display: none; color: red;">Field No PR Konstruksi harus diisi!</span>
                                @error('NO_PR_konstruksi')
                                <div class="invalid-feedback">
                                    Field No PR Konstruksi harus diisi!
                                </div>
                                @enderror

                                <label for="tanggal_PR" class="col-form-label">Tanggal PR: </label>
                                <input type="date" id="tanggal_PR" name="tanggal_PR" value="{{ old('tanggal_PR', $laporan->tanggal_PR) }}" class="form-control @error('tanggal_PR') is-invalid @enderror mb-2">
                                <span id="tanggal_PR_error" style="display: none; color: red;">Field Tanggal PR harus diisi!</span>
                                @error('tanggal_PR')
                                <div class="invalid-feedback">
                                    Field Tanggal PR harus diisi!
                                </div>
                                @enderror

                                <label for="status_pekerjaan_id" class="col-form-label">Status Pekerjaan: </label>
                                <select class="status_pekerjaan_id form-control @error('status_pekerjaan_id') is-invalid @enderror mb-2" name="status_pekerjaan_id" value="{{ old('status_pekerjaan_id', $laporan->status_pekerjaan_id) }}">
                                    <option value="" selected>-- Pilih Status Pekerjaan --</option>
                                    @foreach ($addsp as $status_pekerjaan)
                                        <option value="{{ $status_pekerjaan->id }}" {{ strcmp($laporan->status_pekerjaan_id,"$status_pekerjaan->id")==0? 'selected':''; }}>{{ $status_pekerjaan->nama_status_pekerjaan }}</option>
                                    @endforeach
                                </select>
                                <span id="status_pekerjaan_id_error" style="display: none; color: red;">Field Status Pekerjaan harus diisi!</span>
                                @error('status_pekerjaan_id')
                                <div class="invalid-feedback">
                                    Field Status Pekerjaan harus diisi!
                                </div>
                                @enderror

                                <label for="mitra_id" class="col-form-label">Mitra: </label>
                                <select class="mitra_id form-control @error('mitra_id') is-invalid @enderror mb-2" name="mitra_id" value="{{ old('mitra_id', $laporan->mitra_id) }}">
                                    <option value="" selected>-- Pilih Mitra --</option>
                                    @foreach ($mitrass as $mitra)
                                        <option value="{{ $mitra->id }}" {{ strcmp($laporan->mitra_id,"$mitra->id")==0? 'selected':''; }}>{{ $mitra->nama_mitra }}</option>
                                    @endforeach
                                </select>
                                <span id="mitra_id_error" style="display: none; color: red;">Field Mitra harus diisi!</span>
                                @error('mitra_id')
                                <div class="invalid-feedback">
                                    Field Mitra harus diisi!
                                </div>
                                @enderror

                                <label for="tipe_kemitraan_id" class="col-form-label">Tipe Kemitraan: </label>
                                <select class="tipe_kemitraan_id form-control @error('tipe_kemitraan_id') is-invalid @enderror mb-2" name="tipe_kemitraan_id" value="{{ old('tipe_kemitraan_id', $laporan->tipe_kemitraan_id) }}">
                                    <option value="" selected>-- Pilih Tipe Kemitraan --</option>
                                    @foreach ($tipek as $tipe_kemitraan)
                                        <option value="{{ $tipe_kemitraan->id }}" {{ strcmp($laporan->tipe_kemitraan_id,"$tipe_kemitraan->id")==0? 'selected':''; }}>{{ $tipe_kemitraan->nama_tipe_kemitraan }}</option>
                                    @endforeach
                                </select>
                                <span id="tipe_kemitraan_id_error" style="display: none; color: red;">Field Tipe Kemitraan harus diisi!</span>
                                @error('tipe_kemitraan_id')
                                <div class="invalid-feedback">
                                    Field Tipe Kemitraan harus diisi!
                                </div>
                                @enderror

                                <label for="program_id" class="col-form-label">Program: </label>
                                    <select class="program_id form-control @error('program_id') is-invalid @enderror mb-2" name="program_id" value="{{ old('program_id', $laporan->program_id) }}" id="inputProgram">
                                        <option value="" selected>-- Pilih Program --</option>
                                        @foreach ($program as $program)
                                            <option value="{{ $program->id }}" {{ strcmp($laporan->program_id,"$program->id")==0? 'selected':''; }}>{{ $program->nama_program }}</option>
                                        @endforeach
                                    </select>
                                <span id="program_id_error" style="display: none; color: red;">Field Program harus diisi!</span>
                                @error('program_id')
                                <div class="invalid-feedback">
                                    Field Program harus diisi!
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group pt-4 pb-0 pr-5 mb-0">
                                <label for="tipe_provisioning_id" class="col-form-label">Tipe Provisioning: </label>
                                <select class="tipe_provisioning_id form-control @error('tipe_provisioning_id') is-invalid @enderror mb-2" name="tipe_provisioning_id" value="{{ old('tipe_provisioning_id', $laporan->tipe_provisioning_id) }}" id="inputTipeProv">
                                    <option value="" selected>-- Pilih Tipe Provisioning --</option>
                                    @foreach ($tipeprov as $tipe_provisioning)
                                        <option value="{{ $tipe_provisioning->id }}" {{ strcmp($laporan->tipe_provisioning_id,"$tipe_provisioning->id")==0? 'selected':''; }}>{{ $tipe_provisioning->nama_tipe_provisioning }}</option>
                                    @endforeach
                                </select>
                                <span id="tipe_provisioning_id_error" style="display: none; color: red;">Field Tipe Provisioning harus diisi!</span>
                                @error('tipe_provisioning_id')
                                <div class="invalid-feedback">
                                    Field Tipe Provisioning harus diisi!
                                </div>
                                @enderror

                                <div class="form-group mb-2">
                                    <label>Lokasi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <p id="autoFill" style="padding-top: 15px"></p>
                                                 
                                            </div>
                                        </div>
                                        <input type="text" class="form-control @error('lokasi') is-invalid @enderror lokasi" id="lokasi" name="lokasi" value="{{ old('lokasi', $laporan->lokasi) }}">
                                    </div>
                                </div>
                                <span id="lokasi_error" style="display: none; color: red;">Field Lokasi harus diisi!</span>
                                @error('lokasi')
                                <div class="invalid-feedback">
                                    Field Lokasi harus diisi!
                                </div>
                                @enderror

                                <label for="material_DRM" class="col-form-label">Material DRM: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" id="material_DRM" name="material_DRM" value="{{ old('material_DRM', $laporan->material_DRM) }}" class="form-control @error('material_DRM') is-invalid @enderror mb-2" onkeyup="totalDRM();" oninput="formatCurrency(this)">  
                                </div>
                                <span id="material_DRM_error" style="display: none; color: red;">Field Material DRM harus diisi!</span>
                                @error('material_DRM')
                                <div class="invalid-feedback">
                                    Field Material DRM harus diisi!
                                </div>
                                @enderror

                                <label for="jasa_DRM" class="col-form-label">Jasa DRM: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" id="jasa_DRM" name="jasa_DRM" value="{{ old('jasa_DRM', $laporan->jasa_DRM) }}" class="form-control @error('jasa_DRM') is-invalid @enderror mb-2" onkeyup="totalDRM()" oninput="formatCurrency(this)">
                                </div>
                                <span id="jasa_DRM_error" style="display: none; color: red;">Field Jasa DRM harus diisi!</span>
                                @error('jasa_DRM')
                                <div class="invalid-feedback">
                                    Field Jasa DRM harus diisi!
                                </div>
                                @enderror

                                <label for="total_DRM" class="col-form-label">Total DRM: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" id="total_DRM" name="total_DRM" value="{{ old('total_DRM', $laporan->total_DRM) }}" class="form-control @error('total_DRM') is-invalid @enderror mb-2" onkeyup="totalDRM()" readonly>
                                </div>
                                <span id="total_DRM_error" style="display: none; color: red;">Field Total DRM harus diisi!</span>
                                @error('total_DRM')
                                <div class="invalid-feedback">
                                    Field Total DRM harus diisi!
                                </div>
                                @enderror

                                <label for="material_aktual" class="col-form-label">Material Aktual: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" id="material_aktual" name="material_aktual" value="{{ old('material_aktual', $laporan->material_aktual) }}" class="form-control @error('material_aktual') is-invalid @enderror mb-2" onkeyup="totalAktual()" oninput="formatCurrency(this)">
                                </div>
                                <span id="material_aktual_error" style="display: none; color: red;">Field Material Aktual harus diisi!</span>
                                @error('material_aktual')
                                <div class="invalid-feedback">
                                    Field Material Aktual harus diisi!
                                </div>
                                @enderror

                                <label for="jasa_aktual" class="col-form-label">Jasa Aktual: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" id="jasa_aktual" name="jasa_aktual" value="{{ old('jasa_aktual', $laporan->jasa_aktual) }}" class="form-control @error('jasa_aktual') is-invalid @enderror mb-2" onkeyup="totalAktual()" oninput="formatCurrency(this)">
                                </div>
                                <span id="jasa_aktual_error" style="display: none; color: red;">Field Jasa Aktual harus diisi!</span>
                                @error('jasa_aktual')
                                <div class="invalid-feedback">
                                    Field Jasa Aktual harus diisi!
                                </div>
                                @enderror

                                <label for="total_aktual" class="col-form-label">Total Aktual: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" id="total_aktual" name="total_aktual" value="{{ old('total_aktual', $laporan->total_aktual) }}" class="form-control @error('total_aktual') is-invalid @enderror mb-2" onkeyup="totalAktual()" oninput="formatCurrency(this)" readonly>
                                </div> 
                                <span id="total_aktual_error" style="display: none; color: red;">Field Total Aktual harus diisi!</span>
                                @error('total_aktual')
                                <div class="invalid-feedback">
                                    Field Total Aktual harus diisi!
                                </div>
                                @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row mb-lg-5">
                            <div class="col-lg-12" style="padding: 0 62px">
                                <div class="form-group pb-0 mb-0">
                                    <label for="keterangan" class="col-form-label">Keterangan:</label>
                                    <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan', $laporan->keterangan) }}" class="form-control @error('keterangan') is-invalid @enderror mb-2">
                                    {{-- <textarea id="keterangan" name="keterangan" class="form-control" rows="10" cols="500"></textarea> --}}
                                    <span id="keterangan_error" style="display: none; color: red;">Field Keterangan harus diisi!</span>
                                    @error('keterangan')
                                    <div class="invalid-feedback">
                                        Field Keterangan harus diisi!
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end pr-5 mb-5">
                            <button class="btn btn-primary" name="submit" value="save" type="submit">Simpan</button>
                        </div>
                </form>
                @endforeach
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
    // document.addEventListener('DOMContentLoaded', function() {
    //     document.getElementById('inputProgram').addEventListener('change', autoGeneratedLokasi);
    //     document.getElementById('inputTipeProv').addEventListener('change', autoGeneratedLokasi);
        
    function autoGeneratedLokasi() {
        var Program = document.getElementById('inputProgram');
        var tipeProv = document.getElementById('inputTipeProv');
        var autoGenerated = document.getElementById('autoFill');
        var inputLokasi = document.getElementById('lokasi');
        
        if(Program.options[Program.selectedIndex].text === "Konsumer" || Program.options[Program.selectedIndex].text === "HEM" || Program.options[Program.selectedIndex].text === "Node B" || Program.options[Program.selectedIndex].text === "Node B OLO"){
            autoGenerated.innerText = Program.options[Program.selectedIndex].text + " - " + tipeProv.options[tipeProv.selectedIndex].text + " - "
        } else {
            autoGenerated.innerText = " "
        }
    }
    // });

  // TOTAL AKTUAL DAN TOTAL DRM
//   function totalAktual(){
//     let jasaAktual = document.getElementById('jasa_aktual').value;
//     let materialAktual = document.getElementById('material_aktual').value;
//     let sumAktual = Number(jasaAktual) + Number(materialAktual);
//     let totalAktual = document.getElementById('total_aktual').value = sumAktual;
//   }
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