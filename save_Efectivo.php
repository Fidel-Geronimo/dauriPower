<?php
session_start();
include("db.php");
include("includes/header.php");
if (isset($_GET['id'])) {

  $idVendedor = $_GET['idVendedor'];
  $efectivo = $_GET['efectivo'];

  // informacion del vendedor
  $queryVendedor = "SELECT nombre FROM vendedores where id=$idVendedor";
  $resultadoVendedor = mysqli_query($conn, $queryVendedor);
  $rowVendedor = mysqli_fetch_array($resultadoVendedor);
  $nombreVendedor = $rowVendedor['nombre'];

  $query = "INSERT INTO efectivo(vendedor, cantidad,estado) VALUES('$nombreVendedor','$efectivo',1)";
  $resultado =  mysqli_query($conn, $query);

  $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Registro Una Entrada De Efectivo Del Vendedor $nombreVendedor ')";
  mysqli_query($conn, $queryHistorial);

  if (!$resultado) {
    die("Query Failed");
  }
  $_SESSION['entradaEfectivo']  = 1;
?>
  <script>
    window.location = "efectivo.php"
  </script>
<?php
}


?>