<?php
session_start();
include("db.php");
include("includes/header.php");
$productoSelect = ""; //esta viarble sirve para que cuando se recargue el formulario aparezca con ese valor
$cantidad = ""; // esto sirve para ponerle el valor desde que se recarga el formulario

if (isset($_GET["id"])) {
  $id = $_GET["id"];

  if ($id == 2) { //aqui entra cuando es enviado desde el principio despues de la validacion de clientes y vendedores
    if (isset($_GET["idProducto"])) {
      $productoSelect = $_GET["idProducto"]; //esta viarble sirve para que cuando se recargue el formulario aparezca con ese valor
      $cantidad = $_GET['cantidad'];
    }
    $idVendedor = $_GET["idVendedor"]; // aqui se guarda el id del vendedor al facturarlo
    $idCliente = $_GET["idCliente"]; // aqui se guarda el id del cliente al facturarlo

    // informacion del vendedor
    $queryVendedor = "SELECT * FROM vendedores where id=$idVendedor";
    $resultadoVendedor = mysqli_query($conn, $queryVendedor);
    $rowVendedor = mysqli_fetch_array($resultadoVendedor);

    // informacion del Cliente
    $queryCliente = "SELECT * FROM clientes where id=$idCliente";
    $resultadoCliente = mysqli_query($conn, $queryCliente);
    $rowCliente = mysqli_fetch_array($resultadoCliente);
  }

?>
  <?php

  if ($id == 1) { //aqui entra cuando es enviado desde la validacionEntregaCredito

    // captura de datos
    $idVendedor = $_GET["idVendedor"]; // aqui se guarda el id del vendedor al facturarlo
    $idCliente = $_GET["idCliente"]; // aqui se guarda el id del cliente al facturarlo

    // informacion del vendedor
    $queryVendedor = "SELECT * FROM vendedores where id=$idVendedor";
    $resultadoVendedor = mysqli_query($conn, $queryVendedor);
    $rowVendedor = mysqli_fetch_array($resultadoVendedor);

    // informacion del Cliente
    $queryCliente = "SELECT * FROM clientes where id=$idCliente";
    $resultadoCliente = mysqli_query($conn, $queryCliente);
    $rowCliente = mysqli_fetch_array($resultadoCliente);

    $idProducto = $_GET['selectProducto']; //id del producto, se usa para acceder al nombre mediante base de datos
    $queryProducto = "SELECT * FROM productos WHERE id=$idProducto";
    $resultadoIdDetalle = mysqli_query($conn, $queryProducto);
    $rowProducto = mysqli_fetch_array($resultadoIdDetalle);

    $vendedor = $rowVendedor["nombre"];
    $cliente = $rowCliente["nombre"];
    $producto = $rowProducto['nombre'];
    $cantidad = $_GET['cantidad'];
    $precioCompra = $_GET['costo'];
    $precioVenta = $_GET['precio'];
    $subTotal = intval($precioVenta) * intval($cantidad);

    $query = "INSERT INTO nuevaentregacredito(vendedor, cliente, producto, cantidad, precioCompra,precioVenta,idVendedor,idCliente,subtotal) VALUES('$vendedor','$cliente','$producto','$cantidad','$precioCompra', '$precioVenta','$idVendedor','$idCliente','$subTotal')";

    mysqli_query($conn, $query);

    // $_SESSION['message'] = 1;
    // $_SESSION['NombreCliente'] = $nombre;
    // $_SESSION['TelefonoCliente'] = $telefono;
    // $_SESSION['galonesCliente'] = $galones;
    // $_SESSION['deudaCliente'] = $deuda;
    // $_SESSION['AbonoCliente'] = $abono;
    // $_SESSION['precioCliente'] = $precio; 
  ?>
    <script>
      window.location = "nuevaEntregaCredito.php?idVendedor=<?php echo $idVendedor ?>&idCliente=<?php echo $idCliente ?>"
    </script>
<?php

  }
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
?>
<!--  -->

<div class="container p-4 shadow editwidth">
  <div class="col-md-8 mx-auto">
    <div class="card_body">
      <form action="validacionEntregaCredito.php?id=1&idVendedor=<?php echo $idVendedor ?>&idCliente=<?php echo $idCliente ?>" method="post" id="formulario">
        <div class="form-group">
          <!--  -->
          <div class="form-group mb-2">
            <label for="cliente">Cliente</label>
            <input readonly type="text" id="cliente" name="cliente" class="form-control" value="<?php echo $rowCliente['nombre'] ?>">
          </div>
          <!--  -->
          <!--  -->
          <div class="form-group mb-2">
            <label for="vendedor">Vendedor</label>
            <input readonly type="text" id="vendedor" name="vendedor" class="form-control" value="<?php echo $rowVendedor['nombre'] ?>">
          </div>
          <!--  -->
          <div class="form-group mb-2">
            <label>Producto:</label>
            <select id="selectProducto" name="selectProducto" class="js-example-basic-single form-select" aria-label=".form-select-lg example">
              <option selected value="">Selecciona El Producto</option>
              <?php while ($verProductos = mysqli_fetch_row($resultProductos)) { ?>
                <option value="<?php echo $verProductos[0] ?>" <?php if ($productoSelect == $verProductos[0]) echo "selected" ?>>
                  <?php echo $verProductos[1] ?>
                </option>
              <?php  } ?>
            </select>
            <!-- Aqui aparecen los campos de costo, precio de venta y existencia, esto gracias a la funcion AJAX  -->
            <div class="form-group mb-2" id="select2lista"></div>
            <!--==========================================================  -->
          </div>
          <div class="form-group mb-2">
            <label require for="cantidad">Cantidad</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad De Producto" value="<?php echo $cantidad ?>">
          </div>
          <button class="btn btn-success" name="facturar">
            AGREGAR
          </button>
      </form>
    </div>
  </div>
</div>
<?php include("includes/footer.php"); ?>