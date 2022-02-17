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
<h1 class="text-center">EFECTIVO VENDEDORES</h1>
<div class="container p-4">
    <div class="row">
        <!-- boton de nueva factura -->

        <button type="button" class="btn btn-primary btn-lg edicionButton" data-bs-toggle="modal" data-bs-target="#registroEntradaEfectivo"><i class="fas fa-plus"></i>
            REGISTRAR ENTRADA
        </button>
        <!--  -->
        <div class="table-responsive">
            <!-- tabla -->

            <table class="table table-striped table-bordered" style="width:100%" id="example">
                <thead>
                    <tr>
                        <th>Vendedor</th>
                        <th style="color: #38b52d">Cantidad</th>
                        <th>Fecha</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody id="developers">
                    <?php
                    $query = "SELECT * from efectivo ORDER BY fecha DESC";
                    $result_facturacion = mysqli_query($conn, $query);
                    $contador = 0;
                    while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                        <tr>
                            <td><?php echo $row['vendedor']; ?></td>
                            <td style="color: #38b52d">$<?php echo $row['cantidad']; ?></td>
                            <td><?php echo $row['fecha']; ?></td>
                            <td>
                                <a onclick="confirmarEliminarEfectivo(<?php echo $row['id'] ?>)" class="btn btn-danger botonesOpciones elimina">Eliminar</a>
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