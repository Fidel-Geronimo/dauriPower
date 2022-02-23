<?php
session_start();
include("db.php");
include("includes/header.php");
if (isset($_GET["id"])) {

    if ($_POST['titulo'] == "") { ?>
        <script>
            Swal.fire({
                title: "Error Titulo",
                text: "Agrega Un Titulo Es Obligatorio!",
                confirmButtonText: "Aceptar",
                confirmButtonColor: '#007bff',
                icon: 'error'
            }).then(function() {
                window.location = "nuevaEntrada.php";
            });
        </script>
    <?php } else {

        $query = "SELECT * from nuevaentrada"; //SELECCIONA LOS PRODUCTOS EN LA TABLA DE ENTRADA
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
            $idProducto = $row['idProducto'];
            $total = $total + $subTotal;

            $queryProductos = "SELECT existencia from productos WHERE id=$idProducto"; //SELECCIONA LOS PRODUCTOS QUE SE LE VA A MODIFICAR LA EXISTENCIA
            $resultProductos = mysqli_query($conn, $queryProductos);
            $rowProductos = mysqli_fetch_array($resultProductos);
            $existenciaAntigua = $rowProductos['existencia'];
            $existenciaNueva = $existenciaAntigua + $cantidad;

            if ($contador == 1) {
                $idDetalle = uniqid(); //AQUI SE GENERA UN ID UNICO PARA LA FACTURACION
                $titulo = $_POST['titulo'];
            }

            $queryExistencia = "UPDATE productos set existencia = '$existenciaNueva' WHERE id = $idProducto";
            mysqli_query($conn, $queryExistencia);

            $query = "INSERT INTO detalleentrada (producto, cantidad, precioCompra,precioVenta,idDetalle,subTotal,idProducto) VALUES('$producto','$cantidad','$precioCompra', '$precioVenta','$idDetalle','$subTotal','$idProducto')";
            mysqli_query($conn, $query);
        }
        if ($contador != 0) {
            $query = "INSERT INTO historialentradas(descripcion,total,idDetalle,estado) VALUES('$titulo','$total','$idDetalle',1)";
            mysqli_query($conn, $query);

            $queryDelete = "DELETE from nuevaentrada";
            mysqli_query($conn, $queryDelete);

            $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Agrego Existencia A Algunos Productos')";
            mysqli_query($conn, $queryHistorial);

            $_SESSION['agregadoEntrada'] = 1;
        }


    ?>
        <script>
            window.location = "almacen.php"
        </script>
<?php
    }
}
?>
<?php include("includes/footer.php"); ?>