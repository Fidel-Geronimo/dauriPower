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
<!-- ============================================ -->



<div class="container p-4">
    <div class="d-flex bd-highlight">
        <div class="me-auto p-2 bd-highlight">
            <h1>DETALLE CUADRE</h1>
        </div>
    </div>
    <!-- boton de Historial de Cuadres -->

    <!--  -->
    <div class="table-responsive">
        <!-- tabla -->

        <table class="table table-hover" style="width:100%">
            <thead class="table-danger">
                <tr>
                    <th>Razon</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET["idDetalle"])) {
                    $idDetalle = $_GET["idDetalle"];

                    $queryEntregas = "SELECT * FROM detallecierres WHERE idDetalle='$idDetalle'";
                    $resultadoDetalleCuadre = mysqli_query($conn, $queryEntregas);

                    while ($rowDetalle = mysqli_fetch_array($resultadoDetalleCuadre)) { ?>
                        <tr>
                            <td><?php echo $rowDetalle["razon"] ?></td>
                            <td><?php echo $rowDetalle["total"] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            <tfoot class="table-danger">
                <tr>
                    <th>Razon</th>
                    <th>Total</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php include("includes/footer.php") ?>