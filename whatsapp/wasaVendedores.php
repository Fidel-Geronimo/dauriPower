<?php
include("../db.php");

if (isset($_GET["idVendedor"])) {
    $idVendedor = $_GET["idVendedor"];

    $query = "SELECT * FROM vendedores WHERE id = $idVendedor";
    $resultado = mysqli_query($conn, $query);
    if (mysqli_num_rows($resultado) == 1) {

        $rowVendedor = mysqli_fetch_array($resultado);
        $telefonoVendedor = $rowVendedor["telefono"];
        header("Location: https://wa.me/1$telefonoVendedor?text=");
    } else { ?>
        <script>
            alert("Informacion del Vendedor no encontrada");
        </script>
<?php }
}
?>