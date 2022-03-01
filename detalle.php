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
            <h3>DETALLE ENTREGA</h1>
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
                    <th>Vendedor</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th style="color: #38b52d;">Sub Total</th>

                </tr>
            </thead>
            <tbody id=" developers">
                <?php

                $query = "SELECT * from detalleentregas where idDetalle ='$idDetalle' ";
                $result_facturacion = mysqli_query($conn, $query);
                $contador = 0;
                $total = 0;

                while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                    <tr>
                        <td><?php echo $row['vendedor']; ?></td>
                        <td><?php echo $row['producto']; ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td><?php echo $row['precioCompra']; ?></td>
                        <td><?php echo $row['precioVenta'] ?></td>
                        <td style="color:#38b52d;"><?php echo $row['subtotal'] ?></td>
                    </tr>
                <?php $total = $total + $row['subtotal'];
                }

                ?>
            </tbody>
        </table>
        <label style="color: #38b52d" for="total"><b>TOTAL ENTREGA $</b></label>
        <input type="text" value="<?php echo $total ?>" readonly>
    </div>
</div>
</div>
</div>
<?php include("includes/footer.php") ?>