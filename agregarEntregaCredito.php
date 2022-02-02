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
    $query = "INSERT INTO entregamuestracredito(vendedor,cliente, descripcion,idDetalle,idvendedor,idCliente,total) VALUES('$vendedor','$cliente','$descripcion','$idDetalle','$idVendedor','$idCliente','$total')";
    mysqli_query($conn, $query);

    $queryDelete = "DELETE from nuevaentregacredito";
    mysqli_query($conn, $queryDelete);

    // $_SESSION['message'] = 1;
    // $_SESSION['NombreCliente'] = $nombre;
    // $_SESSION['TelefonoCliente'] = $telefono;
    // $_SESSION['galonesCliente'] = $galones;
    // $_SESSION['deudaCliente'] = $deuda;
    // $_SESSION['AbonoCliente'] = $abono;
    // $_SESSION['precioCliente'] = $precio; 

    echo $idDetalle;
?>
    <script>
        window.location = "creditos.php"
    </script>
<?php
}
?>
<?php include("includes/footer.php"); ?>