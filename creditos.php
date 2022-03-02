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
// mensaje al Registrar un nuevo credito
if (isset($_SESSION['EntregaAgregadaCredito'])) {
    if ($_SESSION['EntregaAgregadaCredito'] == 1) {
        $nombre = $_SESSION['nombreCliente'];
        $telefono = $_SESSION['telefonoCliente'];
        $text = "*MENSAJE AUTOMATICO POWER LOUNGE*%0A%0A*FACTURA A CREDITO:*%0APara: *$nombre*%0A%0A*PRODUCTOS*:%0A%0A";
        $contador = 0;
        foreach ($_SESSION['productos'] as $producto) {
            $text = "$text - " . $_SESSION['cantidades'][$contador] . " $producto = RD" . "$" . $_SESSION['total'][$contador] . "%0A%0A";
            $contador++;
        }
        $text = "$text REALICE SU PAGO LO ANTES POSIBLE%0AGGRACIAS POR SU COMPRA "

?>
        <script>
            Swal
                .fire({
                    title: "Credito Registrado!",
                    text: "Desea Enviar Aviso Al cliente?",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    confirmButtonText: "Sí, Enviar",
                    cancelButtonText: "No",
                })
                .then(resultado => {
                    if (resultado.value) {
                        // Hicieron click en "Sí"
                        window.location = "https://wa.me/1<?php echo $telefono ?>?text=<?php echo $text ?>";
                    }
                });
        </script>
<?php
        unset($_SESSION['nombreCliente']);
        unset($_SESSION['telefonoCliente']);
        unset($_SESSION['productos']);
        unset($_SESSION['total']);
        unset($_SESSION['cantidades']);
        unset($_SESSION['EntregaAgregadaCredito']);
    }
}
?>
<?php
// mensaje que lanza al Eliminar un Registro de Creditos
if (isset($_SESSION['borradoCredito'])) { ?>
    <script>
        Swal.fire({
            title: "Credito Eliminado",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['borradoCredito']);
} ?>

<?php
// mensaje que lanza al Abonar
if (isset($_SESSION['messageAbono'])) { ?>
    <script>
        Swal.fire({
            title: "Abono Realizado!",
            confirmButtonColor: '#007bff',
            confirmButtonText: "Ok",
            icon: 'success'
        });
    </script>
<?php unset($_SESSION['messageAbono']);
} ?>


<!-- ============================================ -->
<!-- limpiado de base de nueva entrada -->

<?php
if (isset($_SESSION['ContenidoCredito'])) {
    $queryDelete = "DELETE FROM nuevaentregacredito";
    $result_facturacion = mysqli_query($conn, $queryDelete);
}

?>
<!-- ============================================ -->


<div class="container p-4">
    <h2 class="text-center">CREDITOS</h1>
        <div class="row">
            <!-- boton de nueva factura -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-lg edicionButton" data-bs-toggle="modal" data-bs-target="#modalVendedorYcliente"><i class="fas fa-plus"></i> Nueva Entrega</button>

            <!--  -->
            <div class="table-responsive">
                <!-- tabla -->

                <table class="table table-striped table-bordered" style="width:100%" id="example">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Descripcion</th>
                            <th>Fecha</th>
                            <th style="color: #38b52d">Abono</th>
                            <th style="color: #f00">Deuda Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="developers">
                        <?php

                        $query = "SELECT * from entregamuestracredito ORDER BY fecha DESC";
                        $result_facturacion = mysqli_query($conn, $query);
                        $contador = 0;

                        while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                            <tr>
                                <td><?php echo $row['cliente']; ?></td>
                                <td><?php echo $row['vendedor']; ?></td>
                                <td><a href="detalleCredito.php?idDetalle=<?php echo $row['idDetalle']; ?>" class="text-decoration-none text-dark"><?php echo $row['descripcion']; ?></a></td>
                                <td><?php echo $row['fecha']; ?></td>
                                <td style="color: #38b52d"><?php echo $row['abono']; ?></td>
                                <td style="color:#f00"><?php echo $row['total']; ?></td>
                                <td>
                                    <a href="abonoCreditos.php?id=<?php echo $row['id'] ?>" class="btn btn-success botonesOpciones text-white">Abonar</a>
                                    <a onclick="confirmacionEliminarCredito('<?php echo $row['idDetalle'] ?>')" class="btn btn-danger botonesOpciones elimina">Eliminar</a>

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