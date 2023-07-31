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
                  {{-- ADD ACCOUNT --}}
                  <div class="card-header">
                    <div class="col-8">
                      <h4>Simple</h4>
                    </div>
                    <div class="col-4 d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Account</button>
                    </div>
                  </div>

                  <!-- TAMBAH ACCOUNT-->
                  <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Akun</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeAccount1">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form id="accountForm" action="{{route('admin.storeAccount')}}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              
                              <label for="nama" class="col-form-label">Nama: </label>
                              <input type="text" id="nama" name="nama" class="form-control">
                              <span class="input-error" id="nama" style="display: none; color: red;">Field Nama harus diisi!</span>

                              <label for="nik" class="col-form-label">NIK: </label>
                              <input type="text" id="nik" name="nik" class="form-control">
                              <span class="input-error" id="nik" style="display: none; color: red;">Field NIK harus diisi!</span>

                              <label for="password" class="col-form-label">Password: </label>
                              <input type="password" id="password" name="password" class="form-control">
                              <span class="input-error" id="password_error" style="display: none; color: red;">Field Password harus diisi!</span>

                              <label for="role" class="col-form-label">Role: </label>
                              <select class="role form-control" name="role">
                                <option value="" selected>-- Pilih Role --</option>
                                @foreach ($roles as $role)
                                    <option value=<?= $role->nama_role ?>>{{ $role->nama_role }}</option>
                                @endforeach
                              </select>
                              <span class="input-error" id="role_error" style="display: none; color: red;">Field Role harus diisi!</span>

                              <label for="id_nama_kota" class="col-form-label">Kota: </label>
                              <select class="id_nama_kota form-control" name="id_nama_kota">
                                <option value="" onclick="pushData('id_nama_kota')" selected>-- Pilih Kota --</option>
                                @foreach ($addcity as $city)
                                    <option value= {{ $city->id }}>{{ $city->nama_city }}</option>
                                @endforeach
                              </select>
                              <span class="input-error" id="kota_error" style="display: none; color: red;">Field Kota harus diisi!</span>

                              <label for="keterangan" class="col-form-label">Keterangan: </label>
                              <input type="text" id="keterangan" name="keterangan" class="form-control">
                              {{-- <textarea id="keterangan" name="keterangan" class="form-control" rows="10" cols="500"></textarea> --}}
                              <span class="input-error" id="keterangan_error" style="display: none; color: red;">Field Keterangan harus diisi!</span>
                            </div>
                          </div>
                          <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeAccount2">Close</button>
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
                          <th scope="col">Nama</th>
                          <th scope="col">NIK</th>
                          {{-- <th scope="col" class="w-50">Password</th> --}}
                          <th scope="col">Role</th>
                          <th scope="col">Kota</th>
                          <th scope="col">Keterangan</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1 ?>
                        @foreach ($account as $admins)
                        <tr>
                          <th scope="row">{{$i++}}</th>
                          <td>{{ $admins ->nama}}</td>
                          <td>{{ $admins ->nik}}</td>
                          {{-- <td>{{ $admins ->password}}</td> --}}
                          <td>{{ $admins ->role}}</td>
                          {{-- <td>{{ $admins ->id_nama_kota}}</td> --}}
                          <td>{{ $citys[$admins->id_nama_kota]}}</td>
                          <td>{{ $admins ->keterangan}}</td>

                          <td>
                            <a class="btn btn-sm btn-danger" 
                            {{-- data-toggle="modal" data-target="#deleteModal{{$admins->id}}" --}}
                            style="color: white"
                            data-toggle="modal" data-target="#deleteAccountModal{{ $admins->id }}"
                            >Delete</a>


                            {{-- MODAL DELETE --}}
                            <div class="modal fade" tabindex="-1" role="dialog" id="deleteAccountModal{{ $admins->id }}" data-backdrop="static">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Hapus Akun</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeAccount1">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    @csrf
                                      <div class="modal-body">
                                        Pilih "Delete" dibawah ini jika Anda yakin menghapus Akun yang dipilih.
                                      </div>
                                      <div class="modal-footer bg-whitesmoke br">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeAccount2">Cancel</button>
                                        <a class="btn btn-danger" href="{{ route('admin.deleteAccount', [$admins->id]) }}" value="Delete">Delete</a>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            {{-- <a class="btn btn-sm btn-warning" href="#">Edit</a> --}}

                            {{-- UPDATE CITY --}}
                            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editAccountModal-{{$admins->id}}" style="color: white" 
                            >Edit</a>
                            <div class="modal fade" tabindex="-1" role="dialog" id="editAccountModal-{{$admins->id}}" data-backdrop="static">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Ubah Akun</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeAccount1">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form id="accountUpdateForm" class="form-validation" action="{{route('admin.updateAccount', [$admins->id])}}" method="POST">
                                  @csrf
                                    <div class="modal-body">
                                      <div class="form-group">
                                        <label for="nama" class="col-form-label">Nama: </label>
                                        <input type="text" id="nama" name="nama" class="form-control" value="{{ $admins->nama }}">
                                        <span id="nama" style="display: none; color: red;">Field Nama harus diisi!</span>

                                        <label for="nik" class="col-form-label">NIK: </label>
                                        <input type="text" id="nik" name="nik" class="form-control" value="{{ $admins->nik }}">
                                        <span id="nik" style="display: none; color: red;">Field NIK harus diisi!</span>

                                        <label for="password" class="col-form-label">Password: </label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Kosong">
                                        <span id="password_error" style="display: none; color: red;">Field Password harus diisi!</span>

                                        <label for="role" class="col-form-label">Role: </label>
                                        <select class="role form-control" name="role">
                                          <option value="{{$admins->role}}" selected>{{$admins->role}}</option>
                                          @foreach ($roles as $role)
                                              @if ($role->nama_role !== $admins->role)
                                                  <option value="{{ $role->nama_role }}">{{ $role->nama_role }}</option>
                                              @endif
                                          @endforeach
                                        </select>
                                        <span id="role_error" style="display: none; color: red;">Field Role harus diisi!</span>

                                        <label for="id_nama_kota" class="col-form-label">Kota: </label>
                                        <select class="id_nama_kota form-control" name="id_nama_kota">
                                          <option value="{{$admins->id_nama_kota}}" onclick="pushData('id_nama_kota')" selected>{{$citys[$admins->id_nama_kota]}}</option>
                                          @foreach ($addcity as $city)
                                            @if ($citys[$admins->id_nama_kota] !== $city->nama_city)
                                              <option value= {{ $city->id }}>{{ $city->nama_city }}</option>
                                            @endif
                                          @endforeach
                                        </select>
                                        <span id="kota_error" style="display: none; color: red;">Field Kota harus diisi!</span>

                                        <label for="keterangan" class="col-form-label">Keterangan: </label>
                                        <input type="text" id="keterangan" name="keterangan" class="form-control" value="{{ $admins->keterangan }}">
                                        {{-- <textarea id="keterangan" name="keterangan" class="form-control" rows="10" cols="500"></textarea> --}}
                                        <span id="keterangan_error" style="display: none; color: red;">Field Keterangan harus diisi!</span>
                                      </div>
                                    </div>
                                    <div class="modal-footer bg-whitesmoke br">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeUpdateAccount">Close</button>
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