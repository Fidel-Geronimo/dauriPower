<?php
include("db.php");
include("includes/header.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];

    if ($id == 1) { //aqui entra cuando es enviado desde el formulario

        // captura de datos
        $idVendedor = $_GET["idVendedor"]; // aqui se guarda el id del vendedor al facturarlo
        $idProducto = $_POST['selectProducto']; //id del producto, se usa para acceder al nombre mediante base de datos
        $cantidad = $_POST['cantidad'];
        $costo = $_POST['costo'];
        $precio = $_POST['precio'];
        if ($idVendedor == "" || $idProducto == "" || $cantidad == "") { ?>
            <script>
                Swal.fire({
                    title: "Error",
                    text: "Dejaste Algunos Campos Vacios",
                    icon: 'error',
                    confirmButtonColor: '#007bff',
                    backdrop: true,
                    allowOutsideClick: false,
                    confirmButtonText: "Ok",
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "saveTask.php?id=2&idVendedor=<?php echo $idVendedor ?>&idProducto=<?php echo $idProducto ?>&cantidad=<?php echo $cantidad ?>";
                    }
                })
            </script>

        <?php } else {
        ?>
            <script>
                window.location.href = "saveTask.php?id=1&idVendedor=<?php echo $idVendedor ?>&costo=<?php echo $costo ?>&precio=<?php echo $precio ?>&selectProducto=<?php echo $idProducto ?>&cantidad=<?php echo $cantidad ?>";
            </script>

<?php
        }
    }
}
