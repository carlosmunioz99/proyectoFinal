<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <?php
        session_start();
        if (!isset($_SESSION['usuario'])) {
            echo '  <script type="text/javascript">
                        alert("Inicie sesión como administrador para acceder a esta web");
                        window.location.href="index.php";
                    </script>';
            //header('Location:index.php');
        } else {
            include("./conexion/conexion.php");
            $conexion = conectar();
            mysqli_query($conexion, "utf8");
            $cadenaSql = "SELECT tipo from cliente where id_cliente ='" . $_SESSION['usuario'] . "'";
            $resultado = mysqli_query($conexion, $cadenaSql);
            $tipoDeCliente = mysqli_fetch_assoc($resultado);
            if ($tipoDeCliente['tipo'] != 'Administrador') {
                echo '  <script type="text/javascript">
                            alert("Inicie sesión como administrador para acceder a esta web");
                            window.location.href="index.php";
                        </script>';
            } else {
                require 'cabeceraAdministrador.php';
            }
        }
        ?>

        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>Panel de administración</a></li>
            </ol>
        </nav>

        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Configurar cuentas de correo
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <?php
                        $cadenaSql = "SELECT * FROM cuentascorreo";
                        $resultado = $conexion->query($cadenaSql);
                        ?>

                        <form name="frmCorreos">
                            <?php
                            while ($correo = $resultado->fetch_assoc()) {
                            ?>
                                <div style="margin-top: 1%;">
                                    <label for="correoGmail">Correo de calendario de google</label>
                                    <input type="text" class="form-control" name="correoGmail" id="correoGmail" value="<?php echo $correo['correoGmail'] ?>">
                                    <small class="form-text text-danger"></small>
                                </div>
                                <div style="margin-top: 1%;">
                                    <label for="correoSolicitudes" style="margin-top: 1%;">Correo de solicitudes</label>
                                    <input type="text" class="form-control" name="correoSolicitudes" id="correoSolicitudes" value="<?php echo $correo['correoSolicitudes'] ?>">
                                    <small class="form-text text-danger"></small>
                                </div>
                                <input type="button" class="btn btn-danger" style="background-color: #db4d4d; margin-top: 1%;" name="btnCambiarCorreo" id="btnCambiarCorreo" value="Enviar" data-bs-toggle="modal" data-bs-target="#exampleModal">

                            <?php
                            }
                            ?>
                        </form>


                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                        Solicitudes de pedidos
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse " aria-labelledby="headingTwo">
                    <div class="accordion-body">
                        <div>
                            <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=2&amp;bgcolor=%23db4d4d&amp;ctz=Europe%2FMadrid&amp;src=Y183ZGhkdXBlMXA2a2xuNGttZGx2MWM4bTdxY0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&amp;color=%23AD1457&amp;mode=WEEK&amp;showTabs=0&amp;showPrint=0&amp;showNav=1&amp;showDate=1&amp;showCalendars=0&amp;showTz=1" style="border:solid 1px #777" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
                        </div>
                        <table class="table">
                            <tr style="text-align:center;">
                                <th>Número de pedido</th>
                                <th>Id Cliente</th>
                                <th>Fecha del pedido</th>
                                <th>Fecha y hora de recogida</th>
                                <th>Tipo de entrega</th>
                                <th>Proceso</th>
                                <th>Acciones</th>
                            </tr>
                            <?php
                            $cadenaSql = "SELECT * FROM pedido";

                            $resultado = $conexion->query($cadenaSql);
                            while ($pedido = $resultado->fetch_assoc()) {
                                echo "<form method='post' action='procesarPedido.php'>";
                                echo "<tr style='text-align:center;'><td >" . $pedido['id_pedido'] . "</td><td>" . $pedido['id_cliente'] . "</td><td>" . $pedido['fecha'] . "</td><td>" . $pedido['fechaRecogida'] . " | " . $pedido['hora'] . "</td><td>" . $pedido['recogida'] . "</td>";
                                if ($pedido['proceso'] == "En proceso") {
                                    echo "<td style='background-color:grey;'>" . $pedido['proceso'] . "</td>";
                                } elseif ($pedido['proceso'] == "Rechazado") {
                                    echo "<td style='background-color:red;'>" . $pedido['proceso'] . "</td>";
                                } else {
                                    echo "<td style='background-color:green;'>" . $pedido['proceso'] . "</td>";
                                }
                                echo "<td>
                            <input type='submit' style='margin-left:5%' class='btn btn-secondary' id='detalles' name='detalles' value='Ver detalles'>";
                                echo "<input type='submit' style='margin-left:5%' class='btn btn-success' id='aceptar' name='aceptar' value='Aceptar'>";
                                echo "<input type='submit' style='margin-left:5%' class='btn btn-danger' id='enviar' name='enviar' value='Rechazar'>";
                                echo "<input type='hidden' name='idPedido' value='" . $pedido['id_pedido'] . "'>";
                                echo "</td>";
                                echo "<tr>";
                                echo "</form>";
                            }
                            //echo $cadenaSql;
                            ?>

                        </table>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed bg-dark text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Registrar un usuario
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse " aria-labelledby="headingFour">
                    <div class="accordion-body">

                        <div class="row col-12">
                            <div class="row col-3"></div>

                        </div>
                        <div class="row col-12">
                            <div class="row col-3"></div>
                            <form name="frmRegistro" id="frmRegistro" method="POST" class="col-7">
                                <div class="row col-12" style="margin-top: 2%;">
                                    <label for="exampleInputEmail1" class="form-label" style="color: black;">Nombre de usuario</label>
                                    <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" required aria-describedby="emailHelp">
                                    <small class="form-text text-danger"></small>
                                </div>

                                <div class=" row col-12" style="margin-top: 2%;">
                                    <div class="row col-12">
                                        <label for="txtContraseña" class="form-label" style="color: black;">Contraseña</label>
                                        <input type="password" class="form-control" id="txtContraseña" name="txtContraseña">
                                        <small class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="row col-12" style="margin-top: 2%;">
                                    <label for="exampleInputEmail1" class="form-label" style="color: black;">Correo</label>
                                    <input type="email" class="form-control" id="txtCorreo" name="txtCorreo" aria-describedby="emailHelp">
                                    <small class="form-text text-danger"></small>
                                </div>


                                <div style="margin-top: 2%;">
                                    <button type="button" name="btnRegistro" id="btnRegistro" class="btn btn-danger" style="background-color: #db4d4d;" data-bs-toggle="modal" data-bs-target="#exampleModal">Registrarse</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed bg-dark text-white" id="botonPlegar" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Listado de productos
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                        <div>
                            <form name="frmFechaProductos">
                                <label for="fecha">Introduzca una fecha:</label>
                                <input type="date" class="form-control" name="fecha" id="fecha">
                                <input type="button" class="btn btn-danger" style="background-color:#db4d4d; margin-top:1%;" name="consultarProductos" id="consultarProductos" value="Consultar">
                            </form>
                        </div>
                        <div id="contenedorMenusDiarios" style="margin-top: 1%;">

                        </div>
                        <div id="contenedorTablaPlatos" style="margin-top: 1%;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p id="contenidoModal"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/codigoIndex.js"></script>
    <script src="js/codigoAdmin.js"></script>

</body>

</html>