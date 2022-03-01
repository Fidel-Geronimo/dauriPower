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

<?php
// mensaje que lanza al Crear un producto nuevo en almacen
if (isset($_SESSION['nuevoProducto'])) { ?>
    <script>
        Swal.fire({
            title: "Producto Creado Correctamente",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['nuevoProducto']);
} ?>
<?php
// mensaje que lanza al Editar un producto en almacen
if (isset($_SESSION['edicionProducto'])) { ?>
    <script>
        Swal.fire({
            title: "Producto Editado Correctamente",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['edicionProducto']);
} ?>

<?php
// mensaje que lanza al Agregar una Entrada de productos
if (isset($_SESSION['agregadoEntrada'])) { ?>
    <script>
        Swal.fire({
            title: "Entrada Realizada!",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['agregadoEntrada']);
} ?>

<?php
// mensaje que lanza al Agregar una Entrada de productos
if (isset($_SESSION['deleteProducto'])) { ?>
    <script>
        Swal.fire({
            title: "Producto Eliminado!",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['deleteProducto']);
} ?>

<?php
// mensaje que lanza al Eliminar una Entrada de historial entradas
if (isset($_SESSION['eliminarEntradas'])) { ?>
    <script>
        Swal.fire({
            title: "Entrada Eliminada!",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['eliminarEntradas']);
} ?>


<!-- ============================================ -->

<div class="container p-4">
    <h2 class="">PRODUCTOS EN ALMACEN</h1>
        <div class="d-flex justify-content-start">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#registroProductos"><i class="fas fa-plus"></i>
                Nuevo
            </button>
            <button type="button" onclick="location.href='nuevaEntrada.php?id=0'" class="btn btn-primary ms-3 mb-3"><i class="fas fa-plus"></i>
                Existencia
            </button>
            <button type="button" onclick="location.href='historialEntradas.php'" class="btn btn-primary ms-3 mb-3"><i class="bi bi-clock-history"></i>
            </button>
            <button type="button" onclick="location.href='minimoExistencia.php'" class="btn btn-danger ms-3 mb-3"><i class="bi bi-graph-down-arrow"></i>
            </button>
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
                                <a href="editProducto.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary botonesOpciones">Editar <i class="fas fa-edit"></i></a>
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