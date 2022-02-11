<?php
include("db.php");


if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT * FROM gastos WHERE id = $id";
    $resultado = mysqli_query($conn, $query);


    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $titulo = $row["titulo"];
        $monto = $row["monto"];
        $descripcion = $row["descripcion"];
    }
    if (isset($_POST["actualizar"])) {
        if ($_POST['titulo'] == "" || $_POST['monto'] == "") { ?>
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
            $titulo = ucwords(strtolower($_POST["titulo"]));
            $monto = $_POST["monto"];
            $descripcion = ucfirst(strtolower($_POST["descripcion"]));

            $query = "UPDATE gastos set titulo = '$titulo', monto= '$monto',descripcion= '$descripcion' WHERE id = $id";
            mysqli_query($conn, $query);

            // $_SESSION['messageEdit'] = 1; 
        ?>
            <script>
                window.location = "gastos.php";
            </script>
<?php
        }
    }
}
?>

<!-- verificacion de inicio de sesion -->
<?php
// if (!isset($_SESSION["rol"])) {
//     header("Location: login.php");
// } else {
//     if ($_SESSION["rol"] == 2) {
//         header("Location: km15/facturacionkm15.php");
//     }
// }
include("includes/header.php");
?>
<!--  -->

<div class="container p-4 shadow editwidth">
    <div class="col-md-8 mx-auto">
        <div class="card_body">
            <form action="editGasto.php?id=<?php echo $_GET["id"]; ?>" method="post">
                <div class="form-group">
                    <label for="titulo">Titulo</label>
                    <input type="text" id="titulo" name="titulo" value="<?php echo $titulo ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="monto">Monto</label>
                    <input type="number" name="monto" id="monto" value="<?php echo $monto ?>" class="form-control" placeholder="Edita el Monto">
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Comentarios Adicionales</label>
                    <textarea name="descripcion" placeholder="Agrega un comentario" class="form-control" id="descripcion" rows="3"><?php echo $descripcion ?></textarea>
                </div>
                <button class="btn btn-success" name="actualizar">
                    Actualizar
                </button>
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>