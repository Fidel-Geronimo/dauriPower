<?php
include("db.php");
include("includes/header.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT * FROM productos WHERE id = $id";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $nombre = $row["nombre"];
        $costo = $row["precioCompra"];
        $precio = $row["precioVenta"];
        $existencia = $row["existencia"];
        $comentario = $row["comentario"];
    }
    if (isset($_POST["actualizar"])) {
        if ($_POST['nombre'] == "" || $_POST['costo'] == "" || $_POST['precio'] == "") { ?>
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
            $costo = $_POST["costo"];
            $precio = ucfirst(strtolower($_POST["precio"]));
            $existencia = $_POST["existencia"];
            $comentario = ucfirst(strtolower($_POST["comentario"]));

            $query = "UPDATE productos set nombre = '$nombre', precioCompra= '$costo',precioVenta= '$precio',existencia= '$existencia',comentario= '$comentario' WHERE id = $id";
            mysqli_query($conn, $query);

            $_SESSION['messageEdit'] = 1; ?>
            <script>
                window.location = "almacen.php";
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
    <div class="col-md-8 mx-auto">
        <div class="card_body">
            <form action="editProducto.php?id=<?php echo $_GET["id"]; ?>" method="post">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="costo">Costo</label>
                    <input type="tel" name="costo" id="apellido" value="<?php echo $costo ?>" class="form-control" placeholder="Edita el Telefono">
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" id="precio" value="<?php echo $precio ?>" class="form-control" placeholder="Edita la direccion">
                </div>
                <div class="form-group">
                    <label for="existencia">Existencia</label>
                    <input type="text" name="existencia" id="existencia" value="<?php echo $existencia ?>" class="form-control" placeholder="Edita la direccion">
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