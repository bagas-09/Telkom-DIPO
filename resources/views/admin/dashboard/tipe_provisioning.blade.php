@extends('layouts.admin-master')

@section('title')
Dashboard
@endsection

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dropdown</h1>
  </div>

  <div class="section-body">
        <section class="section">
          <div class="section-header">
            <h1>Tipe Provisioning</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Tipe Provisioning</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel Tipe Provisioning</h2>
            <p class="section-lead">
              Dropdown Tipe Kemitraan disini akan tampil dan muncul pada formulir yang diisi oleh Konstruksi dan Maintenance!
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

            @error('nama_tipe_provisioning')
            <div class="alert alert-danger alert-dismissible fade show">
              {{ $message }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @enderror

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <!-- {{-- ADD TIPE PROVISIONING--}} -->
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTipeProvisioning">Add Tipe Provisioning</button>
                    </div>
                  </div>

                <!-- MODAL TAMBAH TIPE PROVISIONING -->
                <div class="modal fade" tabindex="-1" role="dialog" id="addTipeProvisioning" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Tipe Provisioning</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeTipeProvisioning1">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="form-validation" id="tipeProvisioningForm" action="
                            {{ route('admin.storeTipeProvisioning') }}
                            " method="POST">
                            @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="tipe_provisioning" class="col-form-label">Nama Tipe Provisioning: </label>
                                        <input type="text" id="nama_tipe_provisioning" name="nama_tipe_provisioning" class="required-input form-control">
                                        <span class="error-message" id="nama_tipe_provisioning_error" style="display: none; color: red;">Field Nama Tipe Provisioning harus diisi!</span>
                                        {{-- @if($errors->has('tipe_provisioning'))
                                        <span class="invalid-feedback">{{ $errors->first('tipe_provisioning') }}</span>
                                        @endif --}}
                                    </div>
                                </div>
                                <div class="modal-footer bg-whitesmoke br">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeTipeProvisioning2">Close</button>
                                    <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                  <div class="card-body">
                    <table class="table" id="table-1">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col" class="w-50">Nama Tipe Provisioning</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($tipe_provisioning as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_tipe_provisioning}}</td>
                          <td>

                            <!-- {{-- MODAL DELETE --}} -->
                            <a class="btn btn-sm btn-danger" 
                            style="color: white"
                            data-toggle="modal" 
                            data-target="#deleteTipeProvisioningModal{{ $admins->id }}"
                            >Delete</a>

                            <!-- {{-- MODAL DELETE --}} -->
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteTipeProvisioningModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Tipe Provisioning</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeTipeProvisioning1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Tipe Provisioning yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeTipeProvisioning2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteTipeProvisioning', [$admins->id]) }}" value="Delete">Delete</a>
                                      </div>
                                  </div>
                                </div>
                            </div>

                            <!-- {{-- MODAL UPDATE --}} -->
                            <a class="btn btn-sm btn-warning" data-toggle="modal" 
                            data-target="#editTipeProvisioningModal-{{$admins->id}}" 
                            style="color: white" 
                            >Edit</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="editTipeProvisioningModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Kota</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeTipeProvisioning1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="tipeProvisioningUpdateForm" class="form-validation" action="{{route('admin.updateTipeProvisioning', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_update_tipe_provisioning" class="col-form-label">Nama Kota: </label>
                                        <input type="text" id="nama_update_tipe_provisioning" name="nama_tipe_provisioning" class="form-control" value="{{ $admins->nama_tipe_provisioning }}" required>
                                        {{-- <span id="nama_tipe_provisioning_error" class="error-message">Field Nama Kota harus diisi!</span> --}}
                                        {{-- @if($errors->has('nama_tipe_provisioning'))
                                          <span class="invalid-feedback">{{ $errors->first('nama_tipe_provisioning') }}</span>
                                        @endif --}}
                                      </div>
                                    </div>  
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateTipeProvisioning">Close</button>
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#table-1').dataTable();
    });
</script>
@endpush