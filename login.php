<?php
session_start();
include("db.php");
$mostrar = 0;
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
    if ($_POST['usuario'] == "" || $_POST['clave'] == "") {
        $mostrar = 2; ?>

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
        } else {
            $mostrar = 1; ?>

<?php }
    }
}
// verificacion de inicio de sesion
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dauri Power Login</title>
    <link rel="stylesheet" href="styles/login.css.">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Dauri Power</span></div>
            <form method="post" action="#">
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input id="login" name="usuario" type="text" placeholder="Usuario" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input name="clave" id="password" type="password" placeholder="Password" required>
                </div>
                <div class="pass"><a href="#">Usuario Y Contraseña</a></div>
                <div class="row button">
                    <input id="btn-login" type="submit" name="login" value="Login">
                </div>
                <?php
                if ($mostrar == 1) {
                    echo "<div>
                        <p style='color:red'>Error, El Usuario No Existe</p>
                    </div>";
                } else if ($mostrar == 2) {
                    echo "<div>
                        <p style='color:red'>Error, Dejaste Algun Campo Vacio</p>
                    </div>";
                }
                ?>
            </form>
        </div>
    </div>
</body>

</html>