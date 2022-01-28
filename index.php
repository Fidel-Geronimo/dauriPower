<?php
session_start();
include("db.php");
?>
<!-- verificacion de inicio de sesion -->
<?php

if (!isset($_SESSION["rol"])) {
    header("Location: login.php");
} else {
    if ($_SESSION["rol"] == 2) {
        header("Location: km15/facturacionkm15.php");
    }
}
include("includes/header.php");
?>
<!-- ============================================ -->



<div class="container p-4">
    <h2 class="text-center">ENTREGAS REALIZADAS</h1>
        <div class="row">
            <!-- boton de nueva factura -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-lg edicionButton" data-bs-toggle="modal" data-bs-target="#modalVendedor"><i class="fas fa-plus"></i> Nueva Entrega</button>

            <!--  -->
            <div class="table-responsive">
                <!-- tabla -->

                <table class="table table-striped table-bordered" style="width:100%" id="example">
                    <thead>
                        <tr>
                            <th>Vendedor</th>
                            <th>Descripcion</th>
                            <th>fecha</th>
                            <th style="color: #38b52d">Total</th>
                            <th>Acciones</th>



                        </tr>
                    </thead>
                    <tbody id=" developers">
                        <?php

                        $query = "SELECT * from entregasmuestra ORDER BY fecha DESC";
                        $result_facturacion = mysqli_query($conn, $query);
                        $contador = 0;

                        while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                            <tr>
                                <td><?php echo $row['vendedor']; ?></td>
                                <td><a href="detalle.php?idDetalle=<?php echo $row['idDetalle']; ?>" class="text-decoration-none text-dark"><?php echo $row['descripcion']; ?></a></td>
                                <td><?php echo $row['fecha']; ?></td>
                                <td style="color:#38b52d"><?php echo $row['total']; ?></td>


                                <td>
                                    <!-- boton collapse-->

                                    <?php
                                    $string1 = strval($contador);
                                    $azul = "collapseExample$contador";
                                    $contador = $contador + 1; ?>

                                    <p>
                                        <a href="editEntrega.php?idVendedor=<?php echo $row['idVendedor'] ?>&idDetalle='<?php echo $row['idDetalle'] ?>'" class="btn btn-secondary botonesOpciones">Editar <i class="fas fa-edit"></i></a>
                                        <a onclick="confirmacion('<?php echo $row['idDetalle'] ?>')" class="btn btn-danger botonesOpciones elimina">Eliminar</a>
                                        <!-- <button class="btn btn-primary itemMenuLateral dropdown-toggle bg-primary text-white mt-1" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $azul ?>" aria-expanded="false" aria-controls="<?php echo $azul ?>">
                                            Opciones
                                        </button> -->

                                    </p>
                                    <!-- <a href="abono-facturas.php?id=<?php echo $row['id'] ?>" class="btn btn-info botonesOpciones text-white">Abonar</a> -->
                                    <!-- <a class="btn btn-warning botonesOpciones text-white" onclick="confirmacionReenvioGas(<?php echo $row['id'] ?>)">Factura</a> -->
                                    <!-- <a class="btn btn-success botonesOpciones" onclick="confirmacionPago(<?php echo $row['id'] ?>)">Pago</a> -->


                                    <!--  -->




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