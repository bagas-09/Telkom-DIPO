{{-- VALIDASI ADD CITY --}}
<script>
  // Fungsi untuk mereset field dan pesan error
  function resetForm1() {
    var inputField = document.getElementById('nama_city');
    var errorMessage = document.getElementById('nama_city_error');
    
    inputField.value = ''; // Menghapus nilai di field input
    inputField.classList.remove('is-invalid'); // Menghapus kelas CSS 'is-invalid'
    errorMessage.style.display = 'none'; // Menyembunyikan pesan error
  }

  // Event listener untuk menutup modal
  $('#exampleModal').on('hidden.bs.modal', function (e) {
    resetForm1(); // Memanggil fungsi resetForm saat modal ditutup
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

{{-- VALIDASI ADD ROLE --}}
<script>
  // Fungsi untuk mereset field dan pesan error
  function resetForm2() {
    var inputField = document.getElementById('nama_role');
    var errorMessage = document.getElementById('nama_role_error');
    
    inputField.value = ''; // Menghapus nilai di field input
    inputField.classList.remove('is-invalid'); // Menghapus kelas CSS 'is-invalid'
    errorMessage.style.display = 'none'; // Menyembunyikan pesan error
  }

  // Event listener untuk menutup modal
  $('#addRole').on('hidden.bs.modal', function (e) {
    resetForm2(); // Memanggil fungsi resetForm saat modal ditutup
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

{{-- VALIDASI ADD STATUS --}}
<script>
  // Fungsi untuk mereset field dan pesan error
  function resetForm3() {
    var inputField = document.getElementById('nama_status');
    var errorMessage = document.getElementById('nama_status_error');
    
    inputField.value = ''; // Menghapus nilai di field input
    inputField.classList.remove('is-invalid'); // Menghapus kelas CSS 'is-invalid'
    errorMessage.style.display = 'none'; // Menyembunyikan pesan error
  }

  // Event listener untuk menutup modal
  $('#addStatus').on('hidden.bs.modal', function (e) {
    resetForm3(); // Memanggil fungsi resetForm saat modal ditutup
  });

  // Event listener saat form dikirim
  document.getElementById('statusForm').addEventListener('submit', function(event) {
    var inputField = document.getElementById('nama_status');
    var errorMessage = document.getElementById('nama_status_error');

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

{{-- VALIDASI ADD JENIS PROGRAM --}}
<script>
  // Fungsi untuk mereset field dan pesan error
  function resetForm3() {
    var inputField = document.getElementById('nama_jenis_program');
    var errorMessage = document.getElementById('nama_jenis_program_error');

VALIDASI ADD JENIS ORDER
<script>
  // Fungsi untuk mereset field dan pesan error
  function resetForm4() {
    var inputField = document.getElementById('nama_jenis_order');
    var errorMessage = document.getElementById('nama_jenis_order_error');
    
    inputField.value = ''; // Menghapus nilai di field input
    inputField.classList.remove('is-invalid'); // Menghapus kelas CSS 'is-invalid'
    errorMessage.style.display = 'none'; // Menyembunyikan pesan error
  }

  // Event listener untuk menutup modal
CRUD-JenisProgram
  $('#addJenisProgram').on('hidden.bs.modal', function (e) {
    resetForm3(); // Memanggil fungsi resetForm saat modal ditutup
  });

  // Event listener saat form dikirim
  document.getElementById('jenisform').addEventListener('submit', function(event) {
    var inputField = document.getElementById('nama_jenis_program');
    var errorMessage = document.getElementById('nama_jenis_program_error');

  $('#addJenisOrder').on('hidden.bs.modal', function (e) {
    resetForm4(); // Memanggil fungsi resetForm saat modal ditutup
  });

  // Event listener saat form dikirim
  document.getElementById('jenisOrderForm').addEventListener('submit', function(event) {
    var inputField = document.getElementById('nama_jenis_order');
    var errorMessage = document.getElementById('nama_jenis_order_error');

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