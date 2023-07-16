@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Laporan Maintenance</h1>
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
              <!-- {{-- ADD LAPORAN MAINTENANCE--}} -->
              @if(Auth::user()->role == "Admin" && Auth::user()->role != "Maintenance")
              <div class="card-header">
                <div class="col-8">
                  <h4>Simple</h4>
                </div>
                <div class="col-4 d-flex justify-content-end">
                  <a class="btn btn-primary" href="{{ route("Maintenance.addLaporanMaintenance") }}">Buat Laporan</a>
                </div>
              </div>
              @endif

              <!-- TAMBAH LAPORAN MAINTENANCE -->
              <div class="card-body table-responsive">
                <table class="table" style="overflow-x:auto;">
                  <thead>
                    <tr>
                      <th scope="col" class="w-25">PID</th>
                      <th scope="col" class="w-25">ID SAP</th>
                      <th scope="col" class="w-25">NO PR</th>
                      <th scope="col" class="w-25">Tanggal PR</th>
                      <th scope="col" class="w-25">Status Pekerjaan</th>
                      <th scope="col" class="w-25">Mitra</th>
                      <th scope="col" class="w-25">Tipe Kemitraan</th>
                      <th scope="col" class="w-25">Jenis Program</th>
                      <th scope="col" class="w-25">Tipe Provisioning</th>
                      <th scope="col" class="w-25">Periode Pekerjaan</th>
                      <th scope="col" class="w-25">Lokasi</th>
                      <th scope="col" class="w-25">Material DRM</th>
                      <th scope="col" class="w-25">Jasa DRM</th>
                      <th scope="col" class="w-25">Total DRM</th>
                      <th scope="col" class="w-25">Material Aktual</th>
                      <th scope="col" class="w-25">Jasa Aktual</th>
                      <th scope="col" class="w-25">Total Aktual</th>
                      <th scope="col" class="w-25">Keterangan</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1 ?>
                    @foreach ($laporan_maintenance as $admins)
                    <tr>
                      <!-- <th scope="row">{{$i++}}</th> -->
                      <td>{{ $admins -> PID_maintenance}}</td>
                      <td>{{ $admins -> ID_SAP_maintenance}}</td>
                      <td>{{ $admins -> NO_PR_maintenance}}</td>
                      <td>{{ $admins -> tanggal_PR}}</td>
                      <td>{{ $status_pekerjaan_id [$admins -> status_pekerjaan_id]}}</td>
                      <td>{{ $mitra_id [$admins -> mitra_id]}}</td>
                      <td>{{ $tipe_kemitraan_id [$admins -> tipe_kemitraan_id]}}</td>
                      <td>{{ $jenis_program_id [$admins -> jenis_program_id]}}</td>
                      <td>{{ $tipe_provisioning_id [$admins -> tipe_provisioning_id]}}</td>
                      <td>{{ $admins -> periode_pekerjaan}}</td>
                      <td>{{ $admins -> lokasi }}</td>
                      <td>{{ $admins -> material_DRM}}</td>
                      <td>{{ $admins -> jasa_DRM}}</td>
                      <td>{{ $admins -> total_DRM}}</td>
                      <td>{{ $admins -> material_aktual}}</td>
                      <td>{{ $admins -> jasa_aktual}}</td>
                      <td>{{ $admins -> total_aktual}}</td>
                      <td>
                        @if(Auth::user()->role != "Commerce")
                        <!-- {{-- MODAL DELETE --}} -->
                        <a class="btn btn-sm btn-danger" style="color: white" data-toggle="modal" data-target="#deleteLaporanMaintenanceModal{{ $admins-> PID_maintenance }}">Delete</a>

                        <!-- {{-- MODAL DELETE --}} -->
                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteLaporanMaintenanceModal{{ $admins-> PID_maintenance }}" data-backdrop="static">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Hapus Laporan Maintenance</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeLaporanMaintenance1">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              @csrf
                              <div class="modal-body">
                                Pilih "Delete" dibawah ini jika Anda yakin menghapus Laporan Maintenance yang dipilih.
                              </div>
                              <div class="modal-footer bg-whitesmoke br">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeLaporanMaintenance2">Cancel</button>
                                <a class="btn btn-danger" href="{{ route('admin.deleteLaporanMaintenance', [$admins->PID_maintenance]) }}" value="Delete">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>

                        {{-- MODAL UPDATE --}}
                        <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editLaporanMaintenanceModal-{{$admins->id}}" style="color: white">Edit</a>

                        @endif
                        @if(Auth::user()->role == "Commerce")
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