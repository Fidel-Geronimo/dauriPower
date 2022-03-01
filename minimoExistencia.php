<?php
session_start();
include("db.php");
?>
<!-- verificacion de inicio de sesion -->


<!--  -->

<?php include("includes/header.php") ?>

<h1 class="text-center">MINIMO DE PRODUCTOS</h1>
<div class="container p-4">
    <div class="row">
        <div class="table-responsive">
            <!-- tabla -->
            <table class="table table-striped table-bordered" style="width:100%" id="example">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th style="color:#FF0000">Existencia (UNID)</th>

                    </tr>
                </thead>
                <tbody id="developers">
                    <?php
                    $query = "SELECT * from productos WHERE existencia <= minimo";
                    $result_facturacion = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result_facturacion)) { ?>
                        <tr>
                            <td><?php echo $row['nombre']; ?></td>
                            <td style="color:#FF0000"><?php echo $row['existencia'];  ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php include("includes/footer.php") ?>