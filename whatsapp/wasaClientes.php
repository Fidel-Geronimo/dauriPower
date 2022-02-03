<?php
include("../db.php");

if (isset($_GET["idCliente"])) {
    $idCliente = $_GET["idCliente"];

    $query = "SELECT * FROM clientes WHERE id = $idCliente";
    $resultado = mysqli_query($conn, $query);
    if (mysqli_num_rows($resultado) == 1) {

        $rowCliente = mysqli_fetch_array($resultado);
        $telefonoCliente = $rowCliente["telefono"];
        header("Location: https://wa.me/1$telefonoCliente?text=");
    } else { ?>
        <script>
            alert("Informacion del cliente no encontrada");
        </script>
<?php }
}
?>