<?php
session_start();

include("db.php");
include("includes/header.php");
if (isset($_POST['boton'])) {
  if ($_POST['titulo'] == "" || $_POST['monto'] == "") { ?>
    <script>
      Swal.fire({
        title: "Error",
        text: "Dejaste Algun campo vacio",
        confirmButtonText: "Aceptar",
        confirmButtonColor: '#007bff',
        icon: 'error'
      }).then(function() {
        window.location = "gastos.php";
      });
    </script>
  <?php } else {

    $cadena = ucwords(strtolower($_POST['titulo'])); //nombre con tildes
    // funcion para eliminar la tilde
    function quitar_tildes($cadena)
    {
      $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹");
      $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E");
      $texto = str_replace($no_permitidas, $permitidas, $cadena);
      return $texto; //nombre sin tildes
    }
    $titulo = quitar_tildes($cadena); // aqui obtengo el nombre con tildes
    $monto = $_POST['monto'];
    $descripcion = ucfirst(strtolower($_POST['descripcion']));

    $query = "INSERT INTO gastos(titulo, monto, descripcion,estado) VALUES('$titulo','$monto','$descripcion',1)";
    $resultado =  mysqli_query($conn, $query);

    $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Registró Un Nuevo Gasto ')";
    mysqli_query($conn, $queryHistorial);

    if (!$resultado) {
      die("Query Failed");
    }
    $_SESSION['saveGasto']  = 1;
  ?>
    <script>
      window.location = "gastos.php"
    </script>
<?php

  }
}
?>