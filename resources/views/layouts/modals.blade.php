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
  function resetForm4() {
    var inputField = document.getElementById('nama_jenis_program');
    var errorMessage = document.getElementById('nama_jenis_program_error');
    
    inputField.value = ''; // Menghapus nilai di field input
    inputField.classList.remove('is-invalid'); // Menghapus kelas CSS 'is-invalid'
    errorMessage.style.display = 'none'; // Menyembunyikan pesan error
  }
  // Event listener untuk menutup modal
  $('#addJenisProgram').on('hidden.bs.modal', function (e) {
    resetForm4(); // Memanggil fungsi resetForm saat modal ditutup
  });
  // Event listener saat form dikirim
  document.getElementById('jenisform').addEventListener('submit', function(event) {
    var inputField = document.getElementById('nama_jenis_program');
    var errorMessage = document.getElementById('nama_jenis_program_error');
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

{{-- VALIDASI ADD STATUS TAGIHAN--}}
<script>
  // Fungsi untuk mereset field dan pesan error
  function resetForm5() {
    var inputField = document.getElementById('nama_status_tagihan');
    var errorMessage = document.getElementById('nama_status_tagihan_error_error');
    
    inputField.value = ''; // Menghapus nilai di field input
    inputField.classList.remove('is-invalid'); // Menghapus kelas CSS 'is-invalid'
    errorMessage.style.display = 'none'; // Menyembunyikan pesan error
  }
  // Event listener untuk menutup modal
  $('#addStatusTagihan').on('hidden.bs.modal', function (e) {
    resetForm5(); // Memanggil fungsi resetForm saat modal ditutup
  });
  // Event listener saat form dikirim
  document.getElementById('StatusTagihanform').addEventListener('submit', function(event) {
    var inputField = document.getElementById('nama_status_tagihan');
    var errorMessage = document.getElementById('nama_status_tagihan_error');
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

{{-- VALIDASI ADD PROGRAM --}}
<script>
  // Fungsi untuk mereset field dan pesan error
  function resetForm6() {
    var inputField = document.getElementById('nama_program');
    var errorMessage = document.getElementById('nama_program_error');
    
    inputField.value = ''; // Menghapus nilai di field input
    inputField.classList.remove('is-invalid'); // Menghapus kelas CSS 'is-invalid'
    errorMessage.style.display = 'none'; // Menyembunyikan pesan error
  }
  // Event listener untuk menutup modal
  $('#addProgram').on('hidden.bs.modal', function (e) {
    resetForm6(); // Memanggil fungsi resetForm saat modal ditutup
  });
  // Event listener saat form dikirim
  document.getElementById('ProgramForm').addEventListener('submit', function(event) {
    var inputField = document.getElementById('nama_program');
    var errorMessage = document.getElementById('nama_program_error');
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

{{-- VALIDASI ADD STATUS PEKERJAAN --}}
<script>
  // Fungsi untuk mereset field dan pesan error
// Fungsi untuk mereset field dan pesan error
function resetForm7() {
  var inputField = document.getElementsByClassName('nama_status_pekerjaan');
  var roleSelect = document.getElementsByClassName('role_status_pekerjaan');
  var namaError = document.getElementsByClassName('nama_status_pekerjaan_error');
  var roleError = document.getElementsByClassName('role_status_pekerjaan_error');

  inputField[0].value = '';
  roleSelect[0].value = ''; // Menyeting nilai kolom select menjadi kosong
  inputField[0].classList.remove('is-invalid');
  roleSelect[0].classList.remove('is-invalid');
  namaError[0].style.display = 'none';
  roleError[0].style.display = 'none';
}

// Event listener untuk menutup modal
$('#addStatusPekerjaan').on('hidden.bs.modal', function (e) {
  resetForm7(); // Memanggil fungsi resetForm saat modal ditutup
});

// Event listener saat form dikirim
document.getElementById('statusPekerjaanForm').addEventListener('submit', function(event) {
  var inputField = document.getElementsByClassName('nama_status_pekerjaan');
  var roleSelect = document.getElementsByClassName('role_status_pekerjaan');
  var namaError = document.getElementsByClassName('nama_status_pekerjaan_error');
  var roleError = document.getElementsByClassName('role_status_pekerjaan_error');

  if (inputField[0].value.trim() === '') {
    event.preventDefault();
    inputField[0].classList.add('is-invalid');
    namaError[0].style.display = 'block';
  } else {
    inputField[0].classList.remove('is-invalid');
    namaError[0].style.display = 'none';
  }

  if (roleSelect[0].value === '') {
    event.preventDefault();
    roleSelect[0].classList.add('is-invalid');
    roleError[0].style.display = 'block';
  } else {
    roleSelect[0].classList.remove('is-invalid');
    roleError[0].style.display = 'none';
  }
});
</script>

{{-- VALIDASI ADD STATUS PEKERJAAN --}}
<script>
  // Fungsi untuk mereset field dan pesan error
// Fungsi untuk mereset field dan pesan error
function resetForm8() {
  var inputField = document.getElementsByClassName('nama_tipe_kemitraan');
  var roleSelect = document.getElementsByClassName('role_tipe_kemitraan');
  var namaError = document.getElementsByClassName('nama_tipe_kemitraan_error');
  var roleError = document.getElementsByClassName('role_tipe_kemitraan_error');

  inputField[0].value = '';
  roleSelect[0].value = ''; // Menyeting nilai kolom select menjadi kosong
  inputField[0].classList.remove('is-invalid');
  roleSelect[0].classList.remove('is-invalid');
  namaError[0].style.display = 'none';
  roleError[0].style.display = 'none';
}

// Event listener untuk menutup modal
$('#addTipeKemitraan').on('hidden.bs.modal', function (e) {
  resetForm8(); // Memanggil fungsi resetForm saat modal ditutup
});

// Event listener saat form dikirim
document.getElementById('tipeKemitraanForm').addEventListener('submit', function(event) {
  var inputField = document.getElementsByClassName('nama_tipe_kemitraan');
  var roleSelect = document.getElementsByClassName('role_tipe_kemitraan');
  var namaError = document.getElementsByClassName('nama_tipe_kemitraan_error');
  var roleError = document.getElementsByClassName('role_tipe_kemitraan_error');

  if (inputField[0].value.trim() === '') {
    event.preventDefault();
    inputField[0].classList.add('is-invalid');
    namaError[0].style.display = 'block';
  } else {
    inputField[0].classList.remove('is-invalid');
    namaError[0].style.display = 'none';
  }

  if (roleSelect[0].value === '') {
    event.preventDefault();
    roleSelect[0].classList.add('is-invalid');
    roleError[0].style.display = 'block';
  } else {
    roleSelect[0].classList.remove('is-invalid');
    roleError[0].style.display = 'none';
  }
});
</script>

<script>
  // Fungsi untuk mereset field dan pesan error
  function resetForm9() {
    var inputField = document.getElementById('nama_tipe_provisioning');
    var errorMessage = document.getElementById('nama_tipe_provisioning_error');
    
    inputField.value = ''; // Menghapus nilai di field input
    inputField.classList.remove('is-invalid'); // Menghapus kelas CSS 'is-invalid'
    errorMessage.style.display = 'none'; // Menyembunyikan pesan error
  }

  // Event listener untuk menutup modal
  $('#addTipeProvisioning').on('hidden.bs.modal', function (e) {
    resetForm9(); // Memanggil fungsi resetForm saat modal ditutup
  });

  // Event listener saat form dikirim
  document.getElementById('tipeProvisioningForm').addEventListener('submit', function(event) {
    var inputField = document.getElementById('nama_tipe_provisioning');
    var errorMessage = document.getElementById('nama_tipe_provisioning_error');

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
function resetForm10() {
  var inputField = document.getElementsByClassName('nama_mitra');
  var roleSelect = document.getElementsByClassName('role_mitra');
  var namaError = document.getElementsByClassName('nama_mitra_error');
  var roleError = document.getElementsByClassName('role_mitra_error');

  inputField[0].value = '';
  roleSelect[0].value = ''; // Menyeting nilai kolom select menjadi kosong
  inputField[0].classList.remove('is-invalid');
  roleSelect[0].classList.remove('is-invalid');
  namaError[0].style.display = 'none';
  roleError[0].style.display = 'none';
}

// Event listener untuk menutup modal
$('#addMitra').on('hidden.bs.modal', function (e) {
  resetForm10(); // Memanggil fungsi resetForm saat modal ditutup
});

// Event listener saat form dikirim
document.getElementById('mitraForm').addEventListener('submit', function(event) {
  var inputField = document.getElementsByClassName('nama_mitra');
  var roleSelect = document.getElementsByClassName('role_mitra');
  var namaError = document.getElementsByClassName('nama_mitra_error');
  var roleError = document.getElementsByClassName('role_mitra_error');

  if (inputField[0].value.trim() === '') {
    event.preventDefault();
    inputField[0].classList.add('is-invalid');
    namaError[0].style.display = 'block';
  } else {
    inputField[0].classList.remove('is-invalid');
    namaError[0].style.display = 'none';
  }

  if (roleSelect[0].value === '') {
    event.preventDefault();
    roleSelect[0].classList.add('is-invalid');
    roleError[0].style.display = 'block';
  } else {
    roleSelect[0].classList.remove('is-invalid');
    roleError[0].style.display = 'none';
  }
});
</script>

<script>
  // Fungsi untuk mereset field dan pesan error
  function resetForm() {
    var inputs = document.querySelectorAll("#accountForm .form-control");
    var errorElements = document.querySelectorAll("#accountForm .input-error");

    inputs.forEach(function(input) {
      input.value = '';
      input.classList.remove("is-invalid");
    });

    errorElements.forEach(function(errorElement) {
      errorElement.style.display = "none";
    });
  }

  // Event listener untuk menutup modal
  $('#exampleModal').on('hidden.bs.modal', function (e) {
    resetForm(); // Memanggil fungsi resetForm saat modal ditutup
  });

  // Event listener saat form dikirim
  document.getElementById('accountForm').addEventListener('submit', function(event) {
    var inputs = this.querySelectorAll('.form-control');
    var isValid = true;

    inputs.forEach(function(input) {
      if (input.value.trim() === '') {
        isValid = false;
        input.classList.add('is-invalid');
        var errorElement = input.nextElementSibling;
        if (errorElement && errorElement.classList.contains('input-error')) {
          errorElement.style.display = 'block';
        }
      } else {
        input.classList.remove('is-invalid');
      }
    });

    if (!isValid) {
      event.preventDefault(); // Mencegah pengiriman form
    }
  });
  
  // Event listener saat tombol close diklik
  document.getElementById('closeAccount1').addEventListener('click', function() {
    resetForm(); // Memanggil fungsi resetForm saat tombol close diklik
  });
</script>

