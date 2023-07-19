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
                                    <input type="text" id="PID_konstruksi_id" name="PID_konstruksi_id" class="form-control mb-2" value="{{ old('PID_konstruksi_id', $id) }}" disabled>
                                    <span id="PID_konstruksi_id_error" style="display: none; color: red;">Field PID Kontruksi harus diisi!</span>

                                    <label for="lokasi" class="col-form-label">Lokasi: </label>
                                    <input type="text" id="lokasi" name="lokasi" class="form-control mb-2" value="{{ old('lokasi', $lokasi) }}" disabled>
                                    <span id="lokasi_error" style="display: none; color: red;">Field Lokasi harus diisi!</span>

                                    <label for="no_PO" class="col-form-label">Nomor PO: </label>
                                    <input type="text" id="no_PO" name="no_PO" class="form-control mb-2" value="">
                                    <span id="no_PO_error" style="display: none; color: red;">Field Nomor PO harus diisi!</span>

                                    <label for="tanggal_PO" class="col-form-label">Tanggal PO: </label>
                                    <input type="date" id="tanggal_PO" name="tanggal_PO" class="form-control mb-2" value="">
                                    <span id="tanggal_PO_error" style="display: none; color: red;">Field Tanggal PO harus diisi!</span>

                                    <label for="No_SP" class="col-form-label">Nomor SP: </label>
                                    <input type="text" id="No_SP" name="No_SP" class="form-control mb-2" value="">
                                    <span id="No_SP_error" style="display: none; color: red;">Field Nomor SP harus diisi!</span>

                                    <label for="tanggal_SP" class="col-form-label">Tanggal SP: </label>
                                    <input type="date" id="tanggal_SP" name="tanggal_SP" class="form-control mb-2" value="">
                                    <span id="tanggal_SP_error" style="display: none; color: red;">Field Tanggal SP harus diisi!</span>

                                    <label for="TOC" class="col-form-label">TOC: </label>
                                    <input type="date" id="TOC" name="TOC" class="form-control mb-2" value="">
                                    <span id="TOC_error" style="display: none; color: red;">Field TOC harus diisi!</span>

                                    <label for="No_BAUT" class="col-form-label">Nomor BAUT: </label>
                                    <input type="text" id="No_BAUT" name="No_BAUT" class="form-control mb-2" value="">
                                    <span id="No_BAUT_error" style="display: none; color: red;">Field Nomor BAUT harus diisi!</span>

                                    <label for="tanggal_BAUT" class="col-form-label">Tanggal BAUT: </label>
                                    <input type="date" id="tanggal_BAUT" name="tanggal_BAUT" class="form-control mb-2" value="">
                                    <span id="tanggal_BAUT_error" style="display: none; color: red;">Field Tanggal BAUT harus diisi!</span>


                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pr-5 mb-0">
                                    <label for="NO_BAR" class="col-form-label">Nomor BAR: </label>
                                    <input type="text" id="NO_BAR" name="NO_BAR" class="form-control mb-2" value="">
                                    <span id="NO_BAR_error" style="display: none; color: red;">Field Nomor BAR harus diisi!</span>

                                    <label for="tanggal_BAR" class="col-form-label">Tanggal BAR: </label>
                                    <input type="date" id="tanggal_BAR" name="tanggal_BAR" class="form-control mb-2" value="">
                                    <span id="tanggal_BAR_error" style="display: none; color: red;">Field Tanggal BAR harus diisi!</span>

                                    <label for="NO_BAST" class="col-form-label">Nomor BAST: </label>
                                    <input type="text" id="NO_BAST" name="NO_BAST" class="form-control mb-2" value="">
                                    <span id="NO_BAST_error" style="display: none; color: red;">Field Nomor BAST harus diisi!</span>

                                    <label for="tanggal_BAST" class="col-form-label">Tanggal BAST: </label>
                                    <input type="date" id="tanggal_BAST" name="tanggal_BAST" class="form-control mb-2" value="">
                                    <span id="tanggal_BAST_error" style="display: none; color: red;">Field Tanggal BAST harus diisi!</span>
                                    <label for="material_aktual" class="col-form-label">Material Aktual: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="number" id="material_aktual" name="material_aktual" class="form-control mb-2" onkeyup="calculator()" value="">
                                        <span id="material_aktual_error" style="display: none; color: red;">Field Material Aktual harus diisi!</span>
                                    </div>
                                    <label for="jasa_aktual" class="col-form-label">Jasa Aktual: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="number"  id="jasa_aktual" name="jasa_aktual" class="form-control mb-2" onkeyup="calculator()"  value="">
                                        <span id="jasa_aktual_error" style="display: none; color: red;">Field Jasa Aktual harus diisi!</span>
                                    </div>
                                    <label for="total_aktual" class="col-form-label">Total Aktual: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="number" id="total_aktual" name="total_aktual" class="form-control mb-2" onkeyup="calculator()" value="" disabled>
                                        <span id="total_aktual_error" style="display: none; color: red;">Field Total Aktual harus diisi!</span>
                                    </div>
                                    <label for="status_id" class="col-form-label">Status: </label>
                                    <select class="form-control mb-2" name="status_id" id="status_id">
                                        <option value="" selected>-- Pilih Status --</option>
                                        @foreach ($statusmany as $status)
                                        <option value=<?= $status->id ?>>{{ $status->nama_status }}</option>
                                        @endforeach
                                    </select>
                                    <span id="status_id_error" style="display: none; color: red;">Field Status harus diisi!</span>
                                </div>
                                <button type="submit" class="btn btn-primary" value="Simpan Data">Simpan Laporan</button>
                            </div>
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
    var jasaAktualInput = document.getElementById('jasa_aktual').value;
    // jasaAktualInput.addEventListener('input', function(e) {
    //     this.value = formatRupiah(this.value);
    // });

    function formatRupiah(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }
</script>
<script>
    var jasa = document.getElementById('jasa_aktual');
    jasa.addEventListener('keyup', function(e) {
        jasa.value = formatRupiah(this.value, 'Rp.');
        
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function calculator() {
        let jasa = document.getElementById('jasa_aktual').value;
        let material = document.getElementById('material_aktual').value;
        let sum = Number(jasa) + Number(material);
        let total = document.getElementById('total_aktual').value = sum;
    }
</script>
@endsection