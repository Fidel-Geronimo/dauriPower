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
            <h3>HISTORIAL ENTRADAS</h1>
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
                    <th>Descripcion</th>
                    <th style="color: #38b52d;">Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody id=" developers">
                <?php

                $query = "SELECT * FROM historialentradas ORDER BY fecha DESC";
                $result_facturacion = mysqli_query($conn, $query);
                $contador = 0;

                while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                    <tr>
                        <td><a href="detalleEntrada.php?idDetalle=<?php echo $row['idDetalle']; ?>" class="text-decoration-none text-dark"><?php echo $row['descripcion']; ?></a></td>
                        <td style="color:#38b52d;"><?php echo $row['total'] ?></td>
                        <td><?php echo $row['fecha']; ?></td>
                        <td>
                            <a onclick="confirmarEliminarEntrada('<?php echo $row['idDetalle'] ?>')" class="btn btn-danger botonesOpciones elimina">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<?php include("includes/footer.php") ?>