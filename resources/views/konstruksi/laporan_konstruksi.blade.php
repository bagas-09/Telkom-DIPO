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
                  {{-- ADD LAPORAN KONSTRUKSI --}}
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <a class="btn btn-primary" href="{{ route("konstruksi.addLaporanKonstruksi") }}">Buat Laporan</a>
                    </div>
                  </div>

                  <div class="card-body table-responsive">
                    <table class="table" style="overflow-x: auto;">
                      <thead>
                        <tr>
                          <th scope="col">PID Konstruksi</th>
                          <th scope="col">ID SAP</th>
                          <th scope="col">Nomor PR</th>
                          <th scope="col">Tanggal PR</th>
                          <th scope="col">Status Pekerjaan</th>
                          <th scope="col">Mitra</th>
                          <th scope="col">Tipe Kemitraan</th>
                          <th scope="col">Jenis Order</th>
                          <th scope="col">Tipe Provisioning</th>
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
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($laporanKonstruksis as $admins)
                        <tr>
                          {{-- <th scope="row">{{$i++}}</th> --}}
                          <td>{{ $admins ->PID_konstruksi}}</td>
                          <td>{{ $admins ->ID_SAP_konstruksi}}</td>
                          <td>{{ $admins ->NO_PR_konstruksi}}</td>
                          <td>{{ $admins ->tanggal_PR}}</td>
                          <td>{{ $status_pekerjaan_id[$admins->status_pekerjaan_id]}}</td>
                          <td>{{ $mitra_id[$admins->mitra_id]}}</td>
                          <td>{{ $tipe_kemitraan_id[$admins->tipe_kemitraan_id]}}</td>
                          <td>{{ $jenis_order_id[$admins->jenis_order_id]}}</td>
                          <td>{{ $tipe_provisioning_id[$admins->tipe_provisioning_id]}}</td>
                          <td>{{ $admins ->lokasi }}</td>
                          <td>{{ $admins ->material_DRM }}</td>
                          <td>{{ $admins ->jasa_DRM }}</td>
                          <td>{{ $admins ->total_DRM }}</td>
                          <td>{{ $admins ->material_aktual }}</td>
                          <td>{{ $admins ->jasa_aktual }}</td>
                          <td>{{ $admins ->total_aktual }}</td>
                          <td>{{ $admins ->keterangan }}</td>
                          {{-- <td>{{ $citys[$admins->id_nama_kota]}}</td> --}}

                          <td>
                            <a class="btn btn-sm btn-danger" 
                            style="color: white"
                            data-toggle="modal" data-target="#deleteLaporanKonstruksiModal{{ $admins->id }}"
                            >Delete</a>


                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" 
                            id="deleteLaporanKonstruksiModal{{ $admins->id }}" 
                            data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Akun</h5>
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
                                        <a class="btn btn-danger" 
                                        href="{{ route('konstruksi.deleteLaporanKonstruksi', [$admins->PID_konstruksi]) }}" 
                                        value="Delete">Delete</a>
                                      </div>
                                      </div>
                                  </div>
                                </div>
                            </div>

                            {{-- UPDATE CITY --}}
                            <a class="btn btn-sm btn-warning" data-toggle="modal" 
                            {{-- data-target="#editAccountModal-{{$admins->id}}"  --}}
                            style="color: white" 
                            >Edit</a>

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