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
    <h2>PRODUCTOS EN ALMACEN</h1>
        <div class="row">
            <!-- boton de nueva factura -->
            <button type="button" onclick="location.href='nuevoProducto.php?id=0'" class="btn btn-primary btn-lg edicionButton"><i class="fas fa-plus"></i> Nuevo Producto</button>

            <!--  -->
            <div class="table-responsive">
                <!-- tabla -->

                <table class="table table-striped table-bordered" style="width:100%" id="example">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th>Existencia</th>
                            <th>Fecha</th>
                            <th>Acciones</th>



                        </tr>
                    </thead>
                    <tbody id=" developers">
                        <?php

                        $query = "SELECT * from productos ORDER BY fecha DESC";
                        $result_facturacion = mysqli_query($conn, $query);
                        $contador = 0;

                        while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                            <tr>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['precioCompra']; ?></td>
                                <td><?php echo $row['precioVenta']; ?></td>
                                <td><?php echo $row['existencia']; ?></td>
                                <td><?php echo $row['fecha']; ?></td>


                                <td>
                                    <!-- boton collapse-->

                                    <?php
                                    $string1 = strval($contador);
                                    $azul = "collapseExample$contador";
                                    $contador = $contador + 1; ?>

                                    <p>
                                        <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary botonesOpciones">Editar <i class="fas fa-edit"></i></a>
                                        <button class="btn btn-primary itemMenuLateral dropdown-toggle bg-primary text-white mt-1" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $azul ?>" aria-expanded="false" aria-controls="<?php echo $azul ?>">
                                            Opciones
                                        </button>

                                    </p>

                                    <div class="collapse" id="<?php echo $azul ?>">
                                        <div class="card card-body">
                                            <!-- <a href="abono-facturas.php?id=<?php echo $row['id'] ?>" class="btn btn-info botonesOpciones text-white">Abonar</a> -->
                                            <!-- <a class="btn btn-warning botonesOpciones text-white" onclick="confirmacionReenvioGas(<?php echo $row['id'] ?>)">Factura</a> -->
                                            <a onclick="confirmacion(<?php echo $row['id'] ?>)" class="btn btn-danger botonesOpciones elimina">Eliminar</a>
                                            <a class="btn btn-success botonesOpciones" onclick="confirmacionPago(<?php echo $row['id'] ?>)">Pago</a>
                                        </div>
                                    </div>
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