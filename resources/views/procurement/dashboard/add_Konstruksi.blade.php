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
                    <div class="px-5 pt-4" style="font-size: 140%"><b>Laporan Konstruksi</b></div>
                    <div class="px-5 pt-2 pb-0">Berikut merupakan Laporan Konstruksi yang akan dinilai</div>
                    @foreach ($tuket as $laporan)
                        
                    
                    {{-- @if(session()->has('success'))
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
                        @endif --}}
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pl-5 mb-0 pb-0">
                                    <label for="PID_konstruksi" class="col-form-label">PID Konstruksi: </label>
                                    <input type="text"  class="form-control @error('PID_konstruksi') is-invalid @enderror mb-2" value="{{ old('PID_konstruksi', $laporan->PID_konstruksi) }}" readonly>
                                    <span id="PID_konstruksi_error" style="display: none; color: red;">Field ID Tiket harus diisi!</span>
                                    @error('PID_konstruksi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
    
                                    <label for="ID_SAP_konstruksi" class="col-form-label">ID SAP konstruksi: </label>
                                    <input type="text"  class="form-control @error('ID_SAP_konstruksi') is-invalid @enderror mb-2" value="{{ old('ID_SAP_konstruksi', $laporan->slugk) }}" readonly>
                                    {{-- <select type="text" id="ID_SAP_konstruksi" name="ID_SAP_konstruksi" value="{{ old('ID_SAP_konstruksi') }}" class="form-control @error('ID_SAP_konstruksi') is-invalid @enderror mb-2">
                                    <option value="" selected>-- Pilih ID SAP --</option>
                                        @foreach ($addkonstruksi as $konstruksi)
                                        <option value={{ $konstruksi->ID_SAP_konstruksi }} @selected(old('ID_SAP_konstruksi', $laporan->ID_SAP_konstruksi)==$konstruksi->ID_SAP_konstruksi)>{{ $konstruksi->ID_SAP_konstruksi }}</option>
                                    @endforeach
                                </select> --}}
                                @error('ID_SAP_konstruksi')
                                <div class="invalid-feedback">
                                    Field ID SAP Konstruksi harus diisi!
                                </div>
                                @enderror

                                <label for="NO_PR_konstruksi" class="col-form-label">No PR Konstruksi: </label>
                                <input type="text" value="{{ old('NO_PR_konstruksi', $laporan->NO_PR_konstruksi) }}" class="form-control @error('NO_PR_konstruksi') is-invalid @enderror mb-2" readonly>
                                <span id="NO_PR_Konstruksi_error" style="display: none; color: red;">Field No PR Konstruksi harus diisi!</span>
                                @error('NO_PR_konstruksi')
                                <div class="invalid-feedback">
                                    Field No PR Konstruksi harus diisi!
                                </div>
                                @enderror

                                <label for="tanggal_PR" class="col-form-label">Tanggal PR: </label>
                                <input type="date" value="{{ old('tanggal_PR', $laporan->tanggal_PR) }}" class="form-control @error('tanggal_PR') is-invalid @enderror mb-2" readonly>
                                <span id="tanggal_PR_error" style="display: none; color: red;">Field Tanggal PR harus diisi!</span>
                                @error('tanggal_PR')
                                <div class="invalid-feedback">
                                    Field Tanggal PR harus diisi!
                                </div>
                                @enderror
    
                                    
    
                                    <label for="status_pekerjaan_id" class="col-form-label">Status Pekerjaan: </label>
                                    <input type="text" class="form-control @error('status_pekerjaan_id') is-invalid @enderror mb-2" value="{{ old('status_pekerjaan_id', $status_pekerjaan_id [$laporan->status_pekerjaan_id]) }}" readonly>
                                    {{-- <select class="status_pekerjaan_id form-control @error('status_pekerjaan_id') is-invalid @enderror mb-2" name="status_pekerjaan_id" value="{{ old('status_pekerjaan_id', $laporan->status_pekerjaan_id) }}">
                                        <option value="" selected>-- Pilih Status Pekerjaan --</option>
                                        @foreach ($addsp as $status_pekerjaan)
                                            <option value="{{ $status_pekerjaan->id }}" {{ strcmp($laporan->status_pekerjaan_id,"$status_pekerjaan->id")==0? 'selected':''; }}>{{ $status_pekerjaan->nama_status_pekerjaan }}</option>
                                        @endforeach
                                    </select> --}}
                                    <span id="status_pekerjaan_id_error" style="display: none; color: red;">Field Status Pekerjaan harus diisi!</span>
                                    @error('status_pekerjaan_id')
                                    <div class="invalid-feedback">
                                        Field Status Pekerjaan harus diisi!
                                    </div>
                                    @enderror
    
                                    <label for="mitra_id" class="col-form-label">Mitra: </label>
                                    <input type="text" class="form-control @error('mitra_id') is-invalid @enderror mb-2" value="{{ old('mitra_id', $mitra_id[$laporan->mitra_id]) }}" readonly>

                                    {{-- <select class="mitra_id form-control @error('mitra_id') is-invalid @enderror mb-2" name="mitra_id" value="{{ old('mitra_id', $laporan->mitra_id) }}">
                                        <option value="" selected>-- Pilih Mitra --</option>
                                        @foreach ($mitrass as $mitra)
                                            <option value="{{ $mitra->id }}" {{ strcmp($laporan->mitra_id,"$mitra->id")==0? 'selected':''; }}>{{ $mitra->nama_mitra }}</option>
                                        @endforeach
                                    </select> --}}
                                    <span id="mitra_id_error" style="display: none; color: red;">Field Mitra harus diisi!</span>
                                    @error('mitra_id')
                                    <div class="invalid-feedback">
                                        Field Mitra harus diisi!
                                    </div>
                                    @enderror
    
                                    <label for="tipe_kemitraan_id" class="col-form-label">Tipe Kemitraan: </label>
                                    <input type="text" class="form-control @error('tipe_kemitraan_id') is-invalid @enderror mb-2" value="{{ old('tipe_kemitraan_id',  $tipe_kemitraan_id[$laporan->tipe_kemitraan_id]) }}" readonly>

                                    {{-- <select class="tipe_kemitraan_id form-control @error('tipe_kemitraan_id') is-invalid @enderror mb-2" name="tipe_kemitraan_id" value="{{ old('tipe_kemitraan_id', $laporan->tipe_kemitraan_id) }}">
                                        <option value="" selected>-- Pilih Tipe Kemitraan --</option>
                                        @foreach ($tipek as $tipe_kemitraan)
                                            <option value="{{ $tipe_kemitraan->id }}" {{ strcmp($laporan->tipe_kemitraan_id,"$tipe_kemitraan->id")==0? 'selected':''; }}>{{ $tipe_kemitraan->nama_tipe_kemitraan }}</option>
                                        @endforeach
                                    </select> --}}
                                    <span id="tipe_kemitraan_id_error" style="display: none; color: red;">Field Tipe Kemitraan harus diisi!</span>
                                    @error('tipe_kemitraan_id')
                                    <div class="invalid-feedback">
                                        Field Tipe Kemitraan harus diisi!
                                    </div>
                                    @enderror
    
                                    <label for="program_id" class="col-form-label">Program: </label>
                                    <input type="text" class="form-control @error('program_id') is-invalid @enderror mb-2" value="{{ old('program_id', $program_id[$laporan->program_id]) }}" readonly>
    
                                    {{-- <select class="program_id form-control @error('program_id') is-invalid @enderror mb-2" name="program_id" value="{{ old('program_id', $laporan->program_id) }}" id="inputProgram">
                                            <option value="" selected>-- Pilih Program --</option>
                                            @foreach ($jenisP as $jenisprogram)
                                                <option value="{{ $jenisprogram->id }}" {{ strcmp($laporan->program_id,"$jenisprogram->id")==0? 'selected':''; }}>{{ $jenisprogram->nama_jenis_program }}</option>
                                            @endforeach
                                        </select> --}}
                                    <span id="program_id_error" style="display: none; color: red;">Field Program harus diisi!</span>
                                    @error('program_id')
                                    <div class="invalid-feedback">
                                        Field Program harus diisi!
                                    </div>
                                    @enderror
    
                                    <label for="tipe_provisioning_id" class="col-form-label">Tipe Provisioning: </label>
                                    <input type="text" class="form-control @error('tipe_provisioning_id') is-invalid @enderror mb-2" value="{{ old('tipe_provisioning_id', $tipe_provisioning_id[$laporan->tipe_provisioning_id]) }}" readonly>

                                    {{-- <select class="tipe_provisioning_id form-control @error('tipe_provisioning_id') is-invalid @enderror mb-2" name="tipe_provisioning_id" value="{{ old('tipe_provisioning_id', $laporan->tipe_provisioning_id) }}" id="inputTipeProv">
                                        <option value="" selected>-- Pilih Tipe Provisioning --</option>
                                        @foreach ($tipeprov as $tipe_provisioning)
                                            <option value="{{ $tipe_provisioning->id }}" {{ strcmp($laporan->tipe_provisioning_id,"$tipe_provisioning->id")==0? 'selected':''; }}>{{ $tipe_provisioning->nama_tipe_provisioning }}</option>
                                        @endforeach
                                    </select> --}}
                                    <span id="tipe_provisioning_id_error" style="display: none; color: red;">Field Tipe Provisioning harus diisi!</span>
                                    @error('tipe_provisioning_id')
                                    <div class="invalid-feedback">
                                        Field Tipe Provisioning harus diisi!
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
                                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror lokasi" value="{{ old('lokasi', $laporan->lokasi) }}" readonly>
                                        </div>
                                    </div>
                                    <span id="lokasi_error" style="display: none; color: red;">Field Lokasi harus diisi!</span>
                                    @error('lokasi')
                                    <div class="invalid-feedback">
                                        Field Lokasi harus diisi!
                                    </div>
                                    @enderror
    
                                    <label for="monthYearPicker" class="col-form-label">Periode Pekerjaan:</label>
                                        @php
                                        $oldPeriodePekerjaan = old('periode_pekerjaan', $laporan->periode_pekerjaan);
                                        $oldYear = date('Y', strtotime($oldPeriodePekerjaan));
                                        $oldMonth = date('m', strtotime($oldPeriodePekerjaan));
                                        @endphp
                                        <input type="month" onchange="handleDateChange(this)" value="{{ $oldYear }}-{{ str_pad($oldMonth, 2, '0', STR_PAD_LEFT) }}" class="form-control @error('periode_pekerjaan') is-invalid @enderror mb-2" readonly>
                                        @error('periode_pekerjaan')
                                        <div class="invalid-feedback">
                                            Field Periode Pekerjaan harus diisi!
                                        </div>
                                        @enderror
    
                                    <label for="material_DRM_2" class="col-form-label">Material DRM: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" value="{{ old('material_DRM_2', $laporan->material_DRM) }}" class="form-control @error('material_DRM_2') is-invalid @enderror mb-2" onkeyup="totalDRM();" oninput="formatCurrency(this)" readonly>  
                                    </div>
                                    <span id="material_DRM_2_error" style="display: none; color: red;">Field Material DRM harus diisi!</span>
                                    @error('material_DRM_2')
                                    <div class="invalid-feedback">
                                        Field Material DRM harus diisi!
                                    </div>
                                    @enderror
    
                                    <label for="jasa_DRM_2" class="col-form-label">Jasa DRM: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" value="{{ old('jasa_DRM_2', $laporan->jasa_DRM) }}" class="form-control @error('jasa_DRM_2') is-invalid @enderror mb-2" onkeyup="totalDRM()" oninput="formatCurrency(this)" readonly>
                                    </div>
                                    <span id="jasa_DRM_2_error" style="display: none; color: red;">Field Jasa DRM harus diisi!</span>
                                    @error('jasa_DRM_2')
                                    <div class="invalid-feedback">
                                        Field Jasa DRM harus diisi!
                                    </div>
                                    @enderror
    
                                    <label for="total_DRM_2" class="col-form-label">Total DRM: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" value="{{ old('total_DRM_2', $laporan->total_DRM) }}" class="form-control @error('total_DRM_2') is-invalid @enderror mb-2" onkeyup="totalDRM()" readonly>
                                    </div>
                                    <span id="total_DRM_2_error" style="display: none; color: red;">Field Total DRM harus diisi!</span>
                                    @error('total_DRM_2')
                                    <div class="invalid-feedback">
                                        Field Total DRM harus diisi!
                                    </div>
                                    @enderror
    
                                    <label for="material_aktual_2" class="col-form-label">Material Aktual: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" value="{{ old('material_aktual_2', $laporan->material_aktual) }}" class="form-control @error('material_aktual_2') is-invalid @enderror mb-2"  readonly>
                                    </div>
                                    <span id="material_aktual_2_error" style="display: none; color: red;">Field Material Aktual harus diisi!</span>
                                    @error('material_aktual_2')
                                    <div class="invalid-feedback">
                                        Field Material Aktual harus diisi!
                                    </div>
                                    @enderror
    
                                    <label for="jasa_aktual_2" class="col-form-label">Jasa Aktual: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" value="{{ old('jasa_aktual_2', $laporan->jasa_aktual) }}" class="form-control @error('jasa_aktual_2') is-invalid @enderror mb-2"  readonly>
                                    </div>
                                    <span id="jasa_aktual_2_error" style="display: none; color: red;">Field Jasa Aktual harus diisi!</span>
                                    @error('jasa_aktual_2')
                                    <div class="invalid-feedback">
                                        Field Jasa Aktual harus diisi!
                                    </div>
                                    @enderror
    
                                    <label for="total_aktual_2" class="col-form-label">Total Aktual: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" value="{{ old('total_aktual_2', $laporan->total_aktual) }}" class="form-control @error('total_aktual_2') is-invalid @enderror mb-2"  readonly>
                                    </div> 
                                    <span id="total_aktual_2_error" style="display: none; color: red;">Field Total Aktual harus diisi!</span>
                                    @error('total_aktual_2')
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
                                        <input type="text" value="{{ old('keterangan', $laporan->keterangan) }}" class="form-control @error('keterangan') is-invalid @enderror mb-2" readonly>
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
                            @endforeach
                </div>
            </div>
        </div>
        <br>
        <hr class="solid" style="border-top: 3px solid #bbb;">
        <br>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="px-5 pt-4" style="font-size: 140%"><b>Buat Laporan dari Konstruksi</b></div>
                    <div class="px-5 pt-2 pb-0">Buat Laporan sesuai dengan ketentuan dan SOP yang berlaku di Telkom Akses. Anda dapat mengubah laporan ini nanti.</div>
                    
                    <form id="storeForm" action="{{route('procurement.dashboard.store_konstruksi', [$id])}}" method="POST">
                        <div class="row">
                            @csrf
                            <div class="col-lg-6">
                                <div class="form-group pt-4 pb-0 pl-5 mb-0 pb-0">
                                    <label for="ID_SAP_konstruksi_id" class="col-form-label">ID SAP Konstruksi: </label>
                                    <input type="text" id="ID_SAP_konstruksi_id" name="ID_SAP_konstruksi_id" class="form-control @error('ID_SAP_konstruksi_id') is-invalid @enderror mb-2" value="{{ old('ID_SAP_konstruksi_id', $id) }}" readonly>
                                    @error('ID_SAP_konstruksi_id')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <label for="lokasi" class="col-form-label">Lokasi: </label>
                                    <input type="text" id="lokasi" name="lokasi" class="form-control mb-2" value="{{ old('lokasi', $lokasi) }}" readonly>

                                    
                                    <label for="PR_SAP" class="col-form-label">Nomor PR: </label>
                                    <input type="text" id="PR_SAP" name="PR_SAP" class="form-control @error('PR_SAP') is-invalid @enderror mb-2" value="{{ old('PR_SAP') }}">
                                    @error('PR_SAP')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <label for="PO_SAP" class="col-form-label">Nomor PO SAP: </label>
                                    <input type="text" id="PO_SAP" name="PO_SAP" class="form-control @error('PO_SAP') is-invalid @enderror mb-2" value="{{ old('PO_SAP') }}">
                                    @error('PO_SAP')
                                    <div class="invalid-feedback">
                                        Nomor PO SAP Wajib Diisi!
                                    </div>
                                    @enderror
                                    <label for="tanggal_PO_SAP" class="col-form-label">Tanggal PO SAP: </label>
                                    <input type="date" id="tanggal_PO_SAP" name="tanggal_PO_SAP" class="form-control @error('tanggal_PO_SAP') is-invalid @enderror mb-2" value="{{ old('tanggal_PO_SAP') }}">
                                    @error('tanggal_PO_SAP')
                                    <div class="invalid-feedback">
                                        Tanggal PO SAP Wajib Diisi!
                                    </div>
                                    @enderror
                                    <label for="material_DRM" class="col-form-label">Material DRM: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp.
                                            </div>
                                        </div>
                                        <input type="text" id="material_DRM" name="material_DRM" class="form-control @error('material_DRM') is-invalid @enderror mb-2" onkeyup="totalDRM()" oninput="formatCurrency(this)" value="{{ old('material_DRM') }}">
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
                                        <input type="text" id="jasa_DRM" name="jasa_DRM" class="form-control @error('jasa_DRM') is-invalid @enderror mb-2" onkeyup="totalDRM()" oninput="formatCurrency(this)" value="{{ old('jasa_DRM') }}">
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
                                        <input type="text" id="total_DRM" name="total_DRM" class="form-control @error('total_DRM') is-invalid @enderror mb-2" onkeyup="totalDRM()" oninput="formatCurrency(this)" value="{{ old('total_DRM') }}" readonly>
                                        <span id="total_DRM_error" style="display: none; color: red;">Field Total DRM harus diisi!</span>
                                        @error('total_DRM')
                                        <div class="invalid-feedback">
                                            Total DRM Wajib Diisi!!!
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
                                    <label for="status_tagihan_id" class="col-form-label">Status Tagihan: </label>
                                    <select class="form-control @error('status_tagihan_id') is-invalid @enderror mb-2" name="status_tagihan_id" id="status_tagihan_id" value="">
                                        <option value="" selected>-- Pilih Status Tagihan --</option>
                                        @foreach ($statustagihanmany as $status_tagihan)
                                        <option value="{{ $status_tagihan->id }}" {{ old('status_tagihan_id') == $status_tagihan->id ? 'selected' : '' }}>{{ $status_tagihan->nama_status_tagihan }}</option>
                                        @endforeach
                                    </select>
                                    <span id="status_tagihan_id_error" style="display: none; color: red;">Status Tagihan harus "CASH & BANK" jika ingin menyimpan!</span>
                                    @error('status_tagihan_id')
                                    <div class="invalid-feedback">
                                        Field Status Tagihan Wajib Dipilih!!!
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-lg-5">
                                <div class="col-lg-12" style="padding: 0 50px">
                                    <div class="form-group pb-0 mb-0">
                                        <label for="keterangan" class="col-form-label">Keterangan:</label>
                                        <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" class="form-control @error('keterangan') is-invalid @enderror mb-2">
                                    </div>
                            </div>
                    </div>
                        </div>
                        <div class="d-flex justify-content-end pr-5 mb-5">
                            <button type="submit" name="submit" class="btn btn-secondary mr-2" value="draft" href="{{ route('procurement.dashboard.draft') }}">OGP</button>
                            <button type="submit" name="submit" class="btn btn-primary" value="save" onclick="validateStatusTagihan()">Simpan</button>
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
    function totalDRM() {
        let jasaDRM = document.getElementById('jasa_DRM').value.replace(/[^\d]/g, '');
        let materialDRM = document.getElementById('material_DRM').value.replace(/[^\d]/g, '');

        // Mengubah nilai mata uang dalam format teks menjadi angka
        let sumDRM = Number(jasaDRM.replace(/\./g, '')) + Number(materialDRM.replace(/\./g, ''));

        // Menampilkan hasil jumlah kembali dalam format mata uang dengan pemisah ribuan (.)
        let total_DRM_input = document.getElementById('total_DRM');
        total_DRM_input.value = sumDRM.toLocaleString('id-ID');
    }
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
        if (simpanButton && statustagihanDropdown.value != 6) {
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