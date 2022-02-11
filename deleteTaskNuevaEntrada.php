<?php
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];
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
    // }



    $queryEntregas = "DELETE FROM nuevaentrada WHERE id = '$id'";
    $resultado = mysqli_query($conn, $queryEntregas);

    if (!$resultado) {
        die("Query Failed");
    }
    // $_SESSION["revertir"] = 1;
    // $_SESSION['messageDelete'] = 1;

    header("Location: nuevaEntrada.php");
}
