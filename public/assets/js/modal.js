document.addEventListener("DOMContentLoaded", function () {
    var forms = document.getElementsByClassName("form-validation");

    // Melakukan iterasi pada setiap form
    Array.from(forms).forEach(function (form) {
        form.addEventListener("submit", function (event) {
            var inputFields = form.getElementsByClassName("required-input");
            var errorMessages = form.getElementsByClassName("error-message");

            // Menghapus pesan error sebelum validasi
            Array.from(errorMessages).forEach(function (errorMessage) {
                errorMessage.style.display = "none";
            });

            // Melakukan validasi pada setiap input field
            var hasError = false;
            Array.from(inputFields).forEach(function (inputField) {
                if (inputField.value.trim() === "") {
                    hasError = true;
                    var fieldName = inputField.getAttribute("name");
                    var errorMessage = form.querySelector(
                        '.error-message[data-for="' + fieldName + '"]'
                    );
                    inputField.classList.add("is-invalid");
                    errorMessage.style.display = "block";
                } else {
                    inputField.classList.remove("is-invalid");
                }
            });

            // Mencegah pengiriman form jika terdapat error
            if (hasError) {
                event.preventDefault();
            }
        });

        // Event listener untuk menutup modal
        form.addEventListener("hidden.bs.modal", function (e) {
            form.reset(); // Menggunakan method reset() untuk mereset nilai field
            resetFormValidation(form); // Memanggil fungsi resetFormValidation
        });
    });

    // Fungsi untuk mereset validasi form
    function resetFormValidation(form) {
        var inputFields = form.getElementsByClassName("required-input");
        var errorMessages = form.getElementsByClassName("error-message");

        // Menghapus pesan error dan kelas 'is-invalid'
        Array.from(inputFields).forEach(function (inputField) {
            inputField.classList.remove("is-invalid");
        });

        Array.from(errorMessages).forEach(function (errorMessage) {
            errorMessage.style.display = "none";
        });
    }
});
