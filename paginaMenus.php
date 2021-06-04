<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <?php
    require('conexion/conexion.php');

    $conexion = conectar();
    mysqli_query($conexion, "utf8");
    ?>

    <title>Document</title>
</head>

<body>
    <div class="container-fluid">

        <?php
        session_start();
        if (!isset($_SESSION['usuario'])) {

            require 'cabeceraSinLogin.php';
        } else {

            $cadenaSql = "SELECT tipo from cliente where id_cliente ='" . $_SESSION['usuario'] . "'";
            $resultado = mysqli_query($conexion, $cadenaSql);
            $tipoDeCliente = mysqli_fetch_assoc($resultado);
            if ($tipoDeCliente['tipo'] != 'Administrador') {
                require 'cabeceraConLogin.php';
            } else {
            }
        }


        ?>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Menús</a></li>
            </ol>
        </nav>

        <div class="row row-cols-xl-4 row-cols-lg-2 row-cols-md-2 row-cols-md-1" style="margin-left:2%">

            <?php

            $cadenaSql = "SELECT * FROM menu where id_menu in(SELECT ID_MENU FROM diario)";
            $imagen = array();
            $resultado = $conexion->query($cadenaSql);
            $listadoMenus = array();
            while ($comidas = $resultado->fetch_assoc()) {
                $listadoMenus[] = $comidas;
            }
            for ($i = 0; $i < count($listadoMenus); $i++) {
                $imagen[] = $listadoMenus[$i]['imagen'];
            ?>
                <div class="col">
                    <div class="card text-center" style="width: 18rem; border:none">
                        <?php
                        echo "<img class='card-img-top' style='width:350px; display:block; margin:auto; border-radius:5px' src= 'data:image/png; base64," . base64_encode($imagen[$i]) . "'> ";
                        ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $listadoMenus[$i]['nombre'] ?></h5>
                            <p class="card-text"><?php echo $listadoMenus[$i]['precio'] ?>€</p>
                            <a href="detallesMenu.php?idMenu=<?php echo $listadoMenus[$i]['id_menu'] ?>" class="btn btn-dark" style="width: 50%;">Detalles</a>
                        </div>
                    </div>
                </div>

            <?php
            }
            /*echo "<pre>";
        print_r($listadoComidas);
        echo "</pre>";*/
            ?>
        </div>


        <div class="row row-cols-xl-4 row-cols-lg-2 row-cols-md-2 row-cols-md-1" style="margin-left:2%">

            <?php

            $cadenaSql = "SELECT * FROM plato WHERE categoria = 'Carnes'";
            $imagen = array();
            $resultado = $conexion->query($cadenaSql);
            $listadoComidas = array();
            while ($comidas = $resultado->fetch_assoc()) {
                $listadoComidas[] = $comidas;
            }
            for ($i = 0; $i < count($listadoComidas); $i++) {
                $imagen[] = $listadoComidas[$i]['imagen'];
            ?>
                <div class="col">
                    <div class="card text-center" style="width: 18rem; border:none">
                        <?php
                        echo "<img class='card-img-top' style='width:350px; display:block; margin:auto; border-radius:5px' src= 'data:image/png; base64," . base64_encode($imagen[$i]) . "'> ";
                        ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $listadoComidas[$i]['nombre'] ?></h5>
                            <p class="card-text"><?php echo $listadoComidas[$i]['precio'] ?>€</p>
                            <a href="detallesPlato.php?idPlato=<?php echo $listadoComidas[$i]['id_plato'] ?>" class="btn btn-dark" style="width: 50%;">Detalles</a>
                        </div>
                    </div>
                </div>

            <?php
            }
            /*echo "<pre>";
        print_r($listadoComidas);
        echo "</pre>";*/
            ?>
        </div>
        <div class="row row-cols-xl-4 row-cols-lg-2 row-cols-md-2 row-cols-md-1" style="margin-left:2%">

            <?php

            $cadenaSql = "SELECT * FROM plato WHERE categoria = 'Pasta'";
            $imagen = array();
            $resultado = $conexion->query($cadenaSql);
            $listadoComidas = array();
            while ($comidas = $resultado->fetch_assoc()) {
                $listadoComidas[] = $comidas;
            }
            for ($i = 0; $i < count($listadoComidas); $i++) {
                $imagen[] = $listadoComidas[$i]['imagen'];
            ?>
                <div class="col">
                    <div class="card text-center" style="width: 18rem; border:none">
                        <?php
                        echo "<img class='card-img-top' style='width:350px; display:block; margin:auto; border-radius:5px' src= 'data:image/png; base64," . base64_encode($imagen[$i]) . "'> ";
                        ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $listadoComidas[$i]['nombre'] ?></h5>
                            <p class="card-text"><?php echo $listadoComidas[$i]['precio'] ?>€</p>
                            <a href="detallesPlato.php?idPlato=<?php echo $listadoComidas[$i]['id_plato'] ?>" class="btn btn-dark" style="width: 50%;">Detalles</a>
                        </div>
                    </div>
                </div>

            <?php
            }
            /*echo "<pre>";
print_r($listadoComidas);
echo "</pre>";*/
            ?>
        </div>


        <div class="row row-cols-xl-4 row-cols-lg-2 row-cols-md-2 row-cols-md-1" style="margin-left:2%">

            <?php

            $cadenaSql = "SELECT * FROM plato WHERE categoria = 'Postres'";
            $imagen = array();
            $resultado = $conexion->query($cadenaSql);
            $listadoComidas = array();
            while ($comidas = $resultado->fetch_assoc()) {
                $listadoComidas[] = $comidas;
            }
            for ($i = 0; $i < count($listadoComidas); $i++) {
                $imagen[] = $listadoComidas[$i]['imagen'];
            ?>
                <div class="col">
                    <div class="card text-center" style="width: 18rem; border:none">
                        <?php
                        echo "<img class='card-img-top' style='width:350px; display:block; margin:auto; border-radius:5px' src= 'data:image/png; base64," . base64_encode($imagen[$i]) . "'> ";
                        ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $listadoComidas[$i]['nombre'] ?></h5>
                            <p class="card-text"><?php echo $listadoComidas[$i]['precio'] ?>€</p>
                            <a href="detallesPlato.php?idPlato=<?php echo $listadoComidas[$i]['id_plato'] ?>" class="btn btn-dark" style="width: 50%;">Detalles</a>
                        </div>
                    </div>
                </div>

            <?php
            }
            /*echo "<pre>";
        print_r($listadoComidas);
        echo "</pre>";*/
            ?>
        </div>




        <div style="bottom: 0px;" class="container-fuid bg-dark text-center p-3">
            <img src="imagenes/instagram.png" style="filter:invert(100%);">
            <img src="imagenes/twitter.png" style="filter:invert(100%);">
            <img src="imagenes/facebook.png" style="filter:invert(100%);">
            <p style="color: white;"><img src="imagenes/gmail.png" style="filter:invert(100%);"> cmtakeaway@contacto.es</p>
        </div>



    </div>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/codigoIndex.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>

</body>

</html>