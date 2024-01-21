@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan Tiket (Draft)</h1>
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
                <div class="card">
                    <div class="card-header">
                        <h4>Table</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col" class="w-50">No</th>
                      <th scope="col" class="w-50">ID Tiket</th>
                      <th scope="col" class="w-50">ID SAP</th>
                      <th scope="col" class="w-50">Datek</th>
                      <th scope="col" class="w-50">Status Pekerjaan</th>
                      <th scope="col" class="w-50">Mitra</th>
                      <th scope="col" class="w-50">Tipe Kemitraan</th>
                      <th scope="col" class="w-50">Jenis Program</th>
                      <th scope="col" class="w-50">Tipe Provisioning</th>
                      <th scope="col" class="w-50">Lokasi</th>
                      <th scope="col" class="w-50">Periode Pekerjaan</th>
                      <th scope="col" class="w-50">Material DRM</th>
                      <th scope="col" class="w-50">Jasa DRM</th>
                      <th scope="col" class="w-50">Total DRM</th>
                      <th scope="col" class="w-50">Material Aktual</th>
                      <th scope="col" class="w-50">Jasa Aktual</th>
                      <th scope="col" class="w-50">Total Aktual</th>
                      <th scope="col" class="w-50">Keterangan</th>
                      <th scope="col" class="w-50">Created At</th>
                      <th scope="col" class="w-50">Updated At</th>
                      <th scope="col" class="w-50">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                @foreach ($tiket as $admins)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{ $admins ->ID_tiket}}</td>
                                    <td>{{ $admins ->ID_SAP_maintenance}}</td>
                                    <td>{{ $admins ->datek}}</td>
                                    @if($admins ->status_pekerjaan_id != null)
                                    <td>{{ $status_pekerjaan_id[$admins->status_pekerjaan_id]}}</td>
                                    @endif
                                    @if($admins ->status_pekerjaan_id == null)
                                        <td></td>
                                    @endif
                                    @if($admins ->mitra_id != null)
                                    <td>{{ $mitra_id[$admins->mitra_id]}}</td>
                                    @endif
                                    @if($admins ->mitra_id == null)
                                        <td></td>
                                        @endif
                                    @if($admins ->tipe_kemitraan_id != null)
                                    <td>{{ $tipe_kemitraan_id[$admins->tipe_kemitraan_id]}}</td>
                                    @endif
                                    @if($admins ->tipe_kemitraan_id == null)
                                        <td></td>
                                        @endif
                                    @if($admins ->jenis_program_id != null)
                                    <td>{{ $program_id[$admins->jenis_program_id]}}</td>
                                    @endif
                                    @if($admins ->jenis_program_id == null)
                                        <td></td>
                                        @endif
                                    @if($admins ->tipe_provisioning_id != null)
                                    <td>{{ $tipe_provisioning_id[$admins->tipe_provisioning_id]}}</td>
                                    @endif
                                    @if($admins ->tipe_provisioning_id == null)
                                        <td></td>
                                        @endif
                                    <td>{{ $admins ->lokasi }}</td>
                                    <td>{{ $admins ->periode_pekerjaan }}</td>
                                    <td class="currency-field">{{ $admins ->material_DRM}}</td>
                      <td class="currency-field">{{ $admins ->jasa_DRM}}</td>
                      <td class="currency-field">{{ $admins ->total_DRM}}</td>
                      <td class="currency-field">{{ $admins ->material_aktual}}</td>
                      <td class="currency-field">{{ $admins ->jasa_aktual}}</td>
                      <td class="currency-field">{{ $admins ->total_aktual}}</td>
                                    <td>{{ $admins ->keterangan }}</td>
                                    <td>{{ $admins ->created_at}}</td>
                                    <td>{{ $admins ->updated_at}}</td>
                                    <td>
                                        @if(Auth::user()->role == "Maintenance")
                                        <a class="btn btn-sm btn-danger" {{-- data-toggle="modal" data-target="#deleteModal{{$admins->id}}" --}} style="color: white" data-toggle="modal" data-target="#deleteLaporanTiketModal{{ $admins->slugt }}">Delete</a>
                                        {{-- MODAL DELETE --}}
                                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteLaporanTiketModal{{ $admins->slugt }}" data-backdrop="static">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Kota</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeLaporanTiket1">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    @csrf
                                                    <div class="modal-body">
                                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Data OGP Laporan Tiket yang dipilih.
                                                    </div>
                                                    <div class="modal-footer bg-whitesmoke br">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeLaporanTiket2">Cancel</button>
                                                        <a class="btn btn-danger" href="{{ route('maintenance.tiket.deleteLaporanTiket', [$admins->slugt]) }}" value="Delete">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- UPDATE LaporanTiket --}}
                                        <a class="btn btn-sm btn-warning" href="{{ route('maintenance.tiket.editLaporanTiket', [$admins->slugt]) }}" style="color: white">Edit</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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