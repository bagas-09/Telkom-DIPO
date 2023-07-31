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
            <h1>Jenis Order</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Jenis Order</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel Jenis Order</h2>
            <p class="section-lead">
              Dropdown Jenis Order disini akan tampil dan muncul pada formulir yang diisi oleh Konstruksi!
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
                  {{-- ADD JENIS ORDER --}}
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addJenisOrder">Add Jenis Order</button>
                    </div>
                  </div>

                  <!-- TAMBAH JENIS ORDER -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="addJenisOrder" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Jenis Order</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeJenisOrder1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form id="jenisOrderForm" action="{{route('admin.storeJenisOrder')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_jenis_order" class="col-form-label">Nama Jenis Order: </label>
                              <input type="text" id="nama_jenis_order" name="nama_jenis_order" class="form-control">
                              <span id="nama_jenis_order_error" style="display: none; color: red;">Field Nama Jenis Order harus diisi!</span>
                              {{-- @if($errors->has('nama_city'))
                                <span class="invalid-feedback">{{ $errors->first('nama_city') }}</span>
                              @endif --}}
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeJenisOrder2">Close</button>
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
                          <th scope="col" class="w-50">Nama Jenis Order</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($jenisOrder as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_jenis_order}}</td>
                          <td>
                            <a class="btn btn-sm btn-danger" 
                            {{-- data-toggle="modal" data-target="#deleteModal{{$admins->id}}" --}}
                            style="color: white"
                            data-toggle="modal" data-target="#deleteJenisOrderModal{{ $admins->id }}"
                            >Delete</a>
                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteJenisOrderModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Jenis Order</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeJenisOrder1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Jenis Order yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeJenisOrder2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteJenisOrder', [$admins->id]) }}" value="Delete">Delete</a>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            {{-- <a class="btn btn-sm btn-warning" href="#">Edit</a> --}}

                            {{-- UPDATE JENIS ORDER --}}
                            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editJenisOrderModal-{{$admins->id}}" style="color: white" 
                            >Edit</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="editJenisOrderModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Jenis Order</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeJenisOrder1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="jenisOrderUpdateForm" class="form-validation" action="{{route('admin.updateJenisOrder', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_update_jenis_order" class="col-form-label">Nama Jenis Order: </label>
                                        <input type="text" id="nama_update_jenis_order" name="nama_jenis_order" class="form-control required-input" value="{{ $admins->nama_jenis_order }}" required>
                                        {{-- <span id="nama_jenis_order_error" class="error-message">Field Nama Kota harus diisi!</span> --}}
                                        {{-- @if($errors->has('nama_jenis_order'))
                                          <span class="invalid-feedback">{{ $errors->first('nama_jenis_order') }}</span>
                                        @endif --}}
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateJenisOrder">Close</button>
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