<?php
include("db.php");
$productoId = $_POST['productoId'];


if ($productoId != "") {
	$sql = "SELECT * from productos where id='$productoId'";
	$result = mysqli_query($conn, $sql);
	$ver = mysqli_fetch_array($result);

	$cadena = "<label for='costo'>Costo</label>
		<input readonly type='number' value='" . $ver['precioCompra'] . "' id='costo' name='costo' class='form-control' placeholder='Costo Del Producto'>
		<label for='precio'>Precio</label>
		<input readonly type='number' value='" . $ver['precioVenta'] . "' id='precio' name='precio' class='form-control' placeholder='Precio De Venta'>";
} else {
	$cadena = "<label for='costo'>Costo</label>
		<input readonly type='number' id='costo' name='costo' class='form-control' placeholder='Costo Del Producto'>
		<label for='precio'>Precio</label>
		<input readonly type='number' id='precio' name='precio' class='form-control' placeholder='Precio De Venta'>";
}

echo  $cadena;
