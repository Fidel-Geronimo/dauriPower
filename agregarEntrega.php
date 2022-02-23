<?php
session_start();
include("db.php");
if (isset($_GET["id"])) {

    $query = "SELECT * from nuevaentrega";
    $result_facturacion = mysqli_query($conn, $query);
    // $row = mysqli_fetch_array($result_facturacion);

    $contador = 0; //controlo la descripcion del producto
    $total = 0;

    while ($row = mysqli_fetch_array($result_facturacion)) {
        $contador++;
        $idVendedor = $row['idVendedor'];
        $vendedor = $row['vendedor'];
        $producto = $row['producto'];
        $cantidad = $row['cantidad'];
        $precioCompra = $row['precioCompra'];
        $precioVenta = $row['precioVenta'];
        $subTotal = $row['subtotal'];
        $total = $total + $subTotal;
        $idProducto = $row['idProducto'];

        $queryProductos = "SELECT existencia from productos WHERE id=$idProducto"; //SELECCIONA LOS PRODUCTOS QUE SE LE VA A MODIFICAR LA EXISTENCIA
        $resultProductos = mysqli_query($conn, $queryProductos);
        $rowProductos = mysqli_fetch_array($resultProductos);
        $existenciaAntigua = $rowProductos['existencia'];
        $existenciaNueva = $existenciaAntigua - $cantidad;

        if ($contador == 1) {
            $idDetalle = uniqid(); //AQUI SE GENERA UN ID UNICO PARA LA FACTURACION
            $descripcion = $producto;
        } else if ($contador == 2) {
            $descripcion = "Varios Productos";
        }

        $queryExistencia = "UPDATE productos set existencia = '$existenciaNueva' WHERE id = $idProducto";
        mysqli_query($conn, $queryExistencia);

        $query = "INSERT INTO detalleentregas(vendedor, producto, cantidad, precioCompra,precioVenta,idDetalle,idVendedor,subtotal,idProducto) VALUES('$vendedor','$producto','$cantidad','$precioCompra', '$precioVenta','$idDetalle','$idVendedor','$subTotal','$idProducto')";
        mysqli_query($conn, $query);
    }
    if ($contador != 0) {
        $query = "INSERT INTO entregasmuestra(vendedor, descripcion,idDetalle,idvendedor,total,estado) VALUES('$vendedor','$descripcion','$idDetalle','$idVendedor','$total',1)";
        mysqli_query($conn, $query);

        $queryDelete = "DELETE from nuevaentrega";
        mysqli_query($conn, $queryDelete);

        $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Realizo Una Entrega De Productos a $vendedor')";
        mysqli_query($conn, $queryHistorial);

        $_SESSION['entrega'] = 1;
        unset($_SESSION['Contenido']);
    }

?>
    <script>
        window.location = "index.php"
    </script>
<?php
}
?>
<?php include("includes/footer.php"); ?>