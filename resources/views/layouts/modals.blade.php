<!-- MODAL CITY  -->

<!-- TAMBAH CITY -->
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeCity1">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="cityForm" action="{{route('admin.storeCity')}}" method="POST">
      @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_city" class="col-form-label">Nama Kota: </label>
            <input type="text" id="nama_city" name="nama_city" class="form-control">
            <span id="nama_city_error" style="display: none; color: red;">Field Nama Kota harus diisi!</span>
            {{-- @if($errors->has('nama_city'))
              <span class="invalid-feedback">{{ $errors->first('nama_city') }}</span>
            @endif --}}
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeCity2">Close</button>
          <button type="submit" class="btn btn-primary" value="Simpan Data">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>




<style>
  .is-invalid {
    border-color: red;
    /* Atau atur properti lainnya untuk mengubah tampilan field input menjadi merah */
  }
</style>

<script>
  // Fungsi untuk mereset field dan pesan error
  function resetForm() {
    var inputField = document.getElementById('nama_city');
    var errorMessage = document.getElementById('nama_city_error');
    
    inputField.value = ''; // Menghapus nilai di field input
    inputField.classList.remove('is-invalid'); // Menghapus kelas CSS 'is-invalid'
    errorMessage.style.display = 'none'; // Menyembunyikan pesan error
  }

  // Event listener untuk menutup modal
  $('#exampleModal').on('hidden.bs.modal', function (e) {
    resetForm(); // Memanggil fungsi resetForm saat modal ditutup
  });

  // Event listener saat form dikirim
  document.getElementById('cityForm').addEventListener('submit', function(event) {
    var inputField = document.getElementById('nama_city');
    var errorMessage = document.getElementById('nama_city_error');

    if (inputField.value.trim() === '') {
      event.preventDefault(); // Mencegah pengiriman form
      inputField.classList.add('is-invalid'); // Menambahkan kelas CSS 'is-invalid'
      errorMessage.style.display = 'block'; // Menampilkan pesan error
    } else {
      inputField.classList.remove('is-invalid'); // Menghapus kelas CSS 'is-invalid'
      errorMessage.style.display = 'none'; // Menyembunyikan pesan error
    }
  });
</script>

<script>
  // Fungsi untuk mereset field dan pesan error
  function resetForm() {
    var inputField = document.getElementById('nama_role');
    var errorMessage = document.getElementById('nama_role_error');
    
    inputField.value = ''; // Menghapus nilai di field input
    inputField.classList.remove('is-invalid'); // Menghapus kelas CSS 'is-invalid'
    errorMessage.style.display = 'none'; // Menyembunyikan pesan error
  }

  // Event listener untuk menutup modal
  $('#addRole').on('hidden.bs.modal', function (e) {
    resetForm(); // Memanggil fungsi resetForm saat modal ditutup
  });

  // Event listener saat form dikirim
  document.getElementById('roleForm').addEventListener('submit', function(event) {
    var inputField = document.getElementById('nama_role');
    var errorMessage = document.getElementById('nama_role_error');

    if (inputField.value.trim() === '') {
      event.preventDefault(); // Mencegah pengiriman form
      inputField.classList.add('is-invalid'); // Menambahkan kelas CSS 'is-invalid'
      errorMessage.style.display = 'block'; // Menampilkan pesan error
    } else {
      inputField.classList.remove('is-invalid'); // Menghapus kelas CSS 'is-invalid'
      errorMessage.style.display = 'none'; // Menyembunyikan pesan error
    }
  });
</script>

<!-- UBAH CITY  -->