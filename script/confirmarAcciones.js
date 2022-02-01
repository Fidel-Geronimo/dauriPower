function confirmacion(idDetalle) {//confirmacion al eliminar un registro Completo
    Swal.fire({
        title: "Decide",
        text: "Desea Eliminar Este Producto?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "deleteTaskAgregado.php?idDetalle=" + idDetalle;
        }
    });
}

function confirmacionProducto(id, idVendedor) {//confirmacion al eliminar un producto en especifico de la pantalla del archico nuevaEntrega
    Swal.fire({
        title: "Decide",
        text: "Desea Eliminar Este Articulo?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "deleteTaskNuevaEntrega.php?id=" + id + "&idVendedor=" + idVendedor;
        }
    });
}
function confirmacionEditTask(id, idDetalle, idVendedor) {//confirmacion al eliminar un producto en especifico de la pantalla del archico EditEntrega
    Swal.fire({
        title: "Decide",
        text: "Desea Eliminar Este Articulo?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "deleteTaskEdit.php?id=" + id + "&idDetalle=" + idDetalle + "&idVendedor=" + idVendedor;
        }
    });
}

function confirmacionEliminarCredito(idDetalle) {//confirmacion al eliminar un registro Completo de credito
    Swal.fire({
        title: "Decide",
        text: "Desea Eliminar Este Producto?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "deleteTaskAgregadoCredito.php?idDetalle=" + idDetalle;
        }
    });
}

function confirmacionPagoBono(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Marcar como pago Esta Factura?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Pagar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "marcarPagoBono.php?id=" + id;
        }
    });
}

function confirmacionCliente(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Eiminar este cliente? No se puede revertir!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "deleteCliente.php?id=" + id;
        }
    });
}

function confirmacionReenvioGas(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Reenviar Esta Factura?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Reenviar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "Whatsapp/wasaReenvioGas.php?id=" + id;
        }
    });
}

function confirmacionReenvioBonos(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Reenviar Esta Factura?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Reenviar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "Whatsapp/wasaReenvioBonos.php?id=" + id;
        }
    });
}
// SCRIPS  DEL  KM 15=====================================
function confirmacionKm15(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Eliminar Esta Factura?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "deleteTaskkm15.php?id=" + id;
        }
    });
}

function confirmacionPagoKm15(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Marcar como pago Esta Factura?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Pagar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "marcarPagokm15.php?id=" + id;
        }
    });
}

function confirmacionBonosKm15(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Eliminar Esta Factura?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "../km15/deleteTask-bonosKm15.php?id=" + id;
        }
    });
}

function confirmacionPagoBonoKm15(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Marcar como pago Esta Factura?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Pagar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "marcarPagoBonoKm15.php?id=" + id;
        }
    });
}

function confirmacionClienteKm15(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Eiminar este cliente?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "deleteClienteKm15.php?id=" + id;
        }
    });
}

function confirmacionReenvioGasKm15(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Reenviar Esta Factura?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Reenviar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href =
                "WhatsappKm15/wasaReenvioGasKm15.php?idCliente=" + id;
        }
    });
}

function confirmacionReenvioBonosKm15(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Reenviar Esta Factura?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Reenviar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href =
                "WhatsappKm15/wasaReenvioBonosKm15.php?idCliente=" + id;
        }
    });
}
