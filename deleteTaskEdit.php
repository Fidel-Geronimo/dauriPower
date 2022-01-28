<?php
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $idDetalle = $_GET['idDetalle'];
    $idVendedor = $_GET['idVendedor'];

    // formateamos la tabla de revertir en la base de datos
    // $queryReset = "DELETE FROM revertir";
    // mysqli_query($conn, $queryReset);

    // $queryRevertir = "SELECT * FROM gas WHERE id= $id";
    // $resultadoRevertir = mysqli_query($conn, $queryRevertir);
    // if (mysqli_num_rows($resultadoRevertir) == 1) {
    //     $rowRevertir = mysqli_fetch_array($resultadoRevertir);
    //     $id = $rowRevertir["id"];
    //     $nombre = $rowRevertir["nombre"];
    //     $fecha = $rowRevertir["fecha"];
    //     $galones = $rowRevertir["galones"];
    //     $precio = $rowRevertir["precio"];
    //     $abono = $rowRevertir["abono"];
    //     $deuda = $rowRevertir["Deuda"];
    //     $credito = $rowRevertir["credito"];
    //     $comentario = $rowRevertir["comentario"];
    //     $idCliente = $rowRevertir["idCliente"];

    //     $queryRespaldo = "INSERT INTO revertir(id, nombre, fecha, galones,precio,abono,Deuda,credito,comentario,idCliente) VALUES('$id','$nombre','$fecha','$galones','$precio','$abono', '$deuda', '$credito','$comentario','$idCliente')";
    //     mysqli_query($conn, $queryRespaldo);
    // }\

    // busqueda y rebajada del total que se muestra en el index
    $queryDetalle = "SELECT * FROM detalleentregas WHERE id = $id";
    $resultadoDetalle = mysqli_query($conn, $queryDetalle);
    $rowDetalle = mysqli_fetch_array($resultadoDetalle);
    $totalDetalle = $rowDetalle['subtotal'];

    $queryEntregas = "SELECT * FROM entregasmuestra WHERE idDetalle = '$idDetalle'";
    $resultadoEntregas = mysqli_query($conn, $queryEntregas);
    $rowEntregas = mysqli_fetch_array($resultadoEntregas);
    $totalEntregas = $rowEntregas['total'] - $totalDetalle;
    // ==================================================================

    $queryEntregas = "UPDATE entregasmuestra SET total=$totalEntregas WHERE idDetalle = '$idDetalle'";
    $resultado = mysqli_query($conn, $queryEntregas);

    $queryDetalle = "DELETE FROM detalleentregas WHERE id = $id";
    $resultadoDetalle = mysqli_query($conn, $queryDetalle);

    if (!$resultado) {
        die("Query Failed");
    }

    // $_SESSION["revertir"] = 1;
    // $_SESSION['messageDelete'] = 1;


    header("Location: editEntrega.php?idDetalle=$idDetalle&idVendedor=$idVendedor");
}
