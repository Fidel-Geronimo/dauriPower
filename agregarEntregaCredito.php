<?php
session_start();
include("db.php");
if (isset($_GET["id"])) {

    $query = "SELECT * from nuevaentregacredito";
    $result_facturacion = mysqli_query($conn, $query);
    $contador = 0; //controlo la descripcion del producto
    $total = 0;

    while ($row = mysqli_fetch_array($result_facturacion)) {
        $contador++;
        $idVendedor = $row['idVendedor'];
        $idCliente = $row['idCliente'];
        $vendedor = $row['vendedor'];
        $cliente = $row['cliente'];
        $producto = $row['producto'];
        $cantidad = $row['cantidad'];
        $precioCompra = $row['precioCompra'];
        $precioVenta = $row['precioVenta'];
        $subTotal = $row['subtotal'];
        $total = $total + $subTotal;

        if ($contador == 1) {
            $idDetalle = uniqid(); //AQUI SE GENERA UN ID UNICO PARA LA FACTURACION
            $descripcion = $producto;
        } else if ($contador == 2) {
            $descripcion = "Varios Productos";
        }

        $query = "INSERT INTO detalleentregacredito(vendedor,cliente, producto, cantidad, precioCompra,precioVenta,idDetalle,idVendedor,idCliente,subtotal) VALUES('$vendedor','$cliente','$producto','$cantidad','$precioCompra', '$precioVenta','$idDetalle','$idVendedor','$idCliente','$subTotal')";
        mysqli_query($conn, $query);
    }
    $query = "INSERT INTO entregamuestracredito(vendedor,cliente, descripcion,idDetalle,idvendedor,idCliente,total,estado) VALUES('$vendedor','$cliente','$descripcion','$idDetalle','$idVendedor','$idCliente','$total',1)";
    mysqli_query($conn, $query);

    $queryDelete = "DELETE from nuevaentregacredito";
    mysqli_query($conn, $queryDelete);

    $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Registró Un Creditos De Productos Al Cliente $cliente')";
    mysqli_query($conn, $queryHistorial);

    $_SESSION['EntregaAgregadaCredito'] = 1;

    echo $idDetalle;
?>
    <script>
        window.location = "creditos.php"
    </script>
<?php
}
?>
<?php include("includes/footer.php"); ?>