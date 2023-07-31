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
            <h1>Status Pekerjaan</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Status Pekerjaan</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel Status Pekerjaan</h2>
            <p class="section-lead">
              Dropdown Status Pekerjaan disini akan tampil dan muncul pada formulir yang diisi oleh Konstruksi dan Maintenance!
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
                  {{-- ADD STATUS PEKERJAAN--}}
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStatusPekerjaan">Add Status Pekerjaan</button>
                    </div>
                  </div>

                  <!-- TAMBAH STATUS PEKERJAAN -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="addStatusPekerjaan" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Status Pekerjaan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeStatusPekerjaan1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form id="statusPekerjaanForm" action="{{route('admin.storeStatusPekerjaan')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_status_pekerjaan" class="col-form-label">Nama Status Pekerjaan: </label>
                              <input type="text" name="nama_status_pekerjaan" class="nama_status_pekerjaan form-control">
                              <span class="nama_status_pekerjaan_error" style="display: none; color: red;">Field Nama Status Pekerjaan harus diisi!</span>

                              <label for="role_status_pekerjaan" class="col-form-label">Role: </label>
                              <select class="role_status_pekerjaan form-control" name="role">
                                <option value="" selected>-- Pilih Role --</option>
                                @foreach ($roless as $role)
                                    <option value=<?= $role->nama_role ?>>{{ $role->nama_role }}</option>
                                @endforeach
                              </select>
                              <span class="role_status_pekerjaan_error" style="display: none; color: red;">Field Role harus dipilih!</span>
                              {{-- @if($errors->has('nama_city'))
                                <span class="invalid-feedback">{{ $errors->first('nama_city') }}</span>
                              @endif --}}
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeStatusPekerjaan2">Close</button>
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
                          <th scope="col" class="w-25">Nama Status</th>
                          <th scope="col" class="w-25">Role</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($status_pekerjaan as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_status_pekerjaan}}</td>
                          <td>{{ $admins ->role}}</td>
                          <td>

                            {{-- MODAL DELETE --}}
                            <a class="btn btn-sm btn-danger" 
                            style="color: white"
                            data-toggle="modal" 
                            data-target="#deleteStatusPekerjaanModal{{ $admins->id }}"
                            >Delete</a>

                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteStatusPekerjaanModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Status Pekerjaan</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeStatusPekerjaan1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Status Pekerjaan yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeStatusPekerjaan2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteStatusPekerjaan', [$admins->id]) }}" value="Delete">Delete</a>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            
                            {{-- MODAL UPDATE --}}
                            <a class="btn btn-sm btn-warning" data-toggle="modal" 
                            data-target="#editStatusPekerjaanModal-{{$admins->id}}" 
                            style="color: white" 
                            >Edit</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="editStatusPekerjaanModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Status Pekerjaan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeStatusPekerjaan1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="statusPekerjaanUpdateForm" class="form-validation" action="{{route('admin.updateStatusPekerjaan', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_status_pekerjaan" class="col-form-label">Nama Status Pekerjaan: </label>
                                        <input type="text" name="nama_status_pekerjaan" class="nama_status_pekerjaan form-control" value="{{ $admins->nama_status_pekerjaan }}" required>
                                        <span class="nama_status_pekerjaan_error" style="display: none; color: red;">Field Nama Status Pekerjaan harus diisi!</span>

                                        <label for="role_status_pekerjaan" class="col-form-label">Role: </label>
                                        <select class="role_status_pekerjaan form-control" name="role">
                                          <option value="{{$admins->role}}" selected>{{$admins->role}}</option>
                                          @foreach ($roless as $role)
                                              @if ($role->nama_role !== $admins->role)
                                                  <option value="{{ $role->nama_role }}">{{ $role->nama_role }}</option>
                                              @endif
                                          @endforeach
                                        </select>
                                        <span class="role_status_pekerjaan_error" style="display: none; color: red;">Field Role harus dipilih!</span>
                                        {{-- @if($errors->has('nama_city'))
                                          <span class="invalid-feedback">{{ $errors->first('nama_city') }}</span>
                                        @endif --}}
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeStatusPekerjaan2">Close</button>
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