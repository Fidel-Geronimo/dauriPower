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
    <h2 class="">PRODUCTOS EN ALMACEN</h1>
        <div class="container">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary btn-lg edicionButton" data-bs-toggle="modal" data-bs-target="#registroProductos"><i class="fas fa-plus"></i>
                        Nuevo Producto
                    </button>
                    <button type="button" onclick="location.href='nuevaEntrada.php?id=0'" class="btn btn-primary btn-lg edicionButton"><i class="fas fa-plus"></i>
                        Agregar Existencia
                    </button>
                    <button type="button" onclick="location.href='historialEntradas.php'" class="btn btn-primary btn-lg edicionButton"><i class="bi bi-clock-history"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- boton de nueva factura -->
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
                                <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary botonesOpciones">Editar <i class="fas fa-edit"></i></a>
                                <a onclick="confirmacionProductoAlmacen(<?php echo $row['id'] ?>)" class="btn btn-danger botonesOpciones elimina">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>

</div>
</div>
<?php include("includes/footer.php") ?>