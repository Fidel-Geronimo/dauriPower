<?php
session_start();
include("db.php");

if (isset($_GET["idDetalle"])) { //si existe el idDetalle
    // datos de la factura
    $idDetalle = $_GET["idDetalle"];
}
?>

<!--  -->
<?php
include("includes/header.php");
?>
<!-- verificacion de inicio de sesion -->
<?php

if (!isset($_SESSION["rol"])) {
    header("Location: login.php");
} else {
    if ($_SESSION["rol"] == 2) {
        header("Location: km15/facturacionkm15.php");
    }
} ?>
<!-- ============================================ -->
<?php
?>


<div class="container mb-3 mt-2">
    <div class="row align-items-center">
        <div class="col">
            <h3>Detalle de la entrega</h1>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="table-responsive">
        <!-- tabla -->

        <table class="table table-striped table-bordered" style="width:100%" id="example">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>producto</th>
                    <th>cantidad</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th style="color: #f00">Sub Total</th>

                </tr>
            </thead>
            <tbody id=" developers">
                <?php

                $query = "SELECT * from detalleentregacredito where idDetalle ='$idDetalle' ";
                $result_facturacion = mysqli_query($conn, $query);
                $contador = 0;

                while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                    <tr>
                        <td><?php echo $row['cliente']; ?></td>
                        <td><?php echo $row['vendedor']; ?></td>
                        <td><?php echo $row['producto']; ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td><?php echo $row['precioCompra']; ?></td>
                        <td><?php echo $row['precioVenta'] ?></td>
                        <td style="color:#f00"><?php echo $row['subtotal'] ?></td>



                        <!-- <td> -->
                        <!-- boton collapse-->

                        <?php
                        // $string1 = strval($contador);
                        // $azul = "collapseExample$contador";
                        // $contador = $contador + 1; 
                        ?>

                        <!-- <p>
                                <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-secondary botonesOpciones">Editar <i class="fas fa-edit"></i></a>
                                <button class="btn btn-primary itemMenuLateral dropdown-toggle bg-primary text-white mt-1" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $azul ?>" aria-expanded="false" aria-controls="<?php echo $azul ?>">
                                    Opciones
                                </button>

                            </p>

                            <div class="collapse" id="<?php echo $azul ?>">
                                <div class="card card-body"> -->
                        <!-- <a href="abono-facturas.php?id=<?php echo $row['id'] ?>" class="btn btn-info botonesOpciones text-white">Abonar</a> -->
                        <!-- <a class="btn btn-warning botonesOpciones text-white" onclick="confirmacionReenvioGas(<?php echo $row['id'] ?>)">Factura</a> -->
                        <!-- <a onclick="confirmacion(<?php echo $row['id'] ?>)" class="btn btn-danger botonesOpciones elimina">Eliminar</a> -->
                        <!-- <a class="btn btn-success botonesOpciones" onclick="confirmacionPago(<?php echo $row['id'] ?>)">Pago</a> -->
                        <!-- </div>
                            </div> -->
                        <!--  -->
                        <!-- </td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<?php include("includes/footer.php") ?>