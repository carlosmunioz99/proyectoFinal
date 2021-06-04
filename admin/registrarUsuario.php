<?php
require('../conexion/conexion.php');

require '../vendor/Exception.php';
        require '../vendor/PHPMailer.php';
        require '../vendor/SMTP.php';

        //require './vendor/autoload.php';

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

$conexion = conectar();
mysqli_query($conexion,"utf8");

extract($_POST);

$sql="";

$sql = "INSERT INTO cliente (id_cliente, email, contraseña, tipo) VALUES ('$nombreUsuario', '$email', '$contraseña', 'Cliente')";

$resultado = mysqli_query($conexion,$sql);

if ($resultado){

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
    $mail->setFrom($email, 'Cuenta creada correctamente'); // From email and name
    //a
    $mail->addAddress($email); // to email and name
    $mail->Subject = "Cuenta creada";
    //mensaje


    $mail->msgHTML("Su cuenta ha sido creada, inicie sesion con las siguientes credenciales: <br> Usuario: ".$nombreUsuario." <br> Contraseña: ".$contraseña);
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


    $respuesta["error"] = 0;
    $respuesta["mensaje"] = "Cliente introducido";
} 
else {
    $respuesta["error"] = 1;
    $respuesta["mensaje"] = "Error, no se ha podido crear el usuario, intentelo de nuevo mas tarde";
}

mysqli_close($conexion);

echo json_encode($respuesta);
?>