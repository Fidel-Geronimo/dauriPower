<?php include("db.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "select comentario from clientes where id =$id ";
    $resultado = mysqli_query($conn, $query);
    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $comentario = $row['comentario'];
    }
} ?>

<!--  -->
<?php include("includes/header.php"); ?>
<div class="container p-4 shadow editwidth">
    <div class="col-md-8 mx-auto">
        <div class="card_body">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Comentarios Adicionales</label>
                <textarea name="comentario" placeholder="Vacio" disabled class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $comentario ?></textarea>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>