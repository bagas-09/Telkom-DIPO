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
            <h1>Status</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Status</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel Status</h2>
            <p class="section-lead">
              Dropdown Status disini akan tampil dan muncul pada formulir yang diisi oleh Commerce!
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

            @error('nama_status')
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
                  {{-- ADD STATUS--}}
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStatus">Add Status</button>
                    </div>
                  </div>

                {{-- MODAL TAMBAH STATUS--}}
                <div class="modal fade" tabindex="-1" role="dialog" id="addStatus" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeStatus1">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="form-validation" id="statusForm" action="
                            {{ route('admin.storeStatus') }}
                            {{-- {{route('admin.storeStatus')}} --}}
                            " method="POST">
                            @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama_status" class="col-form-label">Nama Status: </label>
                                        <input type="text" id="nama_status" name="nama_status" class="required-input form-control">
                                        <span class="error-message" id="nama_status_error" style="display: none; color: red;">Field Nama Status harus diisi!</span>
                                        {{-- @if($errors->has('nama_status'))
                                        <span class="invalid-feedback">{{ $errors->first('nama_status') }}</span>
                                        @endif --}}
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
                    <table class="table" id="table-1">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col" class="w-50">Nama Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($status as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_status}}</td>
                          <td>

                            {{-- MODAL DELETE --}}
                            <a class="btn btn-sm btn-danger" 
                            style="color: white"
                            data-toggle="modal" 
                            data-target="#deleteStatusModal{{ $admins->id }}"
                            >Delete</a>

                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteStatusModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Status</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeStatus1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Status yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeStatus2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteStatus', [$admins->id]) }}" value="Delete">Delete</a>
                                      </div>
                                  </div>
                                </div>
                            </div>

                            {{-- MODAL UPDATE --}}
                            <a class="btn btn-sm btn-warning" data-toggle="modal" 
                            data-target="#editStatusModal-{{$admins->id}}" 
                            style="color: white" 
                            >Edit</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="editStatusModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Kota</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeStatus1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="statusUpdateForm" class="form-validation" action="{{route('admin.updateStatus', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_update_status" class="col-form-label">Nama Kota: </label>
                                        <input type="text" id="nama_update_status" name="nama_status" class="form-control required-input" value="{{ $admins->nama_status }}" required>
                                        {{-- <span id="nama_status_error" class="error-message">Field Nama Kota harus diisi!</span> --}}
                                        {{-- @if($errors->has('nama_status'))
                                          <span class="invalid-feedback">{{ $errors->first('nama_status') }}</span>
                                        @endif --}}
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#table-1').dataTable();
    });
</script>
@endpush