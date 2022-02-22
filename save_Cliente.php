<?php
session_start();
include("db.php");
include("includes/header.php");
if (isset($_POST['boton'])) {
  if ($_POST['nombre'] == "" || $_POST['telefono'] == "" || $_POST['direccion'] == "") { ?>
    <script>
      Swal.fire({
        title: "Error",
        text: "Dejaste Algun campo vacio",
        confirmButtonText: "Aceptar",
        confirmButtonColor: '#007bff',
        icon: 'error'
      }).then(function() {
        window.location = "clientes.php";
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
    $telefono = $_POST['telefono'];
    $direccion = ucfirst(strtolower($_POST['direccion']));
    $comentario = ucfirst(strtolower($_POST['comentario']));

    $queriConfirmacion = "SELECT * from clientes where telefono = $telefono";
    $resultadoConfirmacion = mysqli_query($conn, $queriConfirmacion);
    if (mysqli_num_rows($resultadoConfirmacion) > 0) {
      $row = mysqli_fetch_array($resultadoConfirmacion);
    ?>
      <script>
        Swal.fire({
          title: "Error",
          text: "Este cliente ya existe, se llama <?php echo $row["nombre"] ?>",
          confirmButtonText: "Aceptar",
          confirmButtonColor: '#007bff',
          icon: 'error'
        }).then(function() {
          window.location = "clientes.php";
        });
      </script>

    <?php  } else {
      $query = "INSERT INTO clientes(nombre, telefono, direccion, comentario) VALUES('$nombre','$telefono','$direccion','$comentario')";

      $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Creó Un Cliente Nuevo Llamado $nombre')";
      mysqli_query($conn, $queryHistorial);

      $resultado =  mysqli_query($conn, $query);

      if (!$resultado) {
        die("Query Failed");
      }
      // $_SESSION['messageCliente']  = 1; 
    ?>
      <script>
        window.location = "clientes.php"
      </script>
<?php
    }
  }
}
?>