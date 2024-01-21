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
            <h1>Mitra</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Mitra</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel Mitra</h2>
            <p class="section-lead">
              Dropdown Mitra disini akan tampil dan muncul pada formulir yang diisi oleh Maintenance dan Konstruksi!
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

            @error('nama_mitra')
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
                  {{-- ADD MITRA--}}
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMitra">Add Mitra</button>
                    </div>
                  </div>

                  <!-- TAMBAH MITRA -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="addMitra" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Mitra</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeMitra1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form id="mitraForm" action="{{route('admin.storeMitra')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_mitra" class="col-form-label">Nama Mitra: </label>
                              <input type="text" name="nama_mitra" class="nama_mitra form-control">
                              <span class="nama_mitra_error" style="display: none; color: red;">Field Nama Mitra harus diisi!</span>

                              <label for="role_mitra" class="col-form-label">Role: </label>
                              <select class="role_mitra form-control" name="role">
                                <option value="" selected>-- Pilih Role --</option>
                                @foreach ($roless as $role)
                                    <option value=<?= $role->nama_role ?>>{{ $role->nama_role }}</option>
                                @endforeach
                              </select>
                              <span class="role_mitra_error" style="display: none; color: red;">Field Role harus dipilih!</span>
                              {{-- @if($errors->has('nama_city'))
                                <span class="invalid-feedback">{{ $errors->first('nama_city') }}</span>
                              @endif --}}
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeMitra2">Close</button>
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
                          <th scope="col" class="w-25">Nama Mitra</th>
                          <th scope="col" class="w-25">Role</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($mitra as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_mitra}}</td>
                          <td>{{ $admins ->role}}</td>
                          <td>

                            {{-- MODAL DELETE --}}
                            <a class="btn btn-sm btn-danger" 
                            style="color: white"
                            data-toggle="modal" 
                            data-target="#deleteMitraModal{{ $admins->id }}"
                            >Delete</a>

                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteMitraModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Mitra</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeMitra1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Mitra yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeMitra2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteMitra', [$admins->id]) }}" value="Delete">Delete</a>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            
                            {{-- MODAL UPDATE --}}
                            <a class="btn btn-sm btn-warning" data-toggle="modal" 
                            data-target="#editMitraModal-{{$admins->id}}" 
                            style="color: white" 
                            >Edit</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="editMitraModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Mitra</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeMitra1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="mitraUpdateForm" class="form-validation" action="{{route('admin.updateMitra', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_mitra" class="col-form-label">Nama Mitra: </label>
                                        <input type="text" name="nama_mitra" class="nama_mitra form-control" value="{{ $admins->nama_mitra }}" required>
                                        <span class="nama_mitra_error" style="display: none; color: red;">Field Nama Mitra harus diisi!</span>

                                        <label for="role_mitra" class="col-form-label">Role: </label>
                                        <select class="role_mitra form-control" name="role">
                                          <option value="{{$admins->role}}" selected>{{$admins->role}}</option>
                                          @foreach ($roless as $role)
                                              @if ($role->nama_role !== $admins->role)
                                                  <option value="{{ $role->nama_role }}">{{ $role->nama_role }}</option>
                                              @endif
                                          @endforeach
                                        </select>
                                        <span class="role_mitra_error" style="display: none; color: red;">Field Role harus dipilih!</span>
                                        {{-- @if($errors->has('nama_city'))
                                          <span class="invalid-feedback">{{ $errors->first('nama_city') }}</span>
                                        @endif --}}
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeMitra2">Close</button>
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