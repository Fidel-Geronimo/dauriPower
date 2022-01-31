<?php
include("db.php");
include("includes/header.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    if ($id == 2) {
        $idVendedor = $_POST["selectVendedor"];
        if ($idVendedor == "Selecciona El Vendedor" || $idVendedor == "") { ?>
            <script>
                Swal.fire({
                    title: "Error De Vendedor",
                    text: "Debes Seleccionar El Vendedor",
                    icon: 'error',
                    confirmButtonColor: '#007bff',
                    backdrop: true,
                    allowOutsideClick: false,
                    confirmButtonText: "Ok",
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "index.php";
                    }
                })
            </script>

        <?php } else {
        ?>
            <script>
                window.location.href = "saveTask.php?id=2&idVendedor=<?php echo $idVendedor ?>";
            </script>

        <?php
        }
    }

    if ($id == 1) {
        //id de vendedor y del cliente selecionado en modal
        $idVendedor = $_POST["selectVendedorCredito"];
        $idCliente = $_POST["selectClienteCredito"];

        if ($idVendedor == "Selecciona El Vendedor" || $idVendedor == "" || $idCliente == "Selecciona El Cliente" || $idCliente == "") { ?>
            <script>
                Swal.fire({
                    title: "Error De Vendedor/Cliente",
                    text: "Debes Seleccionar El Vendedor y El Cliente",
                    icon: 'error',
                    confirmButtonColor: '#007bff',
                    backdrop: true,
                    allowOutsideClick: false,
                    confirmButtonText: "Ok",
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "creditos.php";
                    }
                })
            </script>

        <?php } else {
        ?>
            <script>
                window.location.href = "saveTaskCredito.php?id=2&idVendedor=<?php echo $idVendedor ?>&idCliente=<?php echo $idCliente ?>";
            </script>

<?php
        }
    }
}
