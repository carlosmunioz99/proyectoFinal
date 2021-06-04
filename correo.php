<?php

    extract($_POST);
    
    //require $_SERVER['DOCUMENT_ROOT'] . '/vendor/Exception.php';
    //require $_SERVER['DOCUMENT_ROOT'] . '/vendor/PHPMailer.php';
    //require $_SERVER['DOCUMENT_ROOT'] . '/vendor/SMTP.php';
    
    require './vendor/Exception.php';
    require './vendor/PHPMailer.php';
    require './vendor/SMTP.php';

    //require './vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer;
    $mail->isSMTP(); 
    $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = 587; // TLS only
    $mail->SMTPSecure = 'tls'; // ssl is deprecated
    $mail->SMTPAuth = true;
    //access
    $mail->Username = "xcmunrod610@ieshnosmachado.org"; // email
    $mail->Password =  "Soylapolla?23"; // password
    //desde
    $mail->setFrom("miguelguerrerozambruno@gmail.com", 'Residencia información'); // From email and name
    //a
    $mail->addAddress("miguelguerrerozambruno@gmail.com"); // to email and name
    $mail->Subject = "Se ha aceptado tu pedido";
    //mensaje
    

    $mail->msgHTML("Se ha aceptado tu reserva"); 
    $mail->AltBody = 'HTML messaging not supported'; 
    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
                    $mail->CharSet = 'UTF-8';
    if(!$mail->send()){
        $json["error"]=true;
    }else{
        $json["error"]=false;
    }


?>