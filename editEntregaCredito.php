<?php
session_start();
include("db.php");
include("includes/header.php");
$idDetalle = preg_replace('/(^[\"\']|[\"\']$)/', '', $_GET['idDetalle']);
$idVendedor = preg_replace('/(^[\"\']|[\"\']$)/', '', $_GET['idVendedor']);
$idCliente = preg_replace('/(^[\"\']|[\"\']$)/', '', $_GET['idCliente']);
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
            <h3>EDICION DE CREDITO</h1>
        </div>
        <div class="col">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" onclick="location.href='saveTaskEditCredito.php?id=1&idDetalle=<?php echo $idDetalle ?>&idVendedor=<?php echo $idVendedor ?>&idCliente=<?php echo $idCliente ?>'" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                <button type="button" onclick="location.href='creditos.php'" class="btn btn-success"><i class="fas fa-check-circle"></i></button>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="table-responsive">
        <!-- tabla -->

        <?php
        //string con comillas simples


        ?>
        <table class="table table-striped table-bordered" style="width:100%" id="example">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>producto</th>
                    <th>cantidad</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th style="color: #f00;">Sub Total</th>
                    <th>Acciones</th>


                </tr>
            </thead>
            <tbody id=" developers">
                <?php

                if ($idDetalle != "") {
                    $query = "SELECT * from detalleentregacredito WHERE idDetalle = '$idDetalle' ORDER BY fecha DESC";
                    $result_facturacion = mysqli_query($conn, $query);
                    $contador = 0;

                    while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                        <tr>
                            <td><?php echo $row['cliente']; ?></td>
                            <td><?php echo $row['vendedor']; ?></td>
                            <td><?php echo $row['producto']; ?></td>
                            <td><?php echo $row['cantidad']; ?></td>
                            <td><?php echo $row['precioCompra']; ?></td>
                            <td><?php echo $row['precioVenta'] ?></td>
                            <td style="color:#f00;"><?php echo $row['subtotal'] ?></td>

                            <td>
                                <!-- boton De acciones-->

                                <a onclick="confirmacionEditTaskCredito(<?php echo $row['id'] ?>,'<?php echo $row['idDetalle'] ?>',<?php echo $idVendedor ?>,<?php echo $idCliente ?>)" class="btn btn-danger botonesOpciones elimina">Eliminar</a>
                                <!-- <a class="btn btn-success botonesOpciones" onclick="confirmacionPago(<?php echo $row['id'] ?>)">Pago</a> -->
                                <!--  -->
                            </td>
                        </tr>
                <?php }
                } ?>



            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<?php include("includes/footer.php") ?>