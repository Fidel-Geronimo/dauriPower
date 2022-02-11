<?php
session_start();
include("db.php");
if (isset($_GET["id"])) {

    $query = "SELECT * from nuevaentrada";
    $resultEntrada = mysqli_query($conn, $query);
    $contador = 0; //controlo la descripcion del producto
    $total = 0;

    while ($row = mysqli_fetch_array($resultEntrada)) {
        $contador++;

        $producto = $row['producto'];
        $cantidad = $row['cantidad'];
        $precioCompra = $row['precioCompra'];
        $precioVenta = $row['precioVenta'];
        $subTotal = $row['subTotal'];
        $total = $total + $subTotal;

        if ($contador == 1) {
            $idDetalle = uniqid(); //AQUI SE GENERA UN ID UNICO PARA LA FACTURACION
            $descripcion = $producto;
        } else if ($contador == 2) {
            $descripcion = "Varios Productos";
        }

        $query = "INSERT INTO detalleentrada (producto, cantidad, precioCompra,precioVenta,idDetalle,subTotal) VALUES('$producto','$cantidad','$precioCompra', '$precioVenta','$idDetalle','$subTotal')";
        mysqli_query($conn, $query);
    }
    $query = "INSERT INTO historialentradas(descripcion,total,idDetalle) VALUES('$descripcion','$total','$idDetalle')";
    mysqli_query($conn, $query);

    $queryDelete = "DELETE from nuevaentrada";
    mysqli_query($conn, $queryDelete);

    // $_SESSION['message'] = 1;
    // $_SESSION['NombreCliente'] = $nombre;
    // $_SESSION['TelefonoCliente'] = $telefono;
    // $_SESSION['galonesCliente'] = $galones;
    // $_SESSION['deudaCliente'] = $deuda;
    // $_SESSION['AbonoCliente'] = $abono;
    // $_SESSION['precioCliente'] = $precio; 
?>
    <script>
        window.location = "almacen.php"
    </script>
<?php
}
?>
<?php include("includes/footer.php"); ?>