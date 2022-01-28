<?php
session_start();
include("db.php");
include("includes/header.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    if ($id == 1) {
        // // aqui se guarda el id del cliente al facturarlo
        // $idVendedor = $_GET["idVendedor"];
        // $query = "SELECT * FROM vendedores where id=$idVendedor";
        // $resultadoCliente = mysqli_query($conn, $query);
        // $row = mysqli_fetch_array($resultadoCliente);

        // $queryIdDetalle = "SELECT * FROM nuevaentrega";
        // $resultadoIdDetalle = mysqli_query($conn, $queryIdDetalle);
        // $rowIdDetalle = mysqli_fetch_array($resultadoIdDetalle);
        $nombre = $_POST['nombre'];
        $precioCompra = $_POST['costo'];
        $precioVenta = $_POST['precio'];
        $existencia = $_POST['existencia'];
        $comentario = ucfirst(strtolower($_POST['comentario']));



        // date_default_timezone_set('America/Caracas'); //Aplicandole zona horario a la hora
        // $DateAndTime = date('d-m-y', time()); //capturacion de la hora actual
        // if ($_GET["abono"] != "") {
        //   $comentario = $comentario . " / " . "El " . $DateAndTime . " Abonó " . $abono . " pesos";
        // }

        $query = "INSERT INTO productos(nombre,precioCompra,precioVenta,existencia, comentario) VALUES('$nombre','$precioCompra','$precioVenta','$existencia', '$comentario')";

        mysqli_query($conn, $query);

        // $_SESSION['message'] = 1;
        // $_SESSION['NombreCliente'] = $nombre;
        // $_SESSION['TelefonoCliente'] = $telefono;
        // $_SESSION['galonesCliente'] = $galones;
        // $_SESSION['deudaCliente'] = $deuda;
        // $_SESSION['AbonoCliente'] = $abono;
        // $_SESSION['precioCliente'] = $precio; 
?>
        <script>
            window.location = "almacen.php";
        </script>
<?php

    }
}


?>

<style>
    .editwidth {
        max-width: 540px !important;
    }
</style>

<!-- verificacion de inicio de sesion -->
<?php
if (!isset($_SESSION["rol"])) {
    header("Location: login.php");
}
?>
<!--  -->

<div class="container p-4 shadow editwidth">
    <div class="col-md-8 mx-auto">
        <div class="card_body">
            <form action="nuevoProducto.php?id=1" method="post" id="formulario">
                <div class="form-group mb-2">
                    <label for="nombre">Nombre: </label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre Del Producto">
                </div>
                <div class="form-group mb-2">
                    <label for="costo">Costo: </label>
                    <input type="number" id="costo" name="costo" class="form-control" placeholder="Costo Del Producto">
                </div>
                <div class="form-group mb-2">
                    <label for="precio">Precio: </label>
                    <input type="precio" id="precio" name="precio" class="form-control" placeholder="Precio Del Producto">
                </div>
                <div class="form-group mb-2">
                    <label for="existencia">Existencia: </label>
                    <input type="number" id="existencia" name="existencia" class="form-control" placeholder="Existencia En Almacen">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Comentarios Adicionales</label>
                    <textarea name="comentario" placeholder="Agrega un comentario (OPCIONAL)" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button class="btn btn-success" name="facturar">
                    AGREGAR
                </button>
            </form>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>