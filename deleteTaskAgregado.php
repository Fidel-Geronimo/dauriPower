<?php
session_start();
include("db.php");

if (isset($_GET["idDetalle"])) {
    $idDetalle = $_GET['idDetalle'];;

    $queryProductos = "SELECT idProducto,cantidad from detalleentregas WHERE idDetalle='$idDetalle'"; //SELECCIONA LOS PRODUCTOS QUE SE LE VA A MODIFICAR LA EXISTENCIA
    $resultProductos = mysqli_query($conn, $queryProductos);

    while ($rowProductos = mysqli_fetch_array($resultProductos)) {
        $idProducto = $rowProductos['idProducto'];
        $cantidad = $rowProductos['cantidad'];

        $queryExistencia = "SELECT existencia from productos WHERE id=$idProducto"; //SELECCIONA LOS PRODUCTOS QUE SE LE VA A MODIFICAR LA EXISTENCIA
        $resultExistecia = mysqli_query($conn, $queryExistencia);
        $rowExistencia = mysqli_fetch_array($resultExistecia);

        $existenciaAntigua = $rowExistencia['existencia'];
        $existenciaNueva = $existenciaAntigua + $cantidad;

        $queryExistencia = "UPDATE productos set existencia = '$existenciaNueva' WHERE id = $idProducto";
        mysqli_query($conn, $queryExistencia);
    }

    $queryEntregas = "DELETE FROM detalleentregas WHERE idDetalle = '$idDetalle'";
    $resultado = mysqli_query($conn, $queryEntregas);

    $queryMuestras = "DELETE FROM entregasmuestra WHERE idDetalle = '$idDetalle'";
    $resultado = mysqli_query($conn, $queryMuestras);

    $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Eliminó Un Registro De Entrega De Productos')";
    mysqli_query($conn, $queryHistorial);

    if (!$resultado) {
        die("Query Failed");
    }

    $_SESSION['eliminarEntrega'] = 1;

    header("Location: index.php");
}
