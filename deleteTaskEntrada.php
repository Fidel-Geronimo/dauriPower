<?php
session_start();
include("db.php");

if (isset($_GET["idDetalle"])) {
    $idDetalle = $_GET['idDetalle'];;

    $queryProductos = "SELECT idProducto,cantidad from detalleentrada WHERE idDetalle='$idDetalle'"; //SELECCIONA LOS PRODUCTOS QUE SE LE VA A MODIFICAR LA EXISTENCIA
    $resultProductos = mysqli_query($conn, $queryProductos);

    while ($rowProductos = mysqli_fetch_array($resultProductos)) {
        $idProducto = $rowProductos['idProducto'];
        $cantidad = $rowProductos['cantidad'];

        $queryExistencia = "SELECT existencia from productos WHERE id=$idProducto"; //SELECCIONA LOS PRODUCTOS QUE SE LE VA A MODIFICAR LA EXISTENCIA
        $resultExistecia = mysqli_query($conn, $queryExistencia);
        $rowExistencia = mysqli_fetch_array($resultExistecia);

        $existenciaAntigua = $rowExistencia['existencia'];
        $existenciaNueva = $existenciaAntigua - $cantidad;

        $queryExistencia = "UPDATE productos set existencia = '$existenciaNueva' WHERE id = $idProducto";
        mysqli_query($conn, $queryExistencia);
    }

    $queryEntregas = "DELETE FROM detalleentrada WHERE idDetalle = '$idDetalle'";
    $resultado = mysqli_query($conn, $queryEntregas);

    $queryMuestras = "DELETE FROM historialentradas WHERE idDetalle = '$idDetalle'";
    $resultado = mysqli_query($conn, $queryMuestras);

    $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Eliminó Un Registro De Entradas De Productos')";
    mysqli_query($conn, $queryHistorial);

    if (!$resultado) {
        die("Query Failed");
    }

    $_SESSION['eliminarEntradas'] = 1;

    header("Location: almacen.php");
}
