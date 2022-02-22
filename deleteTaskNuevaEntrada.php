<?php
session_start();
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];

    $queryEntregas = "DELETE FROM nuevaentrada WHERE id = '$id'";
    $resultado = mysqli_query($conn, $queryEntregas);

    if (!$resultado) {
        die("Query Failed");
    }

    $_SESSION['productoDelete'] = 1;

    header("Location: nuevaEntrada.php");
}
