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

        require './vendor/Exception.php';
        require './vendor/PHPMailer.php';
        require './vendor/SMTP.php';

        //require './vendor/autoload.php';

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        /*echo "<pre>";
print_r($_POST);
echo "</pre>";*/

        include('conexion/conexion.php');
        $conexion = conectar();
        extract($_POST);

        if (isset($detalles)) {
            require 'cabeceraAdministrador.php';
            $sqlCount = "SELECT  plato.id_plato as idPlato, plato.nombre as nombrePlato, plato.precio as precioPlato, plato.categoria as categoriaPlato, plato.imagen as imagen FROM pedido INNER JOIN pedido_plato ON pedido.id_pedido = pedido_plato.id_pedido INNER JOIN plato ON pedido_plato.id_plato = plato.id_plato WHERE pedido.id_pedido =" . $idPedido;
            $resultado = $conexion->query($sqlCount);
            $numeroDeRegistros = $resultado->num_rows;

            if ($numeroDeRegistros > 0) { ?>
                <nav class="navbar navbar-dark bg-dark" style="margin-top: 1%;">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">Platos por separado</span>
                    </div>
                </nav>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align: center;">
                                Imagen
                            </th>
                            <th>
                                IdPlato
                            </th>
                            <th>
                                Nombre
                            </th>
                            <th>
                                Categoria
                            </th>
                            <th>
                                Precio
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($platos = $resultado->fetch_assoc()) {
                        ?>
                            <tr>
                                <td style="text-align: center;">
                                    <?php echo "<img class='card-img-top' style='width:150px; ' src= 'data:image/png; base64," . base64_encode($platos['imagen']) . "'> "; ?>
                                </td>
                                <td style="vertical-align:middle"><?php echo $platos['idPlato'] ?></td>
                                <td style="vertical-align:middle"><?php echo $platos['nombrePlato'] ?></td>
                                <td style="vertical-align:middle"><?php echo $platos['categoriaPlato'] ?></td>
                                <td style="vertical-align:middle"><?php echo $platos['precioPlato'] ?>€</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            $cadenaSql = "SELECT  menu.id_menu as idMenu, menu.nombre as nombreMenu, diario.fecha as fechaDiario, menu.imagen as imagen , menu.precio as precio
            FROM pedido 
            INNER JOIN pedido_menu ON pedido.id_pedido = pedido_menu.id_pedido 
            INNER JOIN menu ON menu.id_menu = pedido_menu.id_menu
            INNER JOIN diario ON diario.id_menu = menu.id_menu
            WHERE pedido.id_pedido =" . $idPedido;

            $resultado = $conexion->query($cadenaSql);
            $numeroDeRegistros = $resultado->num_rows;

            if ($numeroDeRegistros > 0) { ?>

                <nav class="navbar navbar-dark bg-dark" style="margin-top: 1%;">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">Menus</span>
                    </div>
                </nav>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align: center;">
                                Imagen
                            </th>
                            <th>
                                IdMenu
                            </th>
                            <th>
                                Nombre
                            </th>
                            <th>
                                Fecha disponible
                            </th>
                            <th>
                                Precio
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($menu = $resultado->fetch_assoc()) {
                        ?>
                            <tr>
                                <td style="text-align: center;">
                                    <?php echo "<img class='card-img-top' style='width:150px; ' src= 'data:image/png; base64," . base64_encode($menu['imagen']) . "'> "; ?>
                                </td>
                                <td style="vertical-align:middle"><?php echo $menu['idMenu'] ?></td>
                                <td style="vertical-align:middle"><?php echo $menu['nombreMenu'] ?></td>
                                <td style="vertical-align:middle"><?php echo $menu['fechaDiario'] ?></td>
                                <td style="vertical-align:middle"><?php echo $menu['precio'] ?>€</td>
                            </tr>
                    </tbody>
                <?php
                        }
                ?>
                </table>
        <?php
            }
        } elseif (isset($aceptar)) {
            $sqlAceptar = "UPDATE pedido SET proceso = 'Aceptado' WHERE id_pedido = $idPedido";
            //echo $sqlAceptar;
            header("correo.php");
            $resultado = $conexion->query($sqlAceptar);
            if ($resultado) {

                $sqlCorreo = "SELECT cliente.email as correo FROM pedido INNER JOIN cliente ON cliente.id_cliente = pedido.id_cliente WHERE pedido.id_pedido = " . $idPedido;
                $resultado = $conexion->query($sqlCorreo);
                $correoCliente = $resultado->fetch_assoc();
                $correo = $correoCliente['correo'];

                $texto = "Su pedido ha sido aceptado, lo tendrá listo para la fecha que nos ha indicado";
                $correoAMandar = $correo;



                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
                $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
                $mail->Port = 587; // TLS only
                $mail->SMTPSecure = 'tls'; // ssl is deprecated
                $mail->SMTPAuth = true;
                //access
                $mail->Username = "xcmunrod610@ieshnosmachado.org"; // email
                $mail->Password =  "Soylapolla?23"; // password
                //desde
                $mail->setFrom($correo, 'Pedido'); // From email and name
                //a
                $mail->addAddress($correo); // to email and name
                $mail->Subject =  "Pedido aceptado";
                //mensaje


                $mail->msgHTML($texto);
                $mail->AltBody = 'HTML messaging not supported';
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->CharSet = 'UTF-8';
                if (!$mail->send()) {
                    $json["error"] = true;
                } else {
                    $json["error"] = false;
                }
            }
        } else {

            $sqlAceptar = "UPDATE pedido SET proceso = 'Rechazado' WHERE id_pedido = $idPedido";
            //echo $sqlAceptar;
            $resultado = $conexion->query($sqlAceptar);
            if ($resultado) {
                $sqlCorreo = "SELECT cliente.email as correo FROM pedido INNER JOIN cliente ON cliente.id_cliente = pedido.id_cliente WHERE pedido.id_pedido = " . $idPedido;
                $resultado = $conexion->query($sqlCorreo);
                $correoCliente = $resultado->fetch_assoc();
                $correo = $correoCliente['correo'];

                $texto = "Su pedido ha sido rechazado, contacte con nosotros para más detalles";
                $subject = "Pedido rechazado";
                $correoAMandar = $correo;

               
                

                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
                $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
                $mail->Port = 587; // TLS only
                $mail->SMTPSecure = 'tls'; // ssl is deprecated
                $mail->SMTPAuth = true;
                //access
                $mail->Username = "xcmunrod610@ieshnosmachado.org"; // email
                $mail->Password =  "Soylapolla?23"; // password
                //desde
                $mail->setFrom($correoAMandar, 'Pedido'); // From email and name
                //a
                $mail->addAddress($correoAMandar); // to email and name
                $mail->Subject = $subject;
                //mensaje


                $mail->msgHTML($texto);
                $mail->AltBody = 'HTML messaging not supported';
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->CharSet = 'UTF-8';
                if (!$mail->send()) {
                    $json["error"] = true;
                } else {
                    $json["error"] = false;
                }


            }
        }

        header("Location:index.php");

        ?>