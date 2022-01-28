$(document).ready(function () {
    // $('#selectProducto').val(1);
    recargarLista();

    $('#selectProducto').change(function () {
        recargarLista();
    });
})

function recargarLista() {
    $.ajax({
        type: "POST",
        url: "datos.php",
        data: "productoId=" + $('#selectProducto').val(),
        success: function (r) {
            $('#select2lista').html(r);
        }
    });
}