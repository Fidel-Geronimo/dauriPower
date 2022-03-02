<?php
session_start();
include("includes/header.php");
include("db.php");


if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT * FROM clientes WHERE id = $id";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $nombre = $row["nombre"];
        $telefono = $row["telefono"];
        $direccion = $row["direccion"];
        $comentario = $row["comentario"];
    }
    if (isset($_POST["actualizar"])) {
        if ($_POST['nombre'] == "" || $_POST['telefono'] == "" || $_POST['direccion'] == "") { ?>
            <script>
                Swal.fire({
                    title: "Error",
                    text: "Dejaste Algun campo vacio",
                    confirmButtonText: "Aceptar",
                    confirmButtonColor: '#007bff',
                    icon: 'error'
                });
            </script>
        <?php
        } else {

            $id = $_GET["id"];
            $nombre = ucwords(strtolower($_POST["nombre"]));
            $telefono = $_POST["telefono"];
            $direccion = ucfirst(strtolower($_POST["direccion"]));
            $comentario = ucfirst(strtolower($_POST["comentario"]));

            // actualizacion de las facturas pertenecientes a este cliente

            $query = "UPDATE entregamuestracredito set cliente = '$nombre' WHERE idCliente = $id";
            mysqli_query($conn, $query);

            $query = "UPDATE detalleentregacredito set cliente = '$nombre' WHERE idCliente = $id";
            mysqli_query($conn, $query);
            // ===========================================================================

            $query = "UPDATE clientes set nombre = '$nombre', telefono= '$telefono',direccion= '$direccion',comentario= '$comentario' WHERE id = $id";
            mysqli_query($conn, $query);

            $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] Editó La Informacion De Un Cliente')";
            mysqli_query($conn, $queryHistorial);

            $_SESSION['editCliente'] = 1; ?>

            <script>
                window.location = "clientes.php";
            </script>
<?php
        }
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
// if (!isset($_SESSION["rol"])) {
//     header("Location: login.php");
// } else {
//     if ($_SESSION["rol"] == 2) {
//         header("Location: km15/facturacionkm15.php");
//     }
// }

?>
<!--  -->

<div class="container p-4 shadow editwidth">
    <h2 class="text-center">Edicion Cliente</h2>
    <div class="col-md-8 mx-auto">
        <div class="card_body">
            <form action="editCliente.php?id=<?php echo $_GET["id"]; ?>" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="tel" name="telefono" id="apellido" value="<?php echo $telefono ?>" class="form-control" placeholder="Edita el Telefono">
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" name="direccion" id="galones" value="<?php echo $direccion ?>" class="form-control" placeholder="Edita la direccion">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Comentarios Adicionales</label>
                    <textarea name="comentario" placeholder="Agrega un comentario" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $comentario ?></textarea>
                </div>
                <button class="btn btn-success" name="actualizar">
                    Actualizar
                </button>
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>