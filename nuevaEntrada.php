<?php
session_start();
include("db.php");
include("includes/header.php");
?>
<!-- verificacion de inicio de sesion -->

<?php
$tituloEntrada = "";
if (!isset($_SESSION["rol"])) {
  header("Location: login.php");
} ?>
<!-- MENSAJES QUE LANZA AL USUARIO REALIZAR DISTINTIAS ACCIONES -->
<?php
// mensaje que lanza al Agregar Producto por producto al proceso de entrada
if (isset($_SESSION['nuevaEntradaProducto'])) { ?>
  <script>
    Swal.fire({
      title: "Agregado!",
      showConfirmButton: false,
      icon: 'success',
      toast: true,
      position: "bottom-end",
      timer: 2000
    });
  </script>
<?php unset($_SESSION['nuevaEntradaProducto']);
} ?>

<?php
// mensaje que lanza al Eliminar Producto por producto al proceso de entrada
if (isset($_SESSION['productoDelete'])) { ?>
  <script>
    Swal.fire({
      title: "Eliminado!",
      showConfirmButton: false,
      icon: 'success',
      toast: true,
      position: "bottom-end",
      timer: 2000
    });
  </script>
<?php unset($_SESSION['productoDelete']);
} ?>


<!-- ==================================================================== -->
<div class="container mb-3 mt-2">
  <div class="row align-items-center">
    <div class="col">
      <h3>ENTRADA</h1>
    </div>
    <div class="col">
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="button" onclick="location.href='saveTaskEntrada.php?id=10'" class="btn btn-primary "><i class="fas fa-plus"></i></button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tituloEntrada"><i class="fas fa-check-circle"></i></button>
      </div>
    </div>
  </div>
</div>
</div>
<div class="container">
  <div class=" table-responsive">
    <!-- tabla -->
    <table class="table table-striped table-bordered" style="width:100%" id="example">
      <thead>
        <tr>
          <th>Productos</th>
          <th style="color: #0000FF;">Cantidad</th>
          <th style="color: #ff0000 ">Costo</th>
          <th style="color: #38b52d ">Precio Venta</th>
          <th>Sub Total</th>
          <th>Acciones</th>


        </tr>
      </thead>
      <tbody id=" developers">
        <?php

        $query = "SELECT * from nuevaentrada ORDER BY fecha DESC";
        $result_facturacion = mysqli_query($conn, $query);
        $total = 0;

        while ($row = mysqli_fetch_array($result_facturacion)) { ?>

          <tr>
            <td><?php echo $row['producto']; ?></td>
            <td style="color:#0000FF"><?php echo $row['cantidad'] ?></td>
            <td style="color: #ff0000 "><?php echo $row['precioCompra']; ?></td>
            <td style="color: #38b52d "><?php echo $row['precioVenta']; ?></td>
            <td><?php echo $row['subTotal']; ?></td>

            <td>
              <!-- boton De acciones-->
              <a onclick="confirmacionProductoEntrada(<?php echo $row['id'] ?>)" class="btn btn-danger botonesOpciones elimina">Eliminar</a>
              <!-- <a class="btn btn-success botonesOpciones" onclick="confirmacionPago(<?php echo $row['id'] ?>)">Pago</a> -->
              <!--  -->
            </td>
          </tr>
        <?php

          $total = $total + ($row['cantidad'] * $row['precioCompra']);
        } ?>
      </tbody>
    </table>
    <label style="color: #38b52d" for="total"><b>TOTAL FACTURA $</b></label>
    <input type="text" value="<?php echo $total ?>" readonly>
  </div>
</div>
</div>
</div>
<?php include("includes/footer.php") ?>