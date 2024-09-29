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
            <h1>Role</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><a href="#">Dropdown</a></div>
              <div class="breadcrumb-item active">Role</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tabel Role</h2>
            <p class="section-lead">
              Role disini menggambarkan tentang peran apa saja yang dimiliki oleh pengguna. Tabel ini penting dan krusial karena akan memengaruhi proses autentikasi dan dropdown.
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
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRole">Add Role</button>
                    </div>
                  </div>

                    <!-- TAMBAH ROLE -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="addRole" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeRole1">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-validation" id="roleForm" action="{{ route('admin.storeRole') }}" method="POST">
                        @csrf
                            <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_role" class="col-form-label">Nama Role: </label>
                                <input type="text" id="nama_role" name="nama_role" class="required-input form-control">
                                <span class="error-message" id="nama_role_error" style="display: none; color: red;">Field Nama Role harus diisi!</span>
                                <!-- @if($errors->has('nama_role'))
                                <span class="invalid-feedback">{{ $errors->first('nama_role') }}</span>
                                @endif -->
                            </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeRole2">Close</button>
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
                          <th scope="col" class="w-50">No</th>
                          <th scope="col" class="w-50">Nama Role</th>
                    
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($role as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{$admins->nama_role}}</td>
                          <td>

                          <!-- MODAL DELETE -->

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