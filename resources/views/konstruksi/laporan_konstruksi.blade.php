@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>

  <div class="section-body">
    <section class="section">
      <div class="section-header">
        <h1>Laporan Konstruksi</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item active"><a href="{{ route('konstruksi.laporanKonstruksi.index') }}">Laporan Konstruksi</a></div>
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
              {{-- ADD LAPORAN KONSTRUKSI --}}
              
              <div class="card-header">
                <div class="col-8">
                  <h4>Simple</h4>
                </div>
                @if(Auth::user()->role == "Konstruksi")
                <div class="col-4 d-flex justify-content-end">
                  <a class="btn btn-outline-primary mr-3"  href="{{ route('konstruksi.laporanKonstruksi.export') }}">Export</a>
                  <a class="btn btn-primary" href="{{ route('konstruksi.laporan_konstruksi_add') }}">Buat Laporan</a>
                </div>
                @endif
                @if(Auth::user()->role == "Admin")
                <div class="col-4 d-flex justify-content-end">
                  <a class="btn btn-outline-primary mr-3"  href="{{ route('admin.laporanKonstruksi.export') }}">Export</a>
                </div>
                @endif
              </div> 
              <div class="card-body">
                <table class="table table-responsive" style="overflow-x: auto;" id="table-1">
                  <thead>
                    <tr>
                      <th scope="col" class="w-50">No</th>
                      <th scope="col" class="w-50">PID Konstruksi</th>
                      <th scope="col" class="w-50">ID SAP</th>
                      <th scope="col" class="w-50">Nomor PR</th>
                      <th scope="col" class="w-50">Tanggal PR</th>
                      <th scope="col" class="w-50">Status Pekerjaan</th>
                      <th scope="col" class="w-50">Mitra</th>
                      <th scope="col" class="w-50">Tipe Kemitraan</th>
                      <th scope="col" class="w-50">Program</th>
                      <th scope="col" class="w-50">Tipe Provisioning</th>
                      <th scope="col" class="w-50">Lokasi</th>
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
                      @if(Auth::user()->role == "Admin" )
                      <th scope="col" class="w-50">Access</th>
                      @endif
                    </tr>
                  </thead>
                  @if(Auth::user()->role == "Konstruksi" || Auth::user()->role == "Admin" || Auth::user()->role == "GM")
                  <tbody>
                    <?php $i = 1 ?>
                    @foreach ($laporanKonstruksis as $admins)
                    <tr>
                      <th scope="row">{{$i++}}</th>
                      <td>{{ $admins ->PID_konstruksi}}</td>
                      <td>{{ $admins ->ID_SAP_konstruksi}}</td>
                      <td>{{ $admins ->NO_PR_konstruksi}}</td>
                      <td>{{ $admins ->tanggal_PR}}</td>
                      <td>{{ $status_pekerjaan_id [$admins->status_pekerjaan_id] ?? ''}}</td>
                      <td>{{ $mitra_id[$admins->mitra_id] ?? ''}}</td>
                      <td>{{ $tipe_kemitraan_id[$admins->tipe_kemitraan_id] ?? ''}}</td>
                      <td>{{ $program_id[$admins->program_id] ?? ''}}</td>
                      <td>{{ $tipe_provisioning_id[$admins->tipe_provisioning_id] ?? ''}}</td>
                      <td>{{ $admins ->lokasi ?? ''}}</td>
                      <td class="currency-field">{{ $admins ->material_DRM}}</td>
                      <td class="currency-field">{{ $admins ->jasa_DRM}}</td>
                      <td class="currency-field">{{ $admins ->total_DRM}}</td>
                      <td class="currency-field">{{ $admins ->material_aktual}}</td>
                      <td class="currency-field">{{ $admins ->jasa_aktual}}</td>
                      <td class="currency-field">{{ $admins ->total_aktual}}</td>
                      <td>{{ $admins ->keterangan ?? ''}}</td>
                      <td>{{ $admins ->created_at?? ''}}</td>
                      <td>{{ $admins ->updated_at?? ''}}</td>
                      {{-- <td>{{ $citys[$admins->id_nama_kota]}}</td> --}}

                      <td>
                        @if(Auth::user()->role == "Procurement")
                        <a class="btn btn-primary" href="{{ route('procurement.dashboard.add_konstruksi', [$admins->slugk]) }}">Buat Laporan</a>
                        @endif

                        @if(Auth::user()->role == "Konstruksi" && $admins->editable == 1)
                        <a class="btn btn-sm btn-warning" href={{ route('konstruksi.laporan_konstruksi_edit', [$admins->slugk]) }} style="color: white">Edit</a>
                        @endif

                        @if(Auth::user()->role == "Konstruksi" && Auth::user()->role != "GM")
                        <a class="btn btn-sm btn-danger" style="color: white" data-toggle="modal" data-target="#deleteLaporanKonstruksiModal{{ $admins->slugk }}">Delete</a>
                        @endif

                        @if(Auth::user()->role == "Admin")
                        <a class="btn btn-sm btn-danger" style="color: white" data-toggle="modal" data-target="#deleteLaporanAdminModal{{ $admins->slugk }}">Delete</a>
                        @endif

                        {{-- MODAL DELETE --}}
                        @if(Auth::user()->role == "Konstruksi")
                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteLaporanKonstruksiModal{{ $admins->slugk }}" data-backdrop="static">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Hapus Laporan Konstruksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeLaporanKonstruksi1">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              @csrf
                              <div class="modal-body">
                                Pilih "Delete" dibawah ini jika Anda yakin menghapus Laporan Konstruksi yang dipilih.
                              </div>
                              <div class="modal-footer bg-whitesmoke br">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeLaporanKonstruksi2">Cancel</button>
                                <a class="btn btn-danger" href="{{ route('konstruksi.laporan_konstruksi_delete', [$admins->slugk]) }}" value="Delete">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endif
                        @if(Auth::user()->role == "Admin")
                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteLaporanAdminModal{{ $admins->slugk }}" data-backdrop="static">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Hapus Laporan Konstruksi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeLaporanKonstruksi1">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              @csrf
                              <div class="modal-body">
                                Pilih "Delete" dibawah ini jika Anda yakin menghapus Laporan Konstruksi yang dipilih.
                              </div>
                              <div class="modal-footer bg-whitesmoke br">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeLaporanKonstruksi2">Cancel</button>
                                <a class="btn btn-danger" href="{{ route('admin.deleteLaporanKonstruksi', [$admins->slugk]) }}" value="Delete">Delete</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endif
                      </td>
                       @if(Auth::user()->role == "Admin")
                      <td>
                          @if($admins->editable == 0)
                            <a class="btn btn-sm btn-warning"  
                              href={{ route('admin.editableKonstruksi', [$admins->slugk]) }}
                              style="color: white">Able Edit</a>
                          @endif
                          @if($admins->editable == 1)
                            <a class="btn btn-sm btn-danger"  
                              href={{ route('admin.uneditableKonstruksi', [$admins->slugk]) }}
                              style="color: white">Unable Edit</a>
                          @endif
                      </td>
                      @endif
                    </tr>
                    @endforeach
                  </tbody>
                  @endif

                  @if(Auth::user()->role == "Commerce")
                  <tbody>
                    <?php $i = 1 ?>
                    @foreach ($laporan_konstruksi_commerce as $admins)
                    <tr>
                      <th scope="row">{{$i++}}</th>
                      <td>{{ $admins ->PID_konstruksi}}</td>
                      <td>{{ $admins ->ID_SAP_konstruksi}}</td>
                      <td>{{ $admins ->NO_PR_konstruksi}}</td>
                      <td>{{ $admins ->tanggal_PR}}</td>
                      <td>{{ $status_pekerjaan_id [$admins->status_pekerjaan_id] ?? ''}}</td>
                      <td>{{ $mitra_id[$admins->mitra_id] ?? ''}}</td>
                      <td>{{ $tipe_kemitraan_id[$admins->tipe_kemitraan_id] ?? ''}}</td>
                      <td>{{ $program_id[$admins->program_id] ?? ''}}</td>
                      <td>{{ $tipe_provisioning_id[$admins->tipe_provisioning_id] ?? ''}}</td>
                      <td>{{ $admins ->lokasi ?? ''}}</td>
                      <td>{{ $admins ->material_DRM ?? '' }}</td>
                      <td>{{ $admins ->jasa_DRM ?? ''}}</td>
                      <td>{{ $admins ->total_DRM ?? ''}}</td>
                      <td>{{ $admins ->material_aktual ?? ''}}</td>
                      <td>{{ $admins ->jasa_aktual ?? ''}}</td>
                      <td>{{ $admins ->total_aktual ?? ''}}</td>
                      <td>{{ $admins ->keterangan ?? ''}}</td>
                      <td>{{ $admins ->created_at?? ''}}</td>
                      <td>{{ $admins ->updated_at?? ''}}</td>
                      {{-- <td>{{ $citys[$admins->id_nama_kota]}}</td> --}}
                      <td>
                        <a class="btn btn-primary" href="{{ route('commerce.laporan.add_konstruksi', [$admins->slugk]) }}">Buat Laporan</a>
                      </td>
                    </tr>
                    @endforeach
                    @endif
                    @if(Auth::user()->role == "Procurement")
                  <tbody>
                    <?php $i = 1 ?>
                    @foreach ($laporan_konstruksi_procurement as $admins)
                    <tr>
                      <th scope="row">{{$i++}}</th>
                      <td>{{ $admins ->PID_konstruksi}}</td>
                      <td>{{ $admins ->ID_SAP_konstruksi}}</td>
                      <td>{{ $admins ->NO_PR_konstruksi}}</td>
                      <td>{{ $admins ->tanggal_PR}}</td>
                      <td>{{ $status_pekerjaan_id [$admins->status_pekerjaan_id] ?? ''}}</td>
                      <td>{{ $mitra_id[$admins->mitra_id] ?? ''}}</td>
                      <td>{{ $tipe_kemitraan_id[$admins->tipe_kemitraan_id] ?? ''}}</td>
                      <td>{{ $program_id[$admins->program_id] ?? ''}}</td>
                      <td>{{ $tipe_provisioning_id[$admins->tipe_provisioning_id] ?? ''}}</td>
                      <td>{{ $admins ->lokasi ?? ''}}</td>
                      <td>{{ $admins ->material_DRM ?? '' }}</td>
                      <td>{{ $admins ->jasa_DRM ?? ''}}</td>
                      <td>{{ $admins ->total_DRM ?? ''}}</td>
                      <td>{{ $admins ->material_aktual ?? ''}}</td>
                      <td>{{ $admins ->jasa_aktual ?? ''}}</td>
                      <td>{{ $admins ->total_aktual ?? ''}}</td>
                      <td>{{ $admins ->keterangan ?? ''}}</td>
                      <td>{{ $admins ->created_at?? ''}}</td>
                      <td>{{ $admins ->updated_at?? ''}}</td>
                      {{-- <td>{{ $citys[$admins->id_nama_kota]}}</td> --}}
                      <td>
                        <a class="btn btn-primary" href="{{ route('procurement.dashboard.add_konstruksi', [$admins->slugk]) }}">Buat Laporan</a>
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