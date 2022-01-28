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
}
