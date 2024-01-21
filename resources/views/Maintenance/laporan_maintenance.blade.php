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
        <h1>Laporan Maintenance</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('maintenance.tiket.index') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ route('maintenance.laporanMaintenance.index') }}">Laporan Maintenance</a></div>
        </div>
      </div>

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
              <!-- ADD LAPORAN MAINTENANCE -->
              <div class="card-header">
                <div class="col-8">
                  <h4>Simple</h4>
                </div>
                @if(Auth::user()->role == "Maintenance")
                <div class="col-4 d-flex justify-content-end">
                  <a class="btn btn-outline-primary mr-3"  href="{{ route('maintenance.laporanMaintenance.export') }}">Export</a>
                  <a class="btn btn-primary" href="{{ route('maintenance.laporan_maintenance_add') }}">Buat Laporan</a>
                </div>
                @endif
                @if(Auth::user()->role == "Admin")
                <div class="col-4 d-flex justify-content-end">
                  <a class="btn btn-outline-primary mr-3"  href="{{ route('admin.laporanMaintenance.export') }}">Export</a>
                </div>
                @endif
              </div>
              <!-- TAMBAH LAPORAN MAINTENANCE -->
              <div class="card-body">
                <table class="table table-responsive" style="overflow-x:auto;" id="table-1">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col" class="w-50">PID Maintenance</th>
                      <th scope="col" class="w-50">ID SAP</th>
                      <th scope="col" class="w-50">NO PR</th>
                      <th scope="col" class="w-50">Tanggal PR</th>
                      <th scope="col" class="w-50">Keterangan</th>
                      <th scope="col" class="w-50">Created At</th>
                      <th scope="col" class="w-50">Updated At</th>
                      <th scope="col" class="w-50">Action</th>
                      @if(Auth::user()->role == "Admin" )
                      <th scope="col" class="w-50">Access</th>
                      @endif
                    </tr>
                  </thead>
                  @if(Auth::user()->role == "Maintenance" || Auth::user()->role == "Admin"|| Auth::user()->role == "GM")
                  <tbody>
                    <?php $i = 1 ?>
                    @foreach ($laporanMaintenances as $admins)
                    <tr>
                      <th scope="row">{{$i++}}</th>
                      <td>{{ $admins->PID_maintenance}}</td>
                      <td>{{ $admins ->ID_SAP_maintenance}}</td>
                      <td>{{ $admins->NO_PR_maintenance}}</td>
                      <td>{{ $admins->tanggal_PR}}</td>
                      <td>{{ $admins->keterangan }}</td>
                      <td>{{ $admins ->created_at}}</td>
                      <td>{{ $admins ->updated_at}}</td>
                      {{-- <td>{{ $citys[$admins->id_nama_kota]}}</td> --}}
                      <td>

                        @if(Auth::user()->role == "Procurement")
                        <a class="btn btn-primary" href="{{ route('procurement.dashboard.add_maintenance', [$admins->slugm]) }}">Buat Laporan</a>
                        @endif

                        @if(Auth::user()->role == "Maintenance" && $admins->editable == 1)
                        <a class="btn btn-sm btn-warning" href={{ route('maintenance.laporan_maintenance_edit', [$admins->slugm]) }} style="color: white">Edit</a>
                        @endif

                        {{-- @if(Auth::user()->role == "Admin")
                        <a class="btn btn-sm btn-danger" style="color: white" data-toggle="modal" data-target="#deleteLaporanAdminModal{{ $admins->slugm }}">Delete</a>
                        @endif --}}
                        
                        @if(Auth::user()->role == "Maintenance" && Auth::user()->role != "GM")
                        <!-- {{-- MODAL DELETE --}} -->
                        <a class="btn btn-sm btn-danger" style="color: white" data-toggle="modal" data-target="#deleteLaporanMaintenanceModal{{ $admins->slugm }}">Delete</a>
                        @endif
                        <!-- {{-- MODAL DELETE --}} -->
                        @if(Auth::user()->role == "Maintenance")
                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteLaporanMaintenanceModal{{ $admins->slugm }}" data-backdrop="static">
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
                                <a class="btn btn-danger" href="{{ route('maintenance.laporan_maintenance_delete', [$admins->slugm]) }}" value="Delete">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endif
                        @if(Auth::user()->role == "Admin")
                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteLaporanAdminModal{{ $admins->slugm }}" data-backdrop="static">

                          <!-- UPDATE Laporan Maintenance -->
                          <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editLaporanMaintenanceModal-{{$admins->id}}" style="color: white">Edit</a>
                          <div class="modal fade" tabindex="-1" role="dialog" id="editLaporanMaintenanceModal-{{$admins->id}}" data-backdrop="static">
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
                                  <a class="btn btn-danger" href="{{ route('admin.deleteLaporanMaintenance', [$admins->slugm]) }}" value="Delete">Delete</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          @endif
                      </td>
                    </td>
                    @if(Auth::user()->role == "Admin")
                  <td>
                    @if($admins->editable == 0)
                    <a href={{ route('admin.editableMaintenance', [$admins->slugm]) }} class="btn btn-primary
                        btn-sm rounded-0" type="button">
                        <i class="fa fa-edit"></i> Open Edit</a>
                    @endif
                    @if($admins->editable == 1)
                    <a href={{ route('admin.uneditableMaintenance', [$admins->slugm]) }} class="btn btn-danger
                        btn-sm rounded-0" type="button">
                        <i class="fa fa-edit"></i> Close Edit</a>
                    @endif
                  </td>
                  @endif

                    </tr>
                    @endforeach
                  </tbody>
                  @endif
                  
                    
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