<?php
include("db.php");
session_start();
include("includes/header.php");


if (isset($_GET["id"])) {

    if (isset($_POST["Abonar"])) {
        $id = $_GET["id"];
        $abono = $_POST["abono"];
        if ($abono == "") { ?>
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

            $query = "SELECT * FROM entregamuestracredito WHERE id = $id";
            $resultado = mysqli_query($conn, $query);

            if (mysqli_num_rows($resultado) == 1) {
                $row = mysqli_fetch_array($resultado);
                $deuda = $row["total"];
                $abonoAnterior = $row["abono"];
                $idCliente = $row["idCliente"];

                // informacion del cliente
                $queryCliente = "SELECT * FROM clientes WHERE id = $idCliente";
                $resultadoCliente = mysqli_query($conn, $queryCliente);

                if (mysqli_num_rows($resultadoCliente) == 1) {
                    $row = mysqli_fetch_array($resultadoCliente);
                    $nombreCliente = $row["nombre"];
                }
                // /////////////////

                // /////////////////
            }
            $abonoNuevo = $abonoAnterior + $abono;
            $nuevoTotal = $deuda - $abono;

            $query = "UPDATE entregamuestracredito set total= '$nuevoTotal', abono ='$abonoNuevo' WHERE id = $id";
            mysqli_query($conn, $query);


            $queryHistorial = "INSERT INTO historial(descripcion) VALUES('$_SESSION[usuario] registó Un Abono de $abono Pesos Al Cliente $nombreCliente ')";
            mysqli_query($conn, $queryHistorial);

            $_SESSION['messageAbono'] = 1;
        ?>
            <script>
                window.location = "creditos.php";
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
//     windo("Location: login.php");
// }
?>
<!--  -->

<div class="responsive">
    <div class="container p-4 shadow editwidth">
        <div class="col-md-8 mx-auto">
            <div class="card_body">
                <div class="card_body">
                    <form action="abonoCreditos.php?id=<?php echo $_GET["id"]; ?>" method="post">
                        <div class="form-group input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input name="abono" type="number" class="form-control" aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text">.00</span>
                        </div>
                        <div class="botonCentro">
                            <button class="btn btn-success tamano" name="Abonar">
                                Abonar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include("includes/footer.php"); ?>