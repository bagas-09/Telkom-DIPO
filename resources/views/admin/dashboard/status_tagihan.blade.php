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
                  <!-- ARole -->
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStatus">Add Status</button>
                    </div>
                  </div>

                    <!-- TAMBAH ROLE -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="addStatus" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeStatus1">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="Statusform" action="{{ route('admin.storestatustagihan') }}" method="POST">
                        @csrf
                            <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_status_tagihan" class="col-form-label">Nama Status Tagihan: </label>
                                <input type="text" id="nama_status_tagihan" name="nama_status_tagihan" class="form-control">
                                <span id="nama_status_tagihan_error" style="display: none; color: red;">Field Nama Status Tagihan harus diisi!</span>
                            </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeStatus2">Close</button>
                            <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>

                  <div class="card-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col" class="w-50">Nama Status Tagihan</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($type as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins -> nama_status_tagihan}}</td>
                          <td>

                          <!-- MODAL DELETE -->
                          <a class="btn btn-sm btn-danger" 
                            data-toggle="modal" 
                            data-target="#deleteStatusModal{{$admins->id}}"
                            style="color: white"
                            data-toggle="modal" 
                            
                            >Delete</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteStatusModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Status Tagihan</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeStatus1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Status Tagihan yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeStatus2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deletestatustagihan', [$admins->id]) }}" value="Delete">Delete</a>
                                      </div>
                                  </div>
                                </div>
                            </div>

                            <!-- MODAL UPDATE -->
                            <a class="btn btn-sm btn-warning" data-toggle="modal" 
                            data-target="#editStatusModal-{{$admins->id}}"
                            
                            style="color: white" 
                            >Edit</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="editStatusModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Status Tagihan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeStatus1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="StatusUpdateForm" class="form-validation" 
                                  action="{{route('admin.updatestatustagihan', [$admins->id])}}" 
                                  method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_update_Status" class="col-form-label">Nama Status Tagihan: </label>
                                        <input type="text" id="nama_update_Status" name="nama_status_tagihan" class="form-control required-input" value="{{ $admins->nama_status_tagihan }}" required>
                                        <!-- <span id="nama_role_error" class="error-message">Field Nama Kota harus diisi!</span>
                                        @if($errors->has('nama_role'))
                                          <span class="invalid-feedback">{{ $errors->first('nama_role') }}</span>
                                        @endif -->
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateStatus">Close</button>
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