<?php include("db.php") ?>
<!-- verificacion de inicio de sesion -->

<!--  -->

<?php include("includes/header.php") ?>
<!-- MENSAJES QUE LANZA AL USUARIO REALIZAR DISTINTIAS ACCIONES -->
<?php
// mensaje que lanza al editar un cliente
if (isset($_SESSION['messageEdit'])) { ?>
    <script>
        Swal.fire({
            title: "Cliente Editado Correctamente",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['messageEdit']);
}
// Mensaje que lanza al borrar un cliente
if (isset($_SESSION['messageDelete'])) { ?>
    <script>
        Swal.fire({
            title: "Cliente Elimnado Correctamente",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['messageDelete']);
}
// mensaje que lanza al registrar un cliente
if (isset($_SESSION['messageCliente'])) { ?>
    <script>
        Swal.fire({
            title: "Cliente Registrado Correctamente",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['messageCliente']);
}

?>
<!-- ========================================================= -->
<h1 class="text-center">HISTORIAL</h1>
<div class="container">
    <div class="row">

        <!--  -->
        <div class="table-responsive">
            <!-- tabla -->

            <table class="table table-hover table-light" style="width:100%" id="example">
                <thead>
                    <tr>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody id="developers">
                    <?php
                    $queryHistorial = "SELECT * from historial ORDER BY fecha DESC";
                    $resultHistorial = mysqli_query($conn, $queryHistorial);
                    $contador = 0;
                    while ($row = mysqli_fetch_array($resultHistorial)) { ?>
                        <tr>
                            <td><?php echo $row['descripcion']; ?></td>
                            <td><?php echo $row['fecha']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php include("includes/footer.php") ?>