@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dashboard Laporan Maintenance</h1>
  </div>

  <div class="section-body">
    <section class="section">
      <div class="section-header">
        <h1>Table</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
          <div class="breadcrumb-item">Table</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Tables</h2>
        <p class="section-lead">
          Examples for opt-in styling of tables (given their prevalent use in JavaScript plugins) with Bootstrap.
        </p>

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
              <!-- ADD LAPORAN MAINTENANCE -->
              @if(Auth::user()->role == "Admin" && Auth::user()->role != "Maintenance")
              <div class="card-header">
                <div class="col-8">
                  <h4>Simple</h4>
                </div>
                <div class="col-4 d-flex justify-content-end">
                  <a class="btn btn-primary" href="{{ route("maintenance.addLaporanMaintenance") }}">Buat Laporan</a>
                </div>
              </div>
              @endif

              <!-- TAMBAH LAPORAN MAINTENANCE -->
              <div class="card-body">
                <table class="table table-responsive" style="overflow-x:auto;" id="table-1">
                  <thead>
                    <tr>
                    <th scope="col">No</th>
                      <th scope="col">PID</th>
                      <th scope="col">ID SAP</th>
                      <th scope="col">NO PR</th>
                      <th scope="col">Tanggal PR</th>
                      <th scope="col">Status Pekerjaan</th>
                      <th scope="col">Mitra</th>
                      <th scope="col">Tipe Kemitraan</th>
                      <th scope="col">Jenis Program</th>
                      <th scope="col">Tipe Provisioning</th>
                      <th scope="col">Periode Pekerjaan</th>
                      <th scope="col">Lokasi</th>
                      <th scope="col">Material DRM</th>
                      <th scope="col">Jasa DRM</th>
                      <th scope="col">Total DRM</th>
                      <th scope="col">Material Aktual</th>
                      <th scope="col">Jasa Aktual</th>
                      <th scope="col">Total Aktual</th>
                      <th scope="col">Keterangan</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  @if(Auth::user()->role != "Commerce")
                  <tbody>
                    <?php $i = 1 ?>
                    @foreach ($laporanMaintenances as $admins)
                    <tr>
                      <th scope="row">{{$i++}}</th>
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
                      <td>{{ $admins ->keterangan }}</td>
                      <td>

                        @if(Auth::user()->role != "Maintenance")
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
                                <a class="btn btn-danger" href="{{ route('maintenance.deleteLaporanMaintenance', [$admins->PID_maintenance]) }}" value="Delete">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endif

                        <!-- UPDATE Laporan Maintenance -->
                        <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editLaporanMaintenanceModal-{{$admins->id}}" style="color: white">Edit</a>
                        <div class="modal fade" tabindex="-1" role="dialog" id="editLaporanMaintenanceModal-{{$admins->id}}" data-backdrop="static">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title">Ubah Laporan</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeLaporanMaintenance1">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <form id="LaporanMaintenanceUpdateForm" class="form-validation" action="" method="POST">
                                  @csrf
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label for="nama_update_LaporanMaintenance" class="col-form-label">Nama Laporan: </label>
                                          <input type="text" id="nama_update_LaporanMaintenance" name="nama_LaporanMaintenance" class="form-control required-input" value="{{ $admins->nama_LaporanMaintenance }}" required>
                                          <span id="nama_LaporanMaintenance_error" class="error-message">Field Nama Laporan harus diisi!</span>
                                          @if($errors->has('nama_LaporanMaintenance'))
                                          <span class="invalid-feedback">{{ $errors->first('nama_LaporanMaintenance') }}</span>
                                          @endif
                                      </div>
                                  </div>
                                  <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateLaporanMaintenance">Close</button>
                                        <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  @endif
                  @if(Auth::user()->role == "Commerce")
                  <tbody>
                    <?php $i = 1 ?>
                    @foreach ($laporan_maintenance_commerce as $admins)
                    <tr>
                      <th scope="row">{{$i++}}</th>
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
                      <td>{{ $admins ->keterangan }}</td>
                      <td>
                      <a class="btn btn-primary" href="{{ route('commerce.laporan.add_maintenance', [$admins->PID_maintenance]) }}">Buat Laporan</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  @endif
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