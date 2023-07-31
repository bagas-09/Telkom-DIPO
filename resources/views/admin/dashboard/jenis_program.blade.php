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
            <h1>Jenis Program</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Jenis Program</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel jenis program</h2>
            <p class="section-lead">
              Dropdown Jenis Program disini akan tampil dan muncul pada formulir yang diisi oleh Maintenance! 
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
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addJenisProgram">Add Jenis</button>
                    </div>
                  </div>

                    <!-- TAMBAH ROLE -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="addJenisProgram" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Jenis</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeJenis1">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="jenisform" action="{{ route('admin.storeJenisProgram') }}" method="POST">
                        @csrf
                            <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_jenis_program" class="col-form-label">Nama Jenis Program: </label>
                                <input type="text" id="nama_jenis_program" name="nama_jenis_program" class="form-control">
                                <span id="nama_jenis_program_error" style="display: none; color: red;">Field Nama Jenis Program harus diisi!</span>
                                {{-- @if($errors->has('nama_jenis_program'))
                                <span class="invalid-feedback">{{ $errors->first('nama_jenis_program') }}</span>
                                @endif --}}
                            </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeJenis2">Close</button>
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
                          <th scope="col" class="w-50">Nama Jenis Program</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($type as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins -> nama_jenis_program}}</td>
                          <td>

                          <!-- MODAL DELETE -->
                          <a class="btn btn-sm btn-danger" 
                            data-toggle="modal" 
                            data-target="#deleteJenisModal{{$admins->id}}"
                            style="color: white"
                            data-toggle="modal" 
                            
                            >Delete</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteJenisModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Jenis Program</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeJenis1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Jenis Program yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeJenis2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteJenis', [$admins->id]) }}" value="Delete">Delete</a>
                                      </div>
                                  </div>
                                </div>
                            </div>

                            <!-- MODAL UPDATE -->
                            <a class="btn btn-sm btn-warning" data-toggle="modal" 
                            data-target="#editJenisModal-{{$admins->id}}"
                            
                            style="color: white" 
                            >Edit</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="editJenisModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Jenis Program</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeJenis1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="JenisUpdateForm" class="form-validation" 
                                  action="{{route('admin.updateJenis', [$admins->id])}}" 
                                  method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama_update_Jenis" class="col-form-label">Nama Jenis Program: </label>
                                        <input type="text" id="nama_update_Jenis" name="nama_jenis_program" class="form-control required-input" value="{{ $admins->nama_jenis_program }}" required>
                                        {{-- <span id="nama_jenis_program_error" class="error-message">Field Nama Kota harus diisi!</span> --}}
                                        {{-- @if($errors->has('nama_jenis_program'))
                                          <span class="invalid-feedback">{{ $errors->first(nama_jenis_program') }}</span>
                                        @endif --}}
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateJenis">Close</button>
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