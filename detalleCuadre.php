<?php include("db.php");
session_start();
?>
<!-- verificacion de inicio de sesion -->

<!--  -->

<?php include("includes/header.php") ?>
<!-- TITULOS DEPENDIENDO DEL DETALLE -->
<?php if ($_GET['id'] == "efectivo") echo "<h1 class='text-center'>DETALLE EFECTIVO</h1>" ?>
<?php if ($_GET['id'] == "entregas") echo "<h1 class='text-center'>DETALLE ENTREGAS</h1>" ?>
<?php if ($_GET['id'] == "entradas") echo "<h1 class='text-center'>DETALLE ENTRADAS</h1>" ?>
<?php if ($_GET['id'] == "creditos") echo "<h1 class='text-center'>DETALLE CREDITOS</h1>" ?>
<?php if ($_GET['id'] == "gastos") echo "<h1 class='text-center'>DETALLE GASTOS</h1>" ?>


<div class="container p-4">
    <div class="row">
        <div class="table-responsive">
            <!-- tabla -->
            <table class="table table-striped table-bordered" style="width:100%" id="example">
                <thead>
                    <?php
                    // DETALLE DEL EFECTIVO
                    if ($_GET['id'] == "efectivo") {
                        echo "<tr>
                                <th>Vendedor</th>
                                <th style='color; #38b52d'>Cantidad</th>
                                <th>Fecha</th>
                            </tr> ";
                    }
                    // DETALLE DE LAS ENTREGAS
                    if ($_GET['id'] == "entregas") {
                        echo "<tr>
                                <th>Vendedor</th>
                                <th>Descripcion</th>
                                <th>fecha</th>
                                <th style='color: #38b52d'>Total</th>
                            </tr> ";
                    }
                    // DETALLE DE LAS ENTRADAS
                    if ($_GET['id'] == "entradas") {
                        echo "<tr>
                                <th>Vendedor</th>
                                <th>Descripcion</th>
                                <th>Fecha</th>
                            </tr> ";
                    }
                    // DETALLE DE LOS CREDITOS
                    if ($_GET['id'] == "creditos") {
                        echo "<tr>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>Descripcion</th>
                                <th>fecha</th>
                                <th style='color: #f00'>Deuda Total</th>
                            </tr> ";
                    }
                    // DETALLE DE LOS GASTOS
                    if ($_GET['id'] == "gastos") {
                        echo "<tr>
                                <th>Titulo</th>
                                <th style='color: #f00'>Monto</th>
                                <th>Fecha</th>
                            </tr> ";
                    }
                    ?>
                </thead>
                <tbody id="developers">
                    <?php
                    // DETALLE DEL EFECTIVO

                    if ($_GET['id'] == "efectivo") {
                        $query = "SELECT * from efectivo WHERE estado = 1 ORDER BY fecha DESC  ";
                        $result_facturacion = mysqli_query($conn, $query);
                        $contador = 0;
                        while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                            <tr>
                                <td><?php echo $row['vendedor']; ?></td>
                                <td style="color: #38b52d">$<?php echo $row['cantidad']; ?></td>
                                <td><?php echo $row['fecha']; ?></td>
                            </tr>
                    <?php }
                    } ?>

                    <?php
                    // DETALLE DE LAS ENTREGAS
                    if ($_GET['id'] == "entregas") {
                        $query = "SELECT * from entregasmuestra WHERE estado = 1 ORDER BY fecha DESC";
                        $result_facturacion = mysqli_query($conn, $query);
                        $contador = 0;

                        while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                            <tr>
                                <td><?php echo $row['vendedor']; ?></td>
                                <td><a href="detalle.php?idDetalle=<?php echo $row['idDetalle']; ?>" class="text-decoration-none text-dark"><?php echo $row['descripcion']; ?></a></td>
                                <td><?php echo $row['fecha']; ?></td>
                                <td style="color:#38b52d"><?php echo $row['total']; ?></td>
                                </td>
                            </tr>
                    <?php }
                    } ?>

                    <?php
                    // DETALLE DE LAS ENTRADAS
                    if ($_GET['id'] == "entradas") {
                        $query = "SELECT * FROM historialentradas WHERE estado = 1 ORDER BY fecha DESC";
                        $result_facturacion = mysqli_query($conn, $query);
                        $contador = 0;

                        while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                            <tr>
                                <td><a href="detalleEntrada.php?idDetalle=<?php echo $row['idDetalle']; ?>" class="text-decoration-none text-dark"><?php echo $row['descripcion']; ?></a></td>
                                <td style="color:#38b52d;"><?php echo $row['total'] ?></td>
                                <td><?php echo $row['fecha']; ?></td>
                            </tr>
                    <?php }
                    } ?>

                    <?php
                    // DETALLE DE LOS CREDITOS
                    if ($_GET['id'] == "creditos") {
                        $query = "SELECT * from entregamuestracredito WHERE estado = 1 ORDER BY fecha DESC";
                        $result_facturacion = mysqli_query($conn, $query);
                        $contador = 0;

                        while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                            <tr>
                                <td><?php echo $row['cliente']; ?></td>
                                <td><?php echo $row['vendedor']; ?></td>
                                <td><a href="detalleCredito.php?idDetalle=<?php echo $row['idDetalle']; ?>" class="text-decoration-none text-dark"><?php echo $row['descripcion']; ?></a></td>
                                <td><?php echo $row['fecha']; ?></td>
                                <td style="color:#f00"><?php echo $row['total']; ?></td>
                            </tr>
                    <?php }
                    } ?>

                    <?php
                    // DETALLE DE LOS GASTOS
                    if ($_GET['id'] == "gastos") {
                        $query = "SELECT * from gastos WHERE estado = 1 ORDER BY fecha DESC";
                        $result_facturacion = mysqli_query($conn, $query);
                        $contador = 0;

                        while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                            <tr>
                                <td><a href="detalleGasto.php?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark"><?php echo $row['titulo']; ?></a></td>
                                <td style="color: #f00"><?php echo $row['monto']; ?></td>
                                <td><?php echo $row['fecha']; ?></td>
                            </tr>
                    <?php }
                    } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php include("includes/footer.php") ?>