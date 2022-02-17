// selec de los productos al agregar una salida de almacen 
$(document).ready(function () {
    $("#selectProducto").select2();
});

// select de la ventana de vendedor al agregar una salida de alamacen
$('#selectVendedor').select2({
    dropdownParent: $('#modalVendedor')
});

// select de la ventana de vendedor al registrar una entrada de efecivo
$('#selectVendedorEntrada').select2({
    dropdownParent: $('#registroEntradaEfectivo')
});

// select de la ventana al agregar un nuevo credito
$('#selectVendedorCredito').select2({
    dropdownParent: $('#modalVendedorYcliente')
});

$('#selectClienteCredito').select2({
    dropdownParent: $('#modalVendedorYcliente')
});