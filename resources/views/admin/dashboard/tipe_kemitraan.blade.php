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
            <h1>Tipe Kemitraan</h1>
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
                  {{-- ADD TIPE KEMITRAAN--}}
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTipeKemitraan">Add Tipe Kemitraan</button>
                    </div>
                  </div>

                  <!-- TAMBAH TIPE KEMITRAAN -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="addTipeKemitraan" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Tipe Kemitraan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeTipeKemitraan1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form id="tipeKemitraanForm" action="{{route('admin.storeTipeKemitraan')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_tipe_kemitraan" class="col-form-label">Nama Tipe Kemitraan: </label>
                              <input type="text" name="nama_tipe_kemitraan" class="nama_tipe_kemitraan form-control">
                              <span class="nama_tipe_kemitraan_error" style="display: none; color: red;">Field Nama Tipe Kemitraan harus diisi!</span>

                              <label for="role_tipe_kemitraan" class="col-form-label">Role: </label>
                              <select class="role_tipe_kemitraan form-control" name="role">
                                <option value="" selected>-- Pilih Role --</option>
                                @foreach ($roless as $role)
                                    <option value=<?= $role->nama_role ?>>{{ $role->nama_role }}</option>
                                @endforeach
                              </select>
                              <span class="role_tipe_kemitraan_error" style="display: none; color: red;">Field Role harus dipilih!</span>
                              {{-- @if($errors->has('nama_city'))
                                <span class="invalid-feedback">{{ $errors->first('nama_city') }}</span>
                              @endif --}}
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeTipeKemitraan2">Close</button>
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
                          <th scope="col" class="w-25">Nama Tipe Kemitraan</th>
                          <th scope="col" class="w-25">Role</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($tipe_kemitraan as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_tipe_kemitraan}}</td>
                          <td>{{ $admins ->role}}</td>
                          <td>

                            {{-- MODAL DELETE --}}
                            <a class="btn btn-sm btn-danger" 
                            style="color: white"
                            data-toggle="modal" 
                            data-target="#deleteTipeKemitraanModal{{ $admins->id }}"
                            >Delete</a>

                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteTipeKemitraanModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Tipe Kemitraan</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeTipeKemitraan1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Tipe Kemitraan yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeTipeKemitraan2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteTipeKemitraan', [$admins->id]) }}" value="Delete">Delete</a>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            
                            {{-- MODAL UPDATE --}}
                            <a class="btn btn-sm btn-warning" data-toggle="modal" 
                            data-target="#editTipeKemitraanModal-{{$admins->id}}" 
                            style="color: white" 
                            >Edit</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="editTipeKemitraanModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Tipe Kemitraan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeTipeKemitraan1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="tipeKemitraanUpdateForm" class="form-validation" action="{{route('admin.updateTipeKemitraan', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_tipe_kemitraan" class="col-form-label">Nama Tipe Kemitraan: </label>
                                        <input type="text" name="nama_tipe_kemitraan" class="nama_tipe_kemitraan form-control" value="{{ $admins->nama_tipe_kemitraan }}" required>
                                        <span class="nama_tipe_kemitraan_error" style="display: none; color: red;">Field Nama Tipe Kemitraan harus diisi!</span>

                                        <label for="role_tipe_kemitraan" class="col-form-label">Role: </label>
                                        <select class="role_tipe_kemitraan form-control" name="role">
                                          <option value="{{$admins->role}}" selected>{{$admins->role}}</option>
                                          @foreach ($roless as $role)
                                              @if ($role->nama_role !== $admins->role)
                                                  <option value="{{ $role->nama_role }}">{{ $role->nama_role }}</option>
                                              @endif
                                          @endforeach
                                        </select>
                                        <span class="role_tipe_kemitraan_error" style="display: none; color: red;">Field Role harus dipilih!</span>
                                        {{-- @if($errors->has('nama_city'))
                                          <span class="invalid-feedback">{{ $errors->first('nama_city') }}</span>
                                        @endif --}}
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeTipeKemitraan2">Close</button>
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