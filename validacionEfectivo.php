<?php
include("db.php");
include("includes/header.php");

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    if ($id == 1) {
        //id de vendedor y del cliente selecionado en modal
        $idVendedor = $_POST["selectVendedorEntrada"];
        $efectivo = $_POST["efectivo"];

        if ($idVendedor == "Selecciona El Vendedor" || $idVendedor == "" || $efectivo == "" || $efectivo == 0) { ?>
            <script>
                Swal.fire({
                    title: "Error De Efectivo/Vendedor",
                    text: "Debes Seleccionar El Vendedor Y Agregar Efectivo",
                    icon: 'error',
                    confirmButtonColor: '#007bff',
                    backdrop: true,
                    allowOutsideClick: false,
                    confirmButtonText: "Ok",
                }).then((result) => {
                    if (result.value) {
                        window.location.href = "efectivo.php";
                    }
                })
            </script>

        <?php } else {
        ?>
            <script>
                window.location.href = "save_Efectivo.php?id=1&idVendedor=<?php echo $idVendedor ?>&efectivo=<?php echo $efectivo ?>";
            </script>

<?php
        }
    }
}
