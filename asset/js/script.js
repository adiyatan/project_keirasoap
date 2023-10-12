$(document).ready(function() {
    // hilangkan tombol cari
    $('#tombol-cari').hide();

    // event ketika keyword ditulis
    $('#keyword').on('keyup', function() {
        // munculkan icon loading
        $('.loader').show();

        // Use the id_user JavaScript variable
        $.get('../asset/ajax/sabun.php?keyword=' + $('#keyword').val() + '&id_user=' + id_user, function(data) {

            $('#tabel-sabun').html(data);
            $('.loader').hide();

        });
    });
});
