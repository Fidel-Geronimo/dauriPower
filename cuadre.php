<?php
session_start();
include("db.php");
?>
<!-- verificacion de inicio de sesion -->
<?php

if (!isset($_SESSION["rol"])) {
    header("Location: login.php");
}


// funcion de cierre
if (isset($_GET['close'])) {

    $idDetalle = uniqid(); //GENERA NUMERO ALEATORIO PARA EL DETALLE DEL CIERRE
    $entregas = $_GET["entregas"];
    $efectivo = $_GET["efectivo"];
    $entradas = $_GET["entradas"];
    $creditos = $_GET["creditos"];
    $gastos = $_GET["gastos"];

    // cierre entregas a vendedores
    $queryEntregas = "UPDATE entregasmuestra set estado = 0 WHERE estado = 1";
    mysqli_query($conn, $queryEntregas);

    $queryEntregas = "INSERT INTO detallecierres (razon,total,idDetalle) VALUES ('Entregas A Vendedores (Productos)',$entregas,'$idDetalle')";
    mysqli_query($conn, $queryEntregas);


    // cierre efectivo 
    $queryEfectivo = "UPDATE efectivo set estado = 0 WHERE estado = 1";
    mysqli_query($conn, $queryEfectivo);

    $queryEntregas = "INSERT INTO detallecierres (razon,total,idDetalle) VALUES ('Efectivo Entregado (Vendedores)',$efectivo,'$idDetalle')";
    mysqli_query($conn, $queryEntregas);

    // cierre entradas de productos
    $queryEntradas = "UPDATE historialentradas set estado = 0 WHERE estado = 1";
    mysqli_query($conn, $queryEntradas);

    $queryEntregas = "INSERT INTO detallecierres (razon,total,idDetalle) VALUES ('Entradas Realizadas (Productos)',$entradas,'$idDetalle')";
    mysqli_query($conn, $queryEntregas);

    // cierre creditos 
    $queryCreditos = "UPDATE entregamuestracredito set estado = 0 WHERE estado = 1";
    mysqli_query($conn, $queryCreditos);

    $queryEntregas = "INSERT INTO detallecierres (razon,total,idDetalle) VALUES ('Creditos Despachados',$creditos,'$idDetalle')";
    mysqli_query($conn, $queryEntregas);

    // cierre gastos
    $queryGastos = "UPDATE gastos set estado = 0 WHERE estado = 1";
    mysqli_query($conn, $queryGastos);

    $queryEntregas = "INSERT INTO detallecierres (razon,total,idDetalle) VALUES ('Gastos Realizados',$gastos,'$idDetalle')";
    mysqli_query($conn, $queryEntregas);

    //Para El historial 
    $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Realizo Un Cuadre')";
    mysqli_query($conn, $queryHistorial);

    // PARA EL DETALLE EN EL HISTORIAL DE CUADRES
    $queryHistorialCierre = "INSERT INTO hitorialcuadres (id) VALUES ($idDetalle)";
    mysqli_query($conn, $queryHistorialCierre);

    $_SESSION["Cuadrado"] = 1;


    // header("location: index.php"); //directo al index
}
include("includes/header.php");
?>
<!-- ============================================ -->



<div class="container p-4">
    <div class="d-flex bd-highlight">
        <div class="me-auto p-2 bd-highlight">
            <h1>Cuadre</h1>
        </div>
        <div class="p-2 bd-highlight">
            <button type="button" onclick="location.href='historialCuadres.php'" class="btn btn-primary ms-3 mb-3"><i class="bi bi-clock-history"></i>
            </button>
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
                $queryEntregas = "SELECT total FROM entregasmuestra WHERE estado=1";
                $resultadoEntregas = mysqli_query($conn, $queryEntregas);
                $totalEntregas = 0;
                while ($rowEntregas = mysqli_fetch_array($resultadoEntregas)) {
                    $totalEntregas = $rowEntregas["total"] + $totalEntregas;
                }
                // seleccion del efectivo de la semana
                $queryEfectivo = "SELECT cantidad FROM efectivo WHERE estado=1";
                $resultadoEfectivo = mysqli_query($conn, $queryEfectivo);
                $totalEfectivo = 0;
                while ($rowEfectivo = mysqli_fetch_array($resultadoEfectivo)) {
                    $totalEfectivo = $rowEfectivo["cantidad"] + $totalEfectivo;
                }
                // seleccion de las entradas de productos de la semana
                $queryEntradas = "SELECT total FROM historialentradas WHERE estado=1";
                $resultadoEntradas = mysqli_query($conn, $queryEntradas);
                $totalEntradas = 0;
                while ($rowEntradas = mysqli_fetch_array($resultadoEntradas)) {
                    $totalEntradas = $rowEntradas["total"] + $totalEntradas;
                }
                // seleccion de los creditos de la semana
                $queryCreditos = "SELECT total FROM entregamuestracredito WHERE estado=1";
                $resultadoCreditos = mysqli_query($conn, $queryCreditos);
                $totalCreditos = 0;
                while ($rowCreditos = mysqli_fetch_array($resultadoCreditos)) {
                    $totalCreditos = $rowCreditos["total"] + $totalCreditos;
                }
                // seleccion de las entregas de la semana
                $queryGastos = "SELECT monto FROM gastos WHERE estado=1";
                $resultadoGastos = mysqli_query($conn, $queryGastos);
                $totalGastos = 0;
                while ($rowGastos = mysqli_fetch_array($resultadoGastos)) {
                    $totalGastos = $rowGastos["monto"] + $totalGastos;
                }



                // ===========================================
                $contador = 0;
                ?>
                <tr>

                    <td><b><a style=" text-decoration: none;color: #32cd32;" href="detalleCuadre.php?id=efectivo">Efectivo Entregado (Vendedores)</a> </b></td>
                    <td style="color: #32cd32;"><b>$<?php echo $totalEfectivo ?></b></td>
                </tr>
                <tr>
                    <td><a style="text-decoration: none;color: #000;" href="detalleCuadre.php?id=entregas">Entregas A Vendedores (Productos)</a></td>
                    <td>$<?php echo $totalEntregas ?></td>
                </tr>

                <tr>
                    <td><a style="text-decoration: none; color: #000;" href="detalleCuadre.php?id=entradas">Entradas Realizadas (Productos)</a></td>
                    <td>$<?php echo $totalEntradas ?></td>

                </tr>
                <tr>
                    <td><a style="text-decoration: none;color: #000;" href="detalleCuadre.php?id=creditos">Creditos Despachados</a></td>
                    <td>$<?php echo $totalCreditos ?></td>

                </tr>
                <tr>
                    <td><a style="text-decoration: none;color: #000;" href="detalleCuadre.php?id=gastos">Gastos Realizados</a></td>
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
            <button type="button" onclick="confirmarCierre(<?php echo $totalEfectivo ?>,<?php echo $totalEntregas ?> , <?php echo $totalEntradas ?>,<?php echo $totalCreditos ?> , <?php echo $totalGastos ?>)" class="btn btn-success btn-lg edicionButton"><i class="bi bi-check-square-fill"></i>
                Realizar Caudre
            </button>
        </div>
    </div>

</div>
</div>
<?php include("includes/footer.php") ?>