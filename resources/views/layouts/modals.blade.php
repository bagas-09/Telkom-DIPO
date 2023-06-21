{{-- MODAL CITY --}}  

{{-- TAMBAH CITY --}}
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="cityForm" action="{{route('admin.storeCity')}}" method="POST">
      @csrf
        <div class="modal-body">
          <div class="form-group">
            {{-- <label for="kode_counter" class="col-form-label">Id</label>
            <input type="text" id="kode_counter" name="kode_counter" class="form-control" disabled> --}}
            <label for="nama_counter" class="col-form-label">Nama Kota: </label>
            <input type="text" id="nama_city" name="nama_city" class="form-control" value="{{ old('nama_city') }}">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- UBAH CITY --}}