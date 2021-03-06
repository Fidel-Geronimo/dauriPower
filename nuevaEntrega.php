<?php
session_start();
include("db.php");
include("includes/header.php");
?>
<!-- verificacion de inicio de sesion -->
<?php

if (!isset($_SESSION["rol"])) {
  header("Location: login.php");
} ?>

<!-- MENSAJES QUE LANZA AL USUARIO REALIZAR DISTINTIAS ACCIONES -->
<?php
// mensaje que lanza al Agregar Producto por producto al proceso de entrega
if (isset($_SESSION['message'])) { ?>
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
<?php unset($_SESSION['message']);
} ?>

<?php
// mensaje que lanza al Eliminar un producto de la cesta de entrega
if (isset($_SESSION['deleteProductoEntrega'])) { ?>
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
<?php unset($_SESSION['deleteProductoEntrega']);
} ?>


<!-- ============================================ -->


<div class="container mb-3 mt-2">
  <div class="row align-items-center">
    <div class="col">
      <h3>SELECCIONA PRODUCTOS</h1>
    </div>
    <div class="col">
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="button" onclick="location.href='saveTask.php?id=3&idVendedor=<?php echo $_GET['idVendedor'] ?>'" class="btn btn-primary"><i class="fas fa-plus"></i></button>
        <button type="button" onclick="location.href='agregarEntrega.php?id=1'" class="btn btn-success"><i class="fas fa-check-circle"></i></button>
      </div>
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
          <th>Vendedor</th>
          <th>producto</th>
          <th>cantidad</th>
          <th>Precio Compra</th>
          <th>Precio Venta</th>
          <th style="color: #38b52d;">Sub Total</th>
          <th>Acciones</th>


        </tr>
      </thead>
      <tbody id=" developers">
        <?php

        $query = "SELECT * from nuevaentrega ORDER BY fecha DESC";
        $result_facturacion = mysqli_query($conn, $query);
        $contador = 0;
        $total = 0;

        while ($row = mysqli_fetch_array($result_facturacion)) { ?>
          <tr>
            <td><?php echo $row['vendedor']; ?></td>
            <td><?php echo $row['producto']; ?></td>
            <td><?php echo $row['cantidad']; ?></td>
            <td><?php echo $row['precioCompra']; ?></td>
            <td><?php echo $row['precioVenta'] ?></td>
            <td style="color:#38b52d"><?php echo $row['subtotal'] ?></td>

            <td>
              <!-- boton De acciones-->

              <a onclick="confirmacionProducto('<?php echo $row['id'] ?>',<?php echo $_GET['idVendedor'] ?>)" class="btn btn-danger botonesOpciones elimina">Eliminar</a>
              <!-- <a class="btn btn-success botonesOpciones" onclick="confirmacionPago(<?php echo $row['id'] ?>)">Pago</a> -->
              <!--  -->
            </td>
          </tr>
        <?php $total = $total + $row['subtotal'];
        } ?>

      </tbody>
    </table>
    <label style="color: #38b52d" for="total"><b>TOTAL ENTREGA $</b></label>
    <input type="text" value="<?php echo $total ?>" readonly>
  </div>
</div>
</div>
</div>
<?php include("includes/footer.php") ?>