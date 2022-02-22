<?php
session_start();
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $idVendedor = $_GET['idVendedor'];

    $queryEntregas = "DELETE FROM nuevaentrega WHERE id = '$id'";
    $resultado = mysqli_query($conn, $queryEntregas);
    echo $idVendedor;

    if (!$resultado) {
        die("Query Failed");
    }

    $_SESSION['deleteProductoEntrega'] = 1;

    header("Location: nuevaEntrega.php?idVendedor=$idVendedor");
}
