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
            <h1>Program</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Program</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel Program</h2>
            <p class="section-lead">
              Dropdown Program disini akan tampil dan muncul pada formulir yang diisi oleh Konstruksi!
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

            @error('nama_program')
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
                  {{-- ADD Program --}}
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProgram">Add Program</button>
                    </div>
                  </div>

                  <!-- TAMBAH Program -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="addProgram" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Program</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeProgram1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form class="form-validation" id="ProgramForm" action="{{route('admin.storeProgram')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_program" class="col-form-label">Nama Program: </label>
                              <input type="text" id="nama_program" name="nama_program" class="required-input form-control">
                              <span class="error-message" id="nama_program_error" style="display: none; color: red;">Field Nama Program harus diisi!</span>
                              {{-- @if($errors->has('nama_city'))
                                <span class="invalid-feedback">{{ $errors->first('nama_city') }}</span>
                              @endif --}}
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeProgram2">Close</button>
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
                          <th scope="col" class="w-50">Nama Program</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($program as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama_program}}</td>
                          <td>
                            <a class="btn btn-sm btn-danger" 
                            {{-- data-toggle="modal" data-target="#deleteModal{{$admins->id}}" --}}
                            style="color: white"
                            data-toggle="modal" data-target="#deleteProgramModal{{ $admins->id }}"
                            >Delete</a>
                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteProgramModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Program</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeProgram1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Program yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeProgram2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteProgram', [$admins->id]) }}" value="Delete">Delete</a>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            {{-- <a class="btn btn-sm btn-warning" href="#">Edit</a> --}}

                            {{-- UPDATE Program --}}
                            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editProgramModal-{{$admins->id}}" style="color: white" 
                            >Edit</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="editProgramModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Program</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeProgram1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="ProgramUpdateForm" class="form-validation" action="{{route('admin.updateProgram', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_update_program" class="col-form-label">Nama Program: </label>
                                        <input type="text" id="nama_update_program" name="nama_program" class="form-control" value="{{ $admins->nama_program }}" required>
                                        {{-- <span id="nama_program_error" class="error-message">Field Nama Kota harus diisi!</span> --}}
                                        {{-- @if($errors->has('nama_program'))
                                          <span class="invalid-feedback">{{ $errors->first('nama_program') }}</span>
                                        @endif --}}
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateProgram">Close</button>
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