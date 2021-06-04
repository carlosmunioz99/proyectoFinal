<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />

    <?php

    require('conexion/conexion.php');
    $conexion = conectar();
    extract($_GET);
    $conexion = conectar();
    mysqli_query($conexion, "utf8");
    $cadenaSql = "SELECT * FROM plato WHERE id_plato = '" . $idPlato . "'";
    $resultado = $conexion->query($cadenaSql);
    $plato = $resultado->fetch_assoc();
    ?>
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <?php
        session_start();
        if (isset($_SESSION['usuario'])) {
            require('cabeceraConLogin.php');
        } else {
            require('cabeceraSinLogin.php');
        }
        ?>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="paginaPlatos.php">Platos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detalles</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 align-self-center">
                <table class="" cellpadding="10">
                    <td rowspan="3">
                        <?php echo "<img class='card-img-top' style='width:600px' src= 'data:image/png; base64," . base64_encode($plato['imagen']) . "'> "; ?>
                    </td>
                    <th style="text-align:center; font-size:20pt" id="nombrePlato" colspan="2"><?php echo $plato['nombre']  ?></th>
                    <tr>
                        <td style="text-align: justify;" colspan="2">
                            <?php echo $plato['descripcion'] ?>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>
                            Precio: <?php echo $plato['precio'] ?>€
                        </td>
                        <td>
                            <form method="POST" name="frmAñadirCarrito" id="frmAñadirCarrito">
                                <input type="button" id="btnAñadirAlCarrito" name="btnAñadirAlCarrito" data-bs-toggle="modal" data-bs-target="#modalConfirmarCarrito" class="btn btn-dark" value="Añadir al carrito">
                                <input type="hidden" value="<?php echo $plato['id_plato'] ?>" name="id_plato">
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-3"> </div>
        </div>
    </div>


   <!-- Modal -->
    <div class="modal fade" id="modalConfirmarCarrito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/codigoIndex.js"></script>
    <script src="js/codigoPlato.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>

</body>

</html>