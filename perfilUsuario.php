<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Document</title>
    <?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location:iniciarSesion.php');
    }
    ?>

</head>

<body>
    <div class="container-fluid">
        <?php
        require("conexion/conexion.php");
        require("cabeceraConLogin.php");
        $conexion = conectar();
        ?>


        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Datos del perfil</span>
            </div>
        </nav>

        <div class="row">
            <div class="col-3"></div>
            <div class="col">
                <form class="col-12">

                    <?php
                    $sql = "SELECT * FROM cliente WHERE id_cliente = '" . $_SESSION['usuario'] . "'";
                    $resultado = $conexion->query($sql);

                    while ($cliente = $resultado->fetch_assoc()) { ?>
                        <div class="form-group">
                            <label for='nombreUsuario' class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" readonly value="<?php echo $cliente['id_cliente'] ?>">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for='nombreUsuario' class="form-label">Nombre</label>
                                <input type="text" class="form-control" readonly value="<?php echo $cliente['nombre'] ?>">
                            </div>
                            <div class="col">
                                <label for='nombreUsuario' class="form-label">Apellido</label>
                                <input type="text" class="form-control" readonly value="<?php echo $cliente['apellidos'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for='nombreUsuario' class="form-label">Teléfono</label>
                                <input type="text" class="form-control" readonly value="<?php echo $cliente['telefono'] ?>">
                            </div>
                            <div class="col">
                                <label for='nombreUsuario' class="form-label">Email</label>
                                <input type="text" class="form-control" readonly value="<?php echo $cliente['email'] ?>">
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    </form>


            </div>
            <div class="col-3"></div>
        </div>

        <nav class="navbar navbar-dark bg-dark" style="margin-top: 1%;">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Pedidos</span>
            </div>
        </nav>
        <div>
            <table class="table">
                <tr><th>Número de pedido</th><th>Fecha del pedido</th><th>Fecha y hora de recogida</th><th>Tipo de entrega</th><th>Proceso</th><th>Acciones</th></tr>
                <?php
                    $cadenaSql = "SELECT * FROM pedido WHERE id_cliente = '".$_SESSION['usuario']."'";

                    $resultado = $conexion->query($cadenaSql);
                    while($pedido = $resultado->fetch_assoc())
                    {
                        echo "<form method='post' action='rehacerPedido.php'>";
                        echo "<tr>";
                        
                        echo "<td>".$pedido['id_pedido']."</td><td>".$pedido['fecha']."</td><td>".$pedido['fechaRecogida']." | ".$pedido['hora']."</td><td>".$pedido['recogida']."</td>";
                        if($pedido['proceso'] == "En proceso")
                        {
                            echo "<td style='background-color:grey;'>".$pedido['proceso']."</td>";
                        }elseif($pedido['proceso'] == "Rechazado")
                        {
                            echo "<td style='background-color:red;'>".$pedido['proceso']."</td>";
                        }
                        else
                        {
                            echo "<td style='background-color:green;'>".$pedido['proceso']."</td>";
                        }
                        echo "<td><input type='submit' class='btn btn-danger' style='background-color: #db4d4d;' value='Volver ha realizar el pedido'>
                            <input type='hidden' id='idPedido' name='idPedido' value='".$pedido['id_pedido']."'</td>";
                        
                        echo "</tr>";
                        echo "</form>";
                        
                        
                    }
                ?>

            </table>

        </div>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/codigoIndex.js"></script>
</body>

</html>