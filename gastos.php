<?php
session_start();
include("db.php");
?>
<!-- verificacion de inicio de sesion -->
<?php

if (!isset($_SESSION["rol"])) {
    header("Location: login.php");
}

include("includes/header.php");


?>

<!-- MENSAJES QUE LANZA AL USUARIO REALIZAR DISTINTIAS ACCIONES -->
<?php
// mensaje que lanza al Crear un Gasto
if (isset($_SESSION['saveGasto'])) { ?>
    <script>
        Swal.fire({
            title: "Gasto Registrado!",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['saveGasto']);
}
?>

<?php
// mensaje que lanza al Borrar un Gasto
if (isset($_SESSION['deleteGasto'])) { ?>
    <script>
        Swal.fire({
            title: "Gasto Eliminado!",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['deleteGasto']);
}
?>

<?php
// mensaje que lanza al Editar un Gasto
if (isset($_SESSION['editGasto'])) { ?>
    <script>
        Swal.fire({
            title: "Gasto Editado!",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['editGasto']);
}
?>
<!-- ============================================ -->



<div class="container p-4">
    <h2 class="text-center">GASTOS</h1>
        <div class="row">
            <!-- boton de nueva factura -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger btn-lg edicionButton" data-bs-toggle="modal" data-bs-target="#registroGasto"><i class="fas fa-plus"></i> REGISTRAR GASTO</button>

            <!--  -->
            <div class="table-responsive">
                <!-- tabla -->

                <table class="table table-striped table-bordered" style="width:100%" id="example">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th style="color: #f00">Monto</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id=" developers">
                        <?php

                        $query = "SELECT * from gastos ORDER BY fecha DESC";
                        $result_facturacion = mysqli_query($conn, $query);
                        $contador = 0;

                        while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                            <tr>
                                <td><a href="detalleGasto.php?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark"><?php echo $row['titulo']; ?></a></td>
                                <td style="color: #f00"><?php echo $row['monto']; ?></td>
                                <td><?php echo $row['fecha']; ?></td>
                                <td>
                                    <a href="editGasto.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary botonesOpciones">Editar <i class="fas fa-edit"></i></a>
                                    <a onclick="confirmarEliminarGasto(<?php echo $row['id'] ?>)" class="btn btn-danger botonesOpciones elimina">Eliminar</a>
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