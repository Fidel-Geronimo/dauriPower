<?php
session_start();
include("db.php");

if (isset($_GET["idDetalle"])) { //si existe el idDetalle
    // datos de la factura
    $idDetalle = $_GET["idDetalle"];
}
?>

<!--  -->
<?php
include("includes/header.php");
?>
<!-- verificacion de inicio de sesion -->
<?php

if (!isset($_SESSION["rol"])) {
    header("Location: login.php");
}  ?>



<div class="container mb-3 mt-2">
    <div class="row align-items-center">
        <div class="col">
            <h3>HISTORIAL DE CUADRES</h1>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="table-responsive">
        <!-- tabla -->

        <table class="table table-striped table-bordered" style="width:100%" id="example">
            <thead>
                <tr>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id=" developers">
                <?php

                $query = "SELECT * FROM historialcuadres ORDER BY fecha DESC";
                $result_facturacion = mysqli_query($conn, $query);
                $contador = 0;

                while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                    <tr>
                        <td><a href="detalleEntrada.php?idDetalle=<?php echo $row['fecha']; ?>" class="text-decoration-none text-dark"><?php echo $row['fecha']; ?></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<?php include("includes/footer.php") ?>