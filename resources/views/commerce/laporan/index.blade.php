@extends('layouts.admin-master')

@section('title')

@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan Commerce (Selesai)</h1>
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
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col" class="w-50">Nomor PO</th>
                                            <th scope="col" class="w-50">Tanggal PO</th>
                                            <th scope="col" class="w-50">Nomor SP</th>
                                            <th scope="col" class="w-50">Tanggal SP</th>
                                            <th scope="col" class="w-50">TOC</th>
                                            <th scope="col" class="w-50">Nomor BAUT</th>
                                            <th scope="col" class="w-50">Tanggal BAUT</th>
                                            <th scope="col" class="w-50">Nomor BAR</th>
                                            <th scope="col" class="w-50">Tanggal BAR</th>
                                            <th scope="col" class="w-50">Nomor BAST</th>
                                            <th scope="col" class="w-50">Tanggal BAST</th>
                                            <th scope="col" class="w-50">Material Aktual</th>
                                            <th scope="col" class="w-50">Jasa Aktual</th>
                                            <th scope="col" class="w-50">Total Aktual</th>
                                            <th scope="col" class="w-50">Status</th>
                                            <th scope="col" class="w-50">PID Konstruksi</th>
                                            <th scope="col" class="w-50">PID Maintenance</th>
                                            <th scope="col" class="w-50">Lokasi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        @foreach ($commerce as $admins)
                                        <tr>
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{ $admins ->no_PO}}</td>
                                            <td>{{ $admins ->tanggal_PO}}</td>
                                            <td>{{ $admins ->No_SP}}</td>
                                            <td>{{ $admins ->tanggal_SP}}</td>
                                            <td>{{ $admins ->TOC}}</td>
                                            <td>{{ $admins ->No_BAUT}}</td>
                                            <td>{{ $admins ->tanggal_BAUT}}</td>
                                            <td>{{ $admins ->NO_BAR}}</td>
                                            <td>{{ $admins ->tanggal_BAR}}</td>
                                            <td>{{ $admins ->NO_BAST}}</td>
                                            <td>{{ $admins ->tanggal_BAST}}</td>
                                            <td>{{ $admins ->material_aktual}}</td>
                                            <td>{{ $admins ->jasa_aktual}}</td>
                                            <td>{{ $admins ->total_aktual}}</td>
                                            <td>{{ $status[$admins ->status_id]}}</td>
                                            <td>{{ $admins ->PID_konstruksi_id}}</td>
                                            <td>{{ $admins ->PID_maintenance_id}}</td>
                                            <td>{{ $admins ->lokasi}}</td>
                                            <td>
                                                <a class="btn btn-sm btn-danger" {{-- data-toggle="modal" data-target="#deleteModal{{$admins->id}}" --}} style="color: white" data-toggle="modal" data-target="#deleteLaporanCommerceModal{{ $admins->id }}">Delete</a>
                                                {{-- MODAL DELETE --}}
                                                <div class="modal fade" tabindex="-1" role="dialog" id="deleteLaporanCommerceModal{{ $admins->id }}" data-backdrop="static">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Hapus Kota</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeLaporanCommerce1">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            @csrf
                                                            <div class="modal-body">
                                                                Pilih "Delete" dibawah ini jika Anda yakin menghapus Kota yang dipilih.
                                                            </div>
                                                            <div class="modal-footer bg-whitesmoke br">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeLaporanCommerce2">Cancel</button>
                                                                <a class="btn btn-danger" href="{{ route('commerce.delete_laporan_commerce', [$admins->no_PO]) }}" value="Delete">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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