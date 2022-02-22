<?php
session_start();
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $idVendedor = $_GET['idVendedor'];
    $idCliente = $_GET['idCliente'];

    $queryEntregas = "DELETE FROM nuevaentregacredito WHERE id = '$id'";
    $resultado = mysqli_query($conn, $queryEntregas);
    echo $idVendedor;

    if (!$resultado) {
        die("Query Failed");
    }

    $_SESSION['ProductoEliminadoCredito'] = 1;

    header("Location: nuevaEntregaCredito.php?idVendedor=$idVendedor&idCliente=$idCliente");
}
