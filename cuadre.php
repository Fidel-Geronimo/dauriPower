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
    <h2 class="">CUADRE</h1>
        <div class="container">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary btn-lg edicionButton" data-bs-toggle="modal" data-bs-target="#registroProductos"><i class="fas fa-plus"></i>
                        Imprimir
                    </button>
                    <!-- <button type="button" onclick="location.href='nuevaEntrada.php?id=0'" class="btn btn-primary btn-lg edicionButton"><i class="fas fa-plus"></i>
                        Agregar Existencia
                    </button>
                    <button type="button" onclick="location.href='historialEntradas.php'" class="btn btn-primary btn-lg edicionButton"><i class="bi bi-clock-history"></i>
                    </button> -->
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
                        <th>Razon</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id=" developers">
                    <?php
                    // seleccion de las entregas de la semana
                    $queryEntregas = "SELECT * from entregasmuestra WHERE estado=1";
                    $resultadoEntregas = mysqli_query($conn, $queryEntregas);
                    $rowEntregas = mysqli_fetch_array($resultadoEntregas);

                    $total = $rowEntregas["total"];
                    // ===========================================
                    $contador = 0;
                    ?>
                    <tr>
                        <td>Monto Total (Entregas)</td>
                        <td><?php echo $total ?></td>
                        <td>
                            <a href="editProducto.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary botonesOpciones">Editar <i class="fas fa-edit"></i></a>
                            <a onclick="confirmacionProductoAlmacen(<?php echo $row['id'] ?>)" class="btn btn-danger botonesOpciones elimina">Eliminar</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Total (Gastos)</td>
                        <td><?php echo $total ?></td>
                        <td>
                            <a href="editProducto.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary botonesOpciones">Editar <i class="fas fa-edit"></i></a>
                            <a onclick="confirmacionProductoAlmacen(<?php echo $row['id'] ?>)" class="btn btn-danger botonesOpciones elimina">Eliminar</a>
                        </td>
                    </tr>
                    <?php  ?>

                </tbody>
            </table>
        </div>

</div>
</div>
<?php include("includes/footer.php") ?>