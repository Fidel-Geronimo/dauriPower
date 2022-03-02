<?php
session_start();
include("db.php");
include("includes/header.php");
if (isset($_POST['boton'])) {
  if ($_POST['nombre'] == "" || $_POST['costo'] == "" || $_POST['precio'] == "" || $_POST['precio'] == "") { ?>
    <script>
      Swal.fire({
        title: "Error",
        text: "Dejaste Algun campo vacio",
        confirmButtonText: "Aceptar",
        confirmButtonColor: '#007bff',
        icon: 'error'
      }).then(function() {
        window.location = "almacen.php";
      });
    </script>
  <?php } else {

    $cadena = ucwords(strtolower($_POST['nombre'])); //nombre con tildes
    // funcion para eliminar la tilde
    function quitar_tildes($cadena)
    {
      $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
      $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
      $texto = str_replace($no_permitidas, $permitidas, $cadena);
      return $texto; //nombre sin tildes
    }

    $nombre = quitar_tildes($cadena); // aqui obtengo el nombre con tildes
    $precioCompra = $_POST['costo'];
    $precioVenta = $_POST['precio'];
    $existencia = $_POST['existencia'];
    $minimo = $_POST['minimo'];
    $query = "INSERT INTO productos(nombre,precioCompra,precioVenta,existencia,minimo) VALUES('$nombre','$precioCompra','$precioVenta','$existencia','$minimo')";

    $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Creo Un Producto Llamado $nombre')";
    mysqli_query($conn, $queryHistorial);

    $resultado = mysqli_query($conn, $query);

    if (!$resultado) {
      die("Query Failed");
    }

    $_SESSION['nuevoProducto']  = 1;
  ?>
    <script>
      window.location = "almacen.php"
    </script>
<?php
  }
}
?>