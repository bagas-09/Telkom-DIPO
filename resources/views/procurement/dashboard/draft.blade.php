@extends('layouts.admin-master')

@section('title')

@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan Procurement (Draft)</h1>
    </div>

    <div class="section-body">
        <section class="section">
            <div class="section-body">

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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-responsive" id="table-1">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col" class="w-50">Nomor PR</th>
                                            <th scope="col" class="w-50">PO SAP</th>
                                            <th scope="col" class="w-50">Tanggal PO SAP</th>
                                            <th scope="col" class="w-50">Material DRM</th>
                                            <th scope="col" class="w-50">Jasa DRM</th>
                                            <th scope="col" class="w-50">Total DRM</th>
                                            <th scope="col" class="w-50">Material Aktual</th>
                                            <th scope="col" class="w-50">Jasa Aktual</th>
                                            <th scope="col" class="w-50">Total Aktual</th>
                                            <th scope="col" class="w-50">Status Tagihan</th>
                                            <th scope="col" class="w-50">PID Konstruksi</th>
                                            <th scope="col" class="w-50">PID Maintenance</th>
                                            <th scope="col" class="w-50">Lokasi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        @foreach ($procurement as $admins)
                                        <tr>
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{ $admins ->PR_SAP}}</td>
                                            <td>{{ $admins ->PO_SAP}}</td>
                                            <td>{{ $admins ->tanggal_PO_SAP}}</td>
                                            <td>{{ $admins ->material_DRM}}</td>
                                            <td>{{ $admins ->jasa_DRM}}</td>
                                            <td>{{ $admins ->total_DRM}}</td>
                                            <td>{{ $admins ->material_aktual}}</td>
                                            <td>{{ $admins ->jasa_aktual}}</td>
                                            <td>{{ $admins ->total_aktual}}</td>
                                            @if($admins ->status_tagihan_id != null)
                                            <td>{{ $status_tagihan[$admins ->status_tagihan_id]}}</td>
                                            @endif
                                            @if($admins ->status_tagihan_id == null)
                                            <td></td>
                                            @endif
                                            <td>{{ $admins ->PID_konstruksi_id}}</td>
                                            <td>{{ $admins ->PID_maintenance_id}}</td>
                                            <td>{{ $admins ->lokasi}}</td>
                                            <td>
                                                @if(Auth::user()->role == "Procurement")
                                                <a class="btn btn-sm btn-danger" {{-- data-toggle="modal" data-target="#deleteModal{{$admins->id}}" --}} style="color: white" data-toggle="modal" data-target="#deleteLaporanProcurementModal{{ $admins->id }}">Delete</a>
                                                <!-- MODAL DELETE -->
                                                <div class="modal fade" tabindex="-1" role="dialog" id="deleteLaporanProcurementModal{{ $admins->id }}" data-backdrop="static">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Hapus Kota</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeLaporanProcurement1">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            @csrf
                                                            <div class="modal-body">
                                                                Pilih "Delete" dibawah ini jika Anda yakin menghapus Laporan yang dipilih.
                                                            </div>
                                                            <div class="modal-footer bg-whitesmoke br">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeLaporanProcurement2">Cancel</button>
                                                                <a class="btn btn-danger" href="{{ route('procurement.delete_laporan_procurement', [$admins->PR_SAP]) }}" value="Delete">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- UPDATE Laporan Procurement -->
                                                <a class="btn btn-sm btn-warning" href="{{ route('procurement.laporan.edit', [$admins->PR_SAP]) }}" style="color: white">Edit</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<style>
    .is-invalid {
        border-color: red;
        /* Atau atur properti lainnya untuk mengubah tampilan field input menjadi merah */
    }
</style>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('#table-1').dataTable();
  });
</script>
@endpush