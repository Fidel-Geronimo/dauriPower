<?php
session_start();
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];

    $query = "DELETE FROM gastos WHERE id = $id";
    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
        die("Query Failed");
    }

    $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Elimino Un Gasto Del Sistema')";
    mysqli_query($conn, $queryHistorial);

    $_SESSION['deleteGasto'] = 1;

    header("Location: gastos.php");
}
