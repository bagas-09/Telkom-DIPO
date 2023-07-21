@extends('layouts.admin-master')

@section('title')

@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan Commerce</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Forms</a></div>
            <div class="breadcrumb-item">Laporan Commerce</div>
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
                    <div class="px-5 pt-4" style="font-size: 140%"><b>Buat Laporan dari Konstruksi</b></div>
                    <div class="px-5 pt-2 pb-0">Buat Laporan sesuai dengan ketentuan dan SOP yang berlaku di Telkom Akses. Anda dapat mengubah laporan ini nanti.</div>
                    <form id="cityForm" action="{{route('commerce.laporan.store_konstruksi', [$id])}}" method="POST">
                        <div class="row">
                            @csrf
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pl-5 mb-0 pb-0">
                                    <label for="PID_konstruksi_id" class="col-form-label">PID Konstruksi: </label>
                                    <input type="text" id="PID_konstruksi_id" name="PID_konstruksi_id" class="form-control @error('PID_konstruksi_id') is-invalid @enderror mb-2" value="{{ old('PID_konstruksi_id', $id) }}" readonly>
                                    @error('PID_konstruksi_id')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <label for="lokasi" class="col-form-label">Lokasi: </label>
                                    <input type="text" id="lokasi" name="lokasi" class="form-control mb-2" value="{{ old('lokasi', $lokasi) }}" readonly>

                                    <label for="no_PO" class="col-form-label">Nomor PO: </label>
                                    <input type="text" id="no_PO" name="no_PO" class="form-control @error('no_PO') is-invalid @enderror mb-2" value="{{ old('no_PO') }}">
                                    @error('no_PO')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <label for="tanggal_PO" class="col-form-label">Tanggal PO: </label>
                                    <input type="date" id="tanggal_PO" name="tanggal_PO" class="form-control @error('tanggal_PO') is-invalid @enderror mb-2" value="{{ old('tanggal_PO') }}">
                                    @error('tanggal_PO')
                                    <div class="invalid-feedback">
                                        Tanggal PO Wajib Diisi!!!
                                    </div>
                                    @enderror
                                    <label for="No_SP" class="col-form-label">Nomor SP: </label>
                                    <input type="text" id="No_SP" name="No_SP" class="form-control @error('No_SP') is-invalid @enderror mb-2" value="{{ old('No_SP') }}">
                                    @error('No_SP')
                                    <div class="invalid-feedback">
                                        Nomor SP Wajib Diisi!!!
                                    </div>
                                    @enderror
                                    <label for="tanggal_SP" class="col-form-label">Tanggal SP: </label>
                                    <input type="date" id="tanggal_SP" name="tanggal_SP" class="form-control @error('tanggal_SP') is-invalid @enderror mb-2" value="{{ old('tanggal_SP') }}">
                                    @error('tanggal_SP')
                                    <div class="invalid-feedback">
                                        Tanggal SP Wajib Diisi!!!
                                    </div>
                                    @enderror
                                    <label for="TOC" class="col-form-label">TOC: </label>
                                    <input type="date" id="TOC" name="TOC" class="form-control @error('TOC') is-invalid @enderror mb-2" value="{{ old('TOC') }}">
                                    @error('TOC')
                                    <div class="invalid-feedback">
                                        TOC Wajib Diisi!!!
                                    </div>
                                    @enderror

                                    <label for="No_BAUT" class="col-form-label">Nomor BAUT: </label>
                                    <input type="text" id="No_BAUT" name="No_BAUT" class="form-control @error('No_BAUT') is-invalid @enderror mb-2" value="{{ old('No_BAUT') }}">
                                    @error('No_BAUT')
                                    <div class="invalid-feedback">
                                        Nomor BAUT Wajib Diisi!!!
                                    </div>
                                    @enderror

                                    <label for="tanggal_BAUT" class="col-form-label">Tanggal BAUT: </label>
                                    <input type="date" id="tanggal_BAUT" name="tanggal_BAUT" class="form-control @error('tanggal_BAUT') is-invalid @enderror mb-2" value="{{ old('tanggal_BAUT') }}">
                                    @error('tanggal_BAUT')
                                    <div class="invalid-feedback">
                                        Tanggal BAUT Wajib Diisi!!!
                                    </div>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pr-5 mb-0">
                                    <label for="NO_BAR" class="col-form-label">Nomor BAR: </label>
                                    <input type="text" id="NO_BAR" name="NO_BAR" class="form-control @error('NO_BAR') is-invalid @enderror mb-2" value="{{ old('NO_BAR') }}">
                                    @error('NO_BAR')
                                    <div class="invalid-feedback">
                                        Nomor BAR Wajib Diisi!!!
                                    </div>
                                    @enderror
                                    <label for="tanggal_BAR" class="col-form-label">Tanggal BAR: </label>
                                    <input type="date" id="tanggal_BAR" name="tanggal_BAR" class="form-control @error('tanggal_BAR') is-invalid @enderror mb-2" value="{{ old('tanggal_BAR') }}">
                                    @error('tanggal_BAR')
                                    <div class="invalid-feedback">
                                        Tanggal BAR Wajib Diisi!!!
                                    </div>
                                    @enderror
                                    <label for="NO_BAST" class="col-form-label">Nomor BAST: </label>
                                    <input type="text" id="NO_BAST" name="NO_BAST" class="form-control @error('NO_BAST') is-invalid @enderror mb-2" value="{{ old('NO_BAST') }}">
                                    @error('NO_BAST')
                                    <div class="invalid-feedback">
                                        Nomor BAST Wajib Diisi!!!
                                    </div>
                                    @enderror
                                    <label for="tanggal_BAST" class="col-form-label">Tanggal BAST: </label>
                                    <input type="date" id="tanggal_BAST" name="tanggal_BAST" class="form-control @error('tanggal_BAST') is-invalid @enderror mb-2" value="{{ old('tanggal_BAST') }}">
                                    @error('tanggal_BAST')
                                    <div class="invalid-feedback">
                                        Tanggal BAST Wajib Diisi!!!
                                    </div>
                                    @enderror

                                    <label for="material_aktual" class="col-form-label">Material Aktual: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="material_aktual" name="material_aktual" class="form-control @error('material_aktual') is-invalid @enderror mb-2" onkeyup="totalAktual()" oninput="formatCurrency(this)" value="{{ old('material_aktual') }}">
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
                                        <input type="text" id="jasa_aktual" name="jasa_aktual" class="form-control @error('jasa_aktual') is-invalid @enderror mb-2" onkeyup="totalAktual()" oninput="formatCurrency(this)" value="{{ old('jasa_aktual') }}">
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
                                        <input type="text" id="total_aktual" name="total_aktual" class="form-control @error('total_aktual') is-invalid @enderror mb-2" onkeyup="totalAktual()" oninput="formatCurrency(this)" value="{{ old('total_aktual') }}" readonly>
                                        <span id="total_aktual_error" style="display: none; color: red;">Field Total Aktual harus diisi!</span>
                                        @error('total_aktual')
                                        <div class="invalid-feedback">
                                            Total Aktual Wajib Diisi!!!
                                        </div>
                                        @enderror
                                    </div>
                                    <label for="status_id" class="col-form-label">Status: </label>
                                    <select class="form-control @error('status_id') is-invalid @enderror mb-2" name="status_id" id="status_id" value="">
                                        <option value="" selected>-- Pilih Status --</option>
                                        @foreach ($statusmany as $status)
                                        <option value="{{ $status->id }}" @selected(old('status_id') == $status->id)>{{ $status->nama_status }}</option>
                                        @endforeach
                                    </select>
                                    @error('status_id')
                                    <div class="invalid-feedback">
                                        Status Wajib Dipilih!!!
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end pr-5 mb-5">
                            <button type="submit" name="submit" class="btn btn-secondary mr-2" value="draft">Draft</button>
                            <button type="submit" name="submit" class="btn btn-primary" value="save">Simpan</button>
                        </div>
                    </form>
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
</script>
@endsection