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
} else {
    if ($_SESSION["rol"] == 2) {
        header("Location: km15/facturacionkm15.php");
    }
} ?>
<!-- ============================================ -->
<?php
?>


<div class="container mb-3 mt-2">
    <div class="row align-items-center">
        <div class="col">
            <h3>Detalle de la entrega</h1>
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
                    <th>Productos</th>
                    <th style="color: #0000FF;">Cantidad</th>
                    <th style="color: #ff0000 ">Costo</th>
                    <th style="color: #38b52d ">Precio Venta</th>
                    <th>Sub Total</th>

                </tr>
            </thead>
            <tbody id=" developers">
                <?php

                $query = "SELECT * from detalleentrada where idDetalle ='$idDetalle' ";
                $result_facturacion = mysqli_query($conn, $query);
                $contador = 0;

                while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                    <tr>
                        <td><?php echo $row['producto']; ?></td>
                        <td style="color:#0000FF"><?php echo $row['cantidad'] ?></td>
                        <td style="color: #ff0000 "><?php echo $row['precioCompra']; ?></td>
                        <td style="color: #38b52d "><?php echo $row['precioVenta']; ?></td>
                        <td><?php echo $row['subTotal']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<?php include("includes/footer.php") ?>