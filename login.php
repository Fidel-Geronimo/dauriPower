<?php
session_start();
include("db.php");
?>

<?php
// verificacion de inicio de sesion
if (isset($_GET["cerrar_sesion"])) {
    session_unset();
}


if (isset($_SESSION["rol"])) {
    if ($_SESSION["rol"] == 1) {
        header("Location: index.php");
    } else if ($_SESSION["rol"] == 2) {
        header("Location: km15/facturacionkm15.php");
    }
}

if (isset($_POST["login"])) {
    if ($_POST['usuario'] == "" || $_POST['clave'] == "") { ?>
        <script>
            alert("Dejaste un campo vacio")
        </script>
        <?php } else {
        $usuario = $_POST["usuario"];
        $contra = $_POST["clave"];

        $query = "SELECT * FROM usuarios WHERE nombre = '$usuario' AND contrasena = '$contra'";
        $resultado = mysqli_query($conn, $query);
        $filas = mysqli_num_rows($resultado);
        $row = mysqli_fetch_array($resultado);

        if ($filas == 1) {
            $rol = $row[3];
            $_SESSION["rol"] = $rol;
            switch ($_SESSION["rol"]) {
                case 1:
                    $_SESSION["usuario"] = "Dauris";
                    header("Location: index.php");
                    break;
                default:
            }
        } else { ?>
            <script>
                alert("Usuario no encontrado")
            </script>
<?php }
    }
}
// verificacion de inicio de sesion
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap 4-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="styles/login.css" rel="stylesheet">
    <!-- favicon -->
    <!-- <link rel="shortcut icon" href="img/logo.ico"> -->
    <title>Login</title>
</head>

<body>

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="img/logo.ico" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form method="post" action="#">
                <input type="text" id="login" class="fadeIn second" name="usuario" placeholder="Usuario">
                <input type="password" id="password" class="fadeIn third" name="clave" placeholder="Contraseña">
                <input type="submit" name="login" class="fadeIn fourth" value="Ingresar">
            </form>
        </div>
    </div>


</body>

</html>