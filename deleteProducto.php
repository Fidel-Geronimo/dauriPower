<?php
session_start();
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $query = "DELETE FROM productos WHERE id = $id";
    $resultado = mysqli_query($conn, $query);

    $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Eliminó Un Producto Del Sistema')";
    mysqli_query($conn, $queryHistorial);

    if (!$resultado) {
        die("Query Failed");
    }
    $_SESSION['deleteProducto'] = 1;

    header("Location: almacen.php");
}
