$(document).ready(function () {
    $('#ugyfelForm').submit(function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajax({
            url: '/actions/ugyfel_mentes.php',
            method: 'POST',
            data: formData,
            success: function (response) {
                alert('Sikeres mentés!');
                $('#formModal').modal('hide');
                $('#ugyfelTable').DataTable().ajax.reload(); // újratöltés
            },
            error: function (xhr) {
                alert('Hiba történt: ' + xhr.responseText);
            }
        });
    });
});