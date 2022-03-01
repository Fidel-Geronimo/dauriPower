function confirmacion(idDetalle) {//confirmacion al eliminar un registro Completo
    Swal.fire({
        title: "Decide",
        text: "Desea Eliminar Esta Entrega de Productos?, No Se Puede Revertir!",
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
// Creditos acciones
function confirmacionEliminarCredito(idDetalle) {//confirmacion al eliminar un registro Completo de credito
    Swal.fire({
        title: "Decide",
        text: "Desea Eliminar Este Credito?",
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
function confirmacionProductoCredito(id, idVendedor, idCliente) {//confirmacion al eliminar un producto en especifico de la pantalla del archivo nuevaEntregaCredito
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
            window.location.href = "deleteTaskNuevaEntregaCredito.php?id=" + id + "&idVendedor=" + idVendedor + "&idCliente=" + idCliente;
        }
    });
}

function confirmacionEditTaskCredito(id, idDetalle, idVendedor, idCliente) {//confirmacion al eliminar un producto en especifico de la pantalla del archico EditEntregaCredito
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
            window.location.href = "deleteTaskEditCredito.php?id=" + id + "&idDetalle=" + idDetalle + "&idVendedor=" + idVendedor + "&idCliente=" + idCliente;
        }
    });
}
// =============================================================
// Clientes================================
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
// =====================================================
// Vendedores================================
function confirmacionVendedor(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Eiminar este Vendedor? No se puede revertir!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "deleteVendedor.php?id=" + id;
        }
    });
}
// =====================================================
// producto================================
function confirmacionProductoAlmacen(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Eiminar este Producto? No se puede revertir!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "deleteProducto.php?id=" + id;
        }
    });
}
// para borrar un producto en la cesta de la entrada de productos
function confirmacionProductoEntrada(id, idVendedor) {//confirmacion al eliminar un producto en especifico de la pantalla nuevaEntrada.php
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
            window.location.href = "deleteTaskNuevaEntrada.php?id=" + id;
        }
    });
}
// =====================================================
// Gastos================================
function confirmarEliminarGasto(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Eiminar este Gasto? No se puede revertir!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "deleteGasto.php?id=" + id;
        }
    });
}
// =====================================================
// eliminar efectivo de la tabla de entrada efectivo
function confirmarEliminarEfectivo(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Eiminar este Efectivo? No se puede revertir!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "deleteEfectivo.php?id=" + id;
        }
    });
}
// Eliminar Entrada en el historial de entradas
function confirmarEliminarEntrada(id) {
    Swal.fire({
        title: "Decide",
        text: "Desea Eliminar Esta Entrada?, Se Va A Revertir El Agregado!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Eliminar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "deleteTaskEntrada.php?idDetalle=" + id;
        }
    });
}
// =====================================================
// Realizar Cuadre
function confirmarCierre(efectivo, entregas, entradas, creditos, gastos) {
    Swal.fire({
        title: "Decide",
        text: "Seguro Que Desea Realizar El cuadre?, No Se Puede Revertir!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Sí, Cuadrar",
        cancelButtonText: "No",
    }).then((resultado) => {
        if (resultado.value) {
            window.location.href = "cuadre.php?close=true&efectivo=" + efectivo + "&entregas=" + entregas + "&entradas=" + entradas + "&creditos=" + creditos + "&gastos=" + gastos;
        }
    });
}
// =====================================================
