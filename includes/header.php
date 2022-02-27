<?php
include("db.php");
// Consulta para el select de los vendedores
$sql = "SELECT id,nombre from vendedores";
$result = mysqli_query($conn, $sql);

// Consulta para el select de los vendedores en las entrada efectivo
$sqlEfectivo = "SELECT id,nombre from vendedores";
$resultEfectivo = mysqli_query($conn, $sql);

// Consulta para el select de los productos
$sqlProductos = "SELECT id,nombre from productos";
$resultProductos = mysqli_query($conn, $sqlProductos);

// Consulta para el select de la ventana modal de los vendedores y clientes 
$sqlVendedor = "SELECT id,nombre from vendedores";
$resultVendedor = mysqli_query($conn, $sqlVendedor);

$sqlCliente = "SELECT id,nombre from clientes";
$resultCliente = mysqli_query($conn, $sqlCliente);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Lounge </title>
    <!-- bootstrap 5-->
    <link href="https://bootswatch.com/5/litera/bootstrap.min.css" rel="stylesheet"> <!-- cdn de BootWach -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

    <!-- iconos de booststrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">

    <!-- font awesome 5 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <!-- cloudtables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css" />

    <!-- favicon -->
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">

    <!-- estilos adicionales -->
    <link href="styles/estilos.css" rel="stylesheet">

    <!-- select2 y jquery  -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- sweet aler2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <nav class="navbar navbar-dark bg-dark shadow width-nav">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">Power Lounge</a>

        </div>
    </nav>
    <!-- Modal par seleccionar el Vendedor al ser agregado -->
    <div class="modal fade" id="modalVendedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Selecciona El Vendedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="validacionVendedor.php?id=2" method="post">
                        <label for="selectVendedor"><b>Vendedor:</b></label>
                        <select style="width: 100%" required id="selectVendedor" name="selectVendedor" class="form-select" aria-label="Default select example">
                            <option selected>Selecciona El Vendedor</option>
                            <?php while ($ver = mysqli_fetch_row($result)) { ?>
                                <option value="<?php echo $ver[0] ?>">
                                    <?php echo $ver[1] ?>
                                </option>
                            <?php  } ?>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Listo</button>

                </div>
                </form>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- Modal par seleccionar el Vendedor y el cliente en el agregado de un credito nuevo -->
    <div class="modal fade" id="modalVendedorYcliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Selecciona El Vendedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="validacionVendedor.php?id=1" method="post">
                        <label for="selectVendedorCredito"><b>Vendedor:</b></label>
                        <select style="width: 100%" required id="selectVendedorCredito" name="selectVendedorCredito" class="form-select" aria-label="Default select example">
                            <option selected>Selecciona El Vendedor</option>
                            <?php while ($ver = mysqli_fetch_row($resultVendedor)) { ?>
                                <option value="<?php echo $ver[0] ?>">
                                    <?php echo $ver[1] ?>
                                </option>
                            <?php  } ?>
                        </select>
                        <label for="selectClienteCredito"><b>Cliente:</b></label>
                        <select style="width: 100%" required id="selectClienteCredito" name="selectClienteCredito" class="form-select" aria-label="Default select example">
                            <option selected>Selecciona El Cliente</option>
                            <?php while ($ver = mysqli_fetch_row($resultCliente)) { ?>
                                <option value="<?php echo $ver[0] ?>">
                                    <?php echo $ver[1] ?>
                                </option>
                            <?php  } ?>
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Listo</button>

                </div>
                </form>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- Modal menu lateral-->
    <div class="modal fade edicionModal-1" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content edicionModal-1">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <ul class="list-group list-group-flush">
                        <a href="index.php" class="nav-link">
                            <li class="bg-success text-white list-group-item itemMenuLateral"><i class="bi bi-send-fill"></i> ENTREGAS</li>
                        </a>
                        <a href="almacen.php" class="nav-link">
                            <li class="list-group-item itemMenuLateral bg-success text-white"><i class="bi bi-piggy-bank-fill"></i> ALMACEN</li>
                        </a>
                        <a href="efectivo.php" class="nav-link">
                            <li class="list-group-item itemMenuLateral bg-success text-white"><i class="bi bi-coin"></i> EFECTIVO</li>
                        </a>
                        <a href="gastos.php" class="nav-link">
                            <li class="list-group-item itemMenuLateral bg-success text-white"><i class="bi bi-wallet2"></i> GASTOS</li>
                        </a>
                        <a href="creditos.php" class="nav-link">
                            <li class="list-group-item itemMenuLateral bg-success text-white"><i class="bi bi-credit-card-2-back-fill"></i> CREDITOS</li>
                        </a>
                        <a href="clientes.php" class="nav-link">
                            <li class="list-group-item itemMenuLateral bg-success text-white"><i class="bi bi-people-fill"></i> CLIENTES</li>
                        </a>
                        <a href="vendedores.php" class="nav-link">
                            <li class="list-group-item itemMenuLateral bg-success text-white"><i class="bi bi-basket3-fill"></i> VENDEDORES</li>
                        </a>
                        <a href="historial.php" class="nav-link">
                            <li class="list-group-item itemMenuLateral bg-success text-white"><i class="bi bi-clock-history"></i> HISTORIAL</li>
                        </a>
                        <a href="login.php?cerrar_sesion=cerrar" class="nav-link" id="prueba">
                            <li class="list-group-item itemMenuLateral">CERRAR SESION</li>
                        </a>
                    </ul>
                </div>
                <div class="modal-footer">
                    <div class="container">
                        <div class="row">
                            <button type="button" onclick="location.href='cuadre.php'" class="btn btn-inverse">CUADRAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- Modal de REGISTRO DE ENTRADA EFECTIVO-->
    <div class="modal fade" id="registroEntradaEfectivo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Entrada De Efectivo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="validacionEfectivo.php?id=1" method="post">
                        <label for="selectVendedorEntrada"><b>Vendedor:</b></label>
                        <select style="width: 100%" required id="selectVendedorEntrada" name="selectVendedorEntrada" class="form-select" aria-label="Default select example">
                            <option selected>Selecciona El Vendedor</option>
                            <?php while ($ver = mysqli_fetch_row($resultEfectivo)) { ?>
                                <option value="<?php echo $ver[0] ?>">
                                    <?php echo $ver[1] ?>
                                </option>
                            <?php  } ?>
                        </select>
                        <div class="form-group mt-3">
                            <input type="number" name="efectivo" class="form-control mt-2" placeholder="Cantidad De Efectivo" autofocus>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" name="boton" value="Registrar">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de creacion cliente-->
    <div class="modal fade" id="registroCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Creacion De Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="save_Cliente.php" method="post">
                        <div class="form-group">
                            <input type="text" name="nombre" class="form-control mt-2" placeholder="Nombre Completo" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="telefono" class="form-control mt-2" placeholder="Numero de Telefono">
                        </div>
                        <div class="form-group">
                            <input type="text" name="direccion" class="form-control mt-2" placeholder="Direccion">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Comentarios Adicionales</label>
                            <textarea name="comentario" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" name="boton" value="Crear">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de creacion Vendedores-->
    <div class="modal fade" id="registroVendedor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Creacion De Vendedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="save_Vendedor.php" method="post">
                        <div class="form-group">
                            <input type="text" name="nombre" class="form-control mt-2" placeholder="Nombre Completo" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="telefono" class="form-control mt-2" placeholder="Numero de Telefono">
                        </div>
                        <div class="form-group">
                            <input type="text" name="direccion" class="form-control mt-2" placeholder="Direccion">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Comentarios Adicionales</label>
                            <textarea name="comentario" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" name="boton" value="Crear">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal de registro De un gasto-->
    <div class="modal fade" id="registroGasto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Registro De Gastos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="save_Gasto.php" method="post">
                        <div class="form-group mb-2">
                            <label for="titulo">Titulo: </label>
                            <input type="text" id="titulo" name="titulo" class="form-control mt-2" placeholder="Titulo Del Gasto" autofocus>
                        </div>
                        <div class="form-group mb-2">
                            <label for="monto">Monto Pagado: </label>
                            <input type="number" id="monto" name="monto" class="form-control mt-2" placeholder="Valor En Efectivo">
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleFormControlTextarea1" class="form-label">Descripcion Adicional</label>
                            <textarea name="descripcion" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" name="boton" value="Registrar">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal de creacion Productos-->
    <div class="modal fade" id="registroProductos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="save_Producto.php?id=1" method="post" id="formulario">
                        <div class="form-group mb-2">
                            <label for="nombre">Nombre: </label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre Del Producto">
                        </div>
                        <div class="form-group mb-2">
                            <label for="costo">Costo: </label>
                            <input type="number" id="costo" name="costo" class="form-control" placeholder="Costo Del Producto">
                        </div>
                        <div class="form-group mb-2">
                            <label for="precio">Precio: </label>
                            <input type="precio" id="precio" name="precio" class="form-control" placeholder="Precio Del Producto">
                        </div>
                        <div class="form-group mb-2">
                            <label for="existencia">Existencia: </label>
                            <input type="number" id="existencia" name="existencia" class="form-control" placeholder="Existencia En Almacen">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" name="boton" value="Crear">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal de titulo de entrada de Productos-->
    <div class="modal fade" id="tituloEntrada" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Titulo De La Entrada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="agregarEntrada.php?id=1" method="post" id="formulario">
                        <div class="form-group mb-2">
                            <label for="titulo">Titulo: </label>
                            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Titulo De La Entrada">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" name="boton" value="Guardar">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>