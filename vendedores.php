<?php
session_start();
include("db.php");
?>
<!-- verificacion de inicio de sesion -->

<!--  -->

<?php include("includes/header.php") ?>
<!-- MENSAJES QUE LANZA AL USUARIO REALIZAR DISTINTIAS ACCIONES -->
<?php
// mensaje que lanza al Crear un Vendedor
if (isset($_SESSION['saveVendededor'])) { ?>
    <script>
        Swal.fire({
            title: "Vendedor Registrado!",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['saveVendededor']);
}
?>

<?php
// mensaje que lanza al Editar un Vendedor
if (isset($_SESSION['editVendedor'])) { ?>
    <script>
        Swal.fire({
            title: "Vendedor Editado!",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['editVendedor']);
}
?>

<?php
// mensaje que lanza al Borar un Vendedor
if (isset($_SESSION['deleteVendedor'])) { ?>
    <script>
        Swal.fire({
            title: "Vendedor Eliminado!",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['deleteVendedor']);
}
?>
<!-- ============================================ -->
<h1 class="text-center">VENDEDORES</h1>
<div class="container p-4">
    <div class="row">
        <!-- boton de nueva factura -->

        <button type="button" class="btn btn-primary btn-lg edicionButton" data-bs-toggle="modal" data-bs-target="#registroVendedor"><i class="fas fa-plus"></i>
            Nuevo Vendedor
        </button>
        <!--  -->
        <div class="table-responsive">
            <!-- tabla -->

            <table class="table table-striped table-bordered" style="width:100%" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Fecha</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody id="developers">
                    <?php
                    $query = "SELECT * from vendedores ORDER BY fecha DESC";
                    $result_facturacion = mysqli_query($conn, $query);
                    $contador = 0;
                    while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><a href="detalleVendedor.php?id=<?php echo $row['id'] ?>" class="text-decoration-none text-dark"><?php echo $row['nombre']; ?></a></td>
                            <td><?php echo $row['telefono']; ?></td>
                            <td><?php echo $row['direccion']; ?></td>
                            <td><?php echo $row['fecha']; ?></td>
                            <td>

                                <?php
                                $string1 = strval($contador);
                                $azul = "collapseExample$contador";
                                $contador = $contador + 1; ?>

                                <a class="nav-link">
                                    <li class="list-group-item itemMenuLateral dropdown-toggle bg-primary text-white" data-bs-toggle="collapse" data-bs-target="#<?php echo $azul ?>" aria-expanded="false" aria-controls="<?php echo $azul ?>">
                                        Opciones
                                    </li>
                                </a>
                                <div class="collapse" id="<?php echo $azul ?>">
                                    <div class="card card-body">
                                        <a href="whatsapp/wasaVendedores.php?idVendedor=<?php echo $row['id'] ?>" class="btn btn-success botonesOpciones"><i class="fab fa-whatsapp"></i></a>
                                        <a href="editVendedor.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary botonesOpciones">Editar</a>
                                        <a class="btn btn-danger botonesOpciones" onclick="confirmacionVendedor(<?php echo $row['id'] ?>)">Eliminar</a>
                                    </div>
                                </div>
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