<?php
session_start();
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];

    $query = "DELETE FROM efectivo WHERE id = $id";
    $resultado = mysqli_query($conn, $query);

    $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Elimino Una Entrada De Efectivo')";
    mysqli_query($conn, $queryHistorial);

    if (!$resultado) {
        die("Query Failed");
    }
    $_SESSION['deleteEfectivo'] = 1;

    header("Location: efectivo.php");
}
