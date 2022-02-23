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


// funcion de cierre
if (isset($_GET['close'])) {

    // cierre entregas a vendedores
    $queryEntregas = "UPDATE entregasmuestra set estado = 0 WHERE estado = 1";
    mysqli_query($conn, $queryEntregas);

    // cierre efectivo 
    $queryEfectivo = "UPDATE efectivo set estado = 0 WHERE estado = 1";
    mysqli_query($conn, $queryEfectivo);

    // cierre entradas de productos
    $queryEntradas = "UPDATE historialentradas set estado = 0 WHERE estado = 1";
    mysqli_query($conn, $queryEntradas);

    // cierre creditos 
    $queryCreditos = "UPDATE entregamuestracredito set estado = 0 WHERE estado = 1";
    mysqli_query($conn, $queryCreditos);

    // cierre gastos
    $queryGastos = "UPDATE gastos set estado = 0 WHERE estado = 1";
    mysqli_query($conn, $queryGastos);

    //Para El historial 
    $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Realizo Un Cuadre')";
    mysqli_query($conn, $queryHistorial);

    $_SESSION["Cuadrado"] = 1;

    header("location: index.php"); //directo al index
}
include("includes/header.php");
?>
<!-- ============================================ -->



<div class="container p-4">
    <h2>CUADRE</h1>
        <div class="container">
            <div class="row">
                <div class="col">

                </div>
            </div>
        </div>
        <!-- boton de Historial de Cuadres -->

        <!--  -->
        <div class="table-responsive">
            <!-- tabla -->

            <table class="table table-hover" style="width:100%">
                <thead class="table-primary">
                    <tr>
                        <th>Razon</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // seleccion de las entregas de la semana
                    $queryEntregas = "SELECT * from entregasmuestra WHERE estado=1";
                    $resultadoEntregas = mysqli_query($conn, $queryEntregas);
                    $totalEntregas = 0;
                    while ($rowEntregas = mysqli_fetch_array($resultadoEntregas)) {
                        $totalEntregas = $rowEntregas["total"] + $totalEntregas;
                    }
                    // seleccion del efectivo de la semana
                    $queryEfectivo = "SELECT * from efectivo WHERE estado=1";
                    $resultadoEfectivo = mysqli_query($conn, $queryEfectivo);
                    $totalEfectivo = 0;
                    while ($rowEfectivo = mysqli_fetch_array($resultadoEfectivo)) {
                        $totalEfectivo = $rowEfectivo["cantidad"] + $totalEfectivo;
                    }
                    // seleccion de las entradas de productos de la semana
                    $queryEntradas = "SELECT * from historialentradas WHERE estado=1";
                    $resultadoEntradas = mysqli_query($conn, $queryEntradas);
                    $totalEntradas = 0;
                    while ($rowEntradas = mysqli_fetch_array($resultadoEntradas)) {
                        $totalEntradas = $rowEntradas["total"] + $totalEntradas;
                    }
                    // seleccion de los creditos de la semana
                    $queryCreditos = "SELECT * from entregamuestracredito WHERE estado=1";
                    $resultadoCreditos = mysqli_query($conn, $queryCreditos);
                    $totalCreditos = 0;
                    while ($rowCreditos = mysqli_fetch_array($resultadoCreditos)) {
                        $totalCreditos = $rowCreditos["total"] + $totalCreditos;
                    }
                    // seleccion de las entregas de la semana
                    $queryGastos = "SELECT * from gastos WHERE estado=1";
                    $resultadoGastos = mysqli_query($conn, $queryGastos);
                    $totalGastos = 0;
                    while ($rowGastos = mysqli_fetch_array($resultadoGastos)) {
                        $totalGastos = $rowGastos["monto"] + $totalGastos;
                    }



                    // ===========================================
                    $contador = 0;
                    ?>
                    <tr>
                        <td style="color: #32cd32;"><b>Efectivo Entregado (Vendedores)</b></td>
                        <td style="color: #32cd32;"><b>$<?php echo $totalEfectivo ?></b></td>
                    </tr>
                    <tr>
                        <td>Entregas A Vendedores (Productos)</td>
                        <td>$<?php echo $totalEntregas ?></td>
                    </tr>

                    <tr>
                        <td>Entradas Realizadas (Productos)</td>
                        <td>$<?php echo $totalEntradas ?></td>

                    </tr>
                    <tr>
                        <td>Creditos Despachados</td>
                        <td>$<?php echo $totalCreditos ?></td>

                    </tr>
                    <tr>
                        <td>Gastos Realizados</td>
                        <td>$<?php echo $totalGastos ?></td>

                    </tr>
                    <?php  ?>

                </tbody>
                <tfoot class="table-primary">
                    <tr>
                        <th>Razon</th>
                        <th>Total</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="d-flex bd-highlight mb-3">
            <div class="me-auto p-2 bd-highlight">
                <button type="button" class="btn btn-warning btn-lg edicionButton" data-bs-toggle="modal" data-bs-target="#registroProductos"><i class="bi bi-printer-fill"></i>
                    Imprimir
                </button>
            </div>

            <div class="p-2 bd-highlight">
                <button type="button" onclick="confirmarCierre()" class="btn btn-success btn-lg edicionButton"><i class="bi bi-check-square-fill"></i>
                    Realizar Caudre
                </button>
            </div>
        </div>

</div>
</div>
<?php include("includes/footer.php") ?>