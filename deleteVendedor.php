<?php
include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $query = "DELETE FROM vendedores WHERE id = $id";
    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
        die("Query Failed");
    }
    $_SESSION['messageDelete'] = 1;

    header("Location: vendedores.php");
}
