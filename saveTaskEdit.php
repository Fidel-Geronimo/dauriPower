<?php
session_start();
include("db.php");


// Consulta para el select de los productos
$sqlProductos = "SELECT id,nombre from productos";
$resultProductos = mysqli_query($conn, $sqlProductos);

if (isset($_GET["id"])) {
  $id = $_GET['id'];

  if ($id == 1) {
    // id del vendedor
    $idVendedor = $_GET["idVendedor"];
    $sqlVendedor = "SELECT nombre from vendedores WHERE id=$idVendedor";
    $resultVendedor = mysqli_query($conn, $sqlVendedor);
    $rowVendedor = mysqli_fetch_array($resultVendedor);
  } else if ($id == 2) {

    $idDetalle = $_GET["idDetalle"];
    $idVendedor = $_GET["idVendedor"]; // aqui se guarda el id del vendedor al facturarlo
    $query = "SELECT * FROM vendedores where id=$idVendedor";
    $resultadoCliente = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($resultadoCliente);

    $idProducto = $_GET['selectProducto']; //id del producto, se usa para acceder al nombre mediante base de datos
    $queryProducto = "SELECT * FROM productos WHERE id=$idProducto";
    $resultadoIdDetalle = mysqli_query($conn, $queryProducto);
    $rowProducto = mysqli_fetch_array($resultadoIdDetalle);

    $vendedor = $row["nombre"];
    $producto = $rowProducto['nombre'];
    $cantidad = $_GET['cantidad'];
    $precioCompra = $_GET['costo'];
    $precioVenta = $_GET['precio'];
    $subTotal = $precioVenta * $cantidad;


    $query = "INSERT INTO detalleentregas(vendedor, producto, cantidad, precioCompra,precioVenta,idDetalle,subtotal) VALUES('$vendedor','$producto','$cantidad','$precioCompra', '$precioVenta','$idDetalle','$subTotal')";
    mysqli_query($conn, $query);

    // Actualizando total de la tabla de muestra
    $queryEntregas = "SELECT * FROM entregasmuestra WHERE idDetalle = '$idDetalle'";
    $resultadoEntregas = mysqli_query($conn, $queryEntregas);
    $rowEntregas = mysqli_fetch_array($resultadoEntregas);
    $totalEntregas = $rowEntregas['total'] + $subTotal;

    $queryEntregas = "UPDATE entregasmuestra SET total=$totalEntregas WHERE idDetalle = '$idDetalle'";
    $resultado = mysqli_query($conn, $queryEntregas);
    // =================================================================

    // $_SESSION['message'] = 1;
    // $_SESSION['NombreCliente'] = $nombre;
    // $_SESSION['TelefonoCliente'] = $telefono;
    // $_SESSION['galonesCliente'] = $galones;
    // $_SESSION['deudaCliente'] = $deuda;
    // $_SESSION['AbonoCliente'] = $abono;
    // $_SESSION['precioCliente'] = $precio; 
    header("Location: editEntrega.php?idDetalle=$idDetalle&idVendedor=$idVendedor");
  }

?>
  <!-- <script>
    console.log(<?php echo $idDetalle; ?>);
    // window.location = "editEntrega.php?idDetalle" + <?php echo $idDetalle ?>;
  </script> -->
<?php

}

?>

<style>
  .editwidth {
    max-width: 540px !important;
  }
</style>

<!-- verificacion de inicio de sesion -->
<?php
if (!isset($_SESSION["rol"])) {
  header("Location: login.php");
}
include("includes/header.php");
?>
<!--  -->

<div class="container p-4 shadow editwidth">
  <div class="col-md-8 mx-auto">
    <div class="card_body">
      <form action="validacionEntregaEdit.php?id=2&idDetalle=<?php echo $_GET['idDetalle'] ?>&idVendedor=<?php echo $_GET['idVendedor'] ?>" method="post" id="formulario">
        <div class="form-group">
          <!--  -->
          <div class="form-group mb-2">
            <label for="vendedor">Vendedor</label>
            <input readonly type="text" id="vendedor" name="vendedor" class="form-control" value="<?php echo $rowVendedor['nombre'] ?>">
          </div>
          <!--  -->
        </div>
        <!--  -->
        <div class="form-group mb-2">
          <label>Producto:</label>
          <select id="selectProducto" name="selectProducto" class="js-example-basic-single form-select" aria-label=".form-select-lg example">
            <option selected value="">Selecciona El Producto</option>
            <?php while ($verProductos = mysqli_fetch_row($resultProductos)) { ?>
              <option value="<?php echo $verProductos[0] ?>">
                <?php echo $verProductos[1] ?>
              </option>
            <?php  } ?>
          </select>
          <!-- Aqui aparecen los campos de costo, precio de venta y existencia, esto gracias a la funcion AJAX  -->
          <div class="form-group mb-2" id="select2lista"></div>
          <!--  -->
        </div>
        <div class="form-group mb-2" id="select2lista"></div>
        <!--  -->
    </div>
    <div class="form-group mb-2">
      <label for="cantidad">Cantidad</label>
      <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad De Producto">
    </div>
    <button class="btn btn-success" name="facturar">
      AGREGAR
    </button>
    </form>
  </div>
</div>
</div>
<?php include("includes/footer.php"); ?>